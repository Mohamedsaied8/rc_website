<?php

namespace Tests\Unit;

use App\Services\Payments\EnrollmentPricing;
use App\Services\Payments\KashierService;
use Illuminate\Http\Request;
use Tests\TestCase;

/**
 * These cover the two things that must never be wrong: the order hash the
 * gateway checks before taking money, and the signature check that is the ONLY
 * authentication on a public webhook endpoint.
 */
class KashierServiceTest extends TestCase
{
    private const PAYMENT_API_KEY = '11111';
    private const MID = 'mid-0-1';

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'services.kashier.merchant_id' => self::MID,
            'services.kashier.payment_api_key' => self::PAYMENT_API_KEY,
            'services.kashier.secret_key' => 'secret-key',
            'services.kashier.mode' => 'test',
        ]);
    }

    private function service(): KashierService
    {
        return new KashierService(new EnrollmentPricing());
    }

    /**
     * The worked example straight from Kashier's documentation. If this ever
     * fails, every payment is rejected at the gateway — nothing else matters.
     */
    public function test_order_hash_matches_the_documented_example(): void
    {
        $this->assertSame(
            '606a8a1307d64caf4e2e9bb724738f115a8972c27eccb2a8acd9194c357e4bec',
            $this->service()->orderHash('99', '20', 'EGP')
        );
    }

    /**
     * The hash is computed over a literal string, so "20" and "20.00" are
     * different hashes. This is the trap that silently breaks checkout.
     */
    public function test_amount_formatting_is_canonical_and_stable(): void
    {
        $pricing = new EnrollmentPricing();

        $this->assertSame('20.00', $pricing->format(20));
        $this->assertSame('20.00', $pricing->format(20.0));
        $this->assertSame('1500.50', $pricing->format(1500.5));
        $this->assertSame('0.00', $pricing->format(0));

        // Whatever we sign must equal what we send.
        $amount = $pricing->format(1500.5);
        $this->assertSame(
            $this->service()->orderHash('ENR-1-123', $amount, 'EGP'),
            $this->service()->orderHash('ENR-1-123', '1500.50', 'EGP')
        );
    }

    // ------------------------------------------------------------- webhook

    /** Builds a payload plus its correct signature. */
    private function signedWebhook(array $overrides = []): array
    {
        $data = array_merge([
            'amount' => 1,
            'channel' => 'online | e-commerce',
            'currency' => 'EGP',
            'kashierOrderId' => '9ad06b17-755b-4e21-9774-aff3e2726ac9',
            'merchantOrderId' => 'ENR-42-1750000000',
            'method' => 'card',
            'orderReference' => 'TEST-ORD-38855',
            'status' => 'SUCCESS',
            'transactionId' => 'TX-249893963',
            'transactionResponseCode' => '00',
        ], $overrides);

        $data['signatureKeys'] = [
            'amount', 'channel', 'currency', 'kashierOrderId', 'merchantOrderId',
            'method', 'orderReference', 'status', 'transactionId', 'transactionResponseCode',
        ];

        $signed = [];
        foreach ($data['signatureKeys'] as $key) {
            $signed[$key] = $data[$key];
        }

        $signature = hash_hmac(
            'sha256',
            http_build_query($signed, '', '&', PHP_QUERY_RFC3986),
            self::PAYMENT_API_KEY
        );

        return [$data, $signature];
    }

    private function webhookRequest(array $data, ?string $signature): Request
    {
        $request = Request::create('/payment/callback', 'POST', [], [], [], [], json_encode([
            'event' => 'pay',
            'data' => $data,
        ]));
        $request->headers->set('Content-Type', 'application/json');

        if ($signature !== null) {
            $request->headers->set('x-kashier-signature', $signature);
        }

        return $request;
    }

    public function test_valid_webhook_signature_is_accepted(): void
    {
        [$data, $signature] = $this->signedWebhook();

        $this->assertTrue(
            $this->service()->verifyWebhook($this->webhookRequest($data, $signature))
        );
    }

    /**
     * The documented canonical string uses %20 for space and %7C for '|'.
     * Form-encoding would produce '+' here and every verification would fail.
     */
    public function test_signature_uses_rfc3986_encoding_not_form_encoding(): void
    {
        [$data, $signature] = $this->signedWebhook();

        $signed = [];
        foreach ($data['signatureKeys'] as $key) {
            $signed[$key] = $data[$key];
        }
        $canonical = http_build_query($signed, '', '&', PHP_QUERY_RFC3986);

        $this->assertStringContainsString('%20', $canonical);
        $this->assertStringContainsString('%7C', $canonical);
        $this->assertStringNotContainsString('+', $canonical);

        $this->assertTrue($this->service()->verifyWebhook($this->webhookRequest($data, $signature)));
    }

    public function test_tampered_amount_is_rejected(): void
    {
        [$data, $signature] = $this->signedWebhook();
        $data['amount'] = 99999;

        $this->assertFalse(
            $this->service()->verifyWebhook($this->webhookRequest($data, $signature))
        );
    }

    public function test_missing_signature_header_is_rejected(): void
    {
        [$data] = $this->signedWebhook();

        $this->assertFalse(
            $this->service()->verifyWebhook($this->webhookRequest($data, null))
        );
    }

    /** A key named in signatureKeys but absent from data must not be signed around. */
    public function test_missing_signed_field_is_rejected(): void
    {
        [$data, $signature] = $this->signedWebhook();
        unset($data['status']);

        $this->assertFalse(
            $this->service()->verifyWebhook($this->webhookRequest($data, $signature))
        );
    }

    /** Verification must fail closed when the key is not configured. */
    public function test_unconfigured_key_fails_closed(): void
    {
        [$data, $signature] = $this->signedWebhook();
        config(['services.kashier.payment_api_key' => null]);

        $this->expectException(\RuntimeException::class);
        $this->service()->verifyWebhook($this->webhookRequest($data, $signature));
    }

    // -------------------------------------------------------------- parsing

    public function test_parses_a_successful_payment(): void
    {
        [$data, $signature] = $this->signedWebhook();

        $event = $this->service()->parseWebhook($this->webhookRequest($data, $signature));

        $this->assertNotNull($event);
        $this->assertSame('pay', $event->type);
        $this->assertTrue($event->success);
        $this->assertSame(42, $event->enrollmentId);
        $this->assertSame('TX-249893963', $event->gatewayTransactionId);
        $this->assertSame('pay:TX-249893963', $event->eventId);
        $this->assertSame('EGP', $event->currency);
    }

    /**
     * Kashier returns HTTP 200 on failures — the status field is the only
     * signal. Treating a 200 as success would mark failed payments as paid.
     */
    public function test_non_success_status_is_not_treated_as_paid(): void
    {
        [$data, $signature] = $this->signedWebhook(['status' => 'FAILURE']);

        $event = $this->service()->parseWebhook($this->webhookRequest($data, $signature));

        $this->assertNotNull($event);
        $this->assertFalse($event->success);
    }

    // ------------------------------------------------------------- redirect

    public function test_redirect_signature_uses_its_own_scheme(): void
    {
        // Ordered, raw values, skipping `signature` and `mode`.
        $params = [
            'paymentStatus' => 'SUCCESS',
            'merchantOrderId' => 'ENR-42-1750000000',
            'transactionId' => 'TX-1',
        ];

        $queryString = '';
        foreach ($params as $k => $v) {
            $queryString .= "&{$k}={$v}";
        }
        $signature = hash_hmac('sha256', ltrim($queryString, '&'), self::PAYMENT_API_KEY);

        $request = Request::create('/payment/return', 'GET', $params + [
            'signature' => $signature,
            'mode' => 'test',
        ]);

        $this->assertTrue($this->service()->verifyRedirect($request));
    }

    public function test_unsigned_redirect_is_rejected(): void
    {
        // The old implementation trusted ?success=true and would confirm an
        // enrollment to anyone who visited the URL.
        $request = Request::create('/payment/return', 'GET', ['paymentStatus' => 'SUCCESS']);

        $this->assertFalse($this->service()->verifyRedirect($request));
    }
}
