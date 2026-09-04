<?php

namespace App\Services\Payments;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RuntimeException;

/**
 * Kashier (https://developers.kashier.io) hosted-checkout integration.
 *
 * Compared to Paymob this is much thinner: there is no auth-token call and no
 * order-registration call. You compute one HMAC and build one URL.
 *
 * Three credentials, three distinct jobs — mixing them is the classic early bug:
 *   - MID             identifies the merchant; safe in the browser
 *   - Payment API Key HMAC key for the order hash AND signature verification
 *   - Secret Key      raw Authorization header for REST (refunds)
 */
class KashierService implements PaymentGateway
{
    private const HOSTED_CHECKOUT = 'https://checkout.kashier.io/';

    public function __construct(private EnrollmentPricing $pricing)
    {
    }

    public function name(): string
    {
        return 'kashier';
    }

    // ---------------------------------------------------------------- config

    private function mid(): string
    {
        return $this->required('merchant_id', 'KASHIER_MERCHANT_ID');
    }

    private function paymentApiKey(): string
    {
        return $this->required('payment_api_key', 'KASHIER_PAYMENT_API_KEY');
    }

    private function secretKey(): string
    {
        return $this->required('secret_key', 'KASHIER_SECRET_KEY');
    }

    private function mode(): string
    {
        return config('services.kashier.mode') === 'live' ? 'live' : 'test';
    }

    /**
     * Deliberately throws rather than falling back to a default.
     *
     * A hardcoded fallback is exactly how RoboHub's Paymob integration ended up
     * silently using a decommissioned account's iframe id and serving a blank
     * "Must be iframe owner" screen instead of a loud configuration error.
     */
    private function required(string $key, string $env): string
    {
        $value = config("services.kashier.{$key}");

        if (blank($value)) {
            throw new RuntimeException("Kashier is not configured: {$env} is missing.");
        }

        return $value;
    }

    // -------------------------------------------------------------- checkout

    /**
     * HMAC-SHA256 over a literal path string, keyed with the Payment API Key.
     *
     * Verified against the documented example:
     *   /?payment=mid-0-1.99.20.EGP with key "11111"
     *   -> 606a8a1307d64caf4e2e9bb724738f115a8972c27eccb2a8acd9194c357e4bec
     *
     * Field order is fixed and no extra fields may be added. Note this hash
     * covers ONLY these four values — it does not authenticate merchantRedirect
     * or serverWebhook, so treat anything arriving on those paths as untrusted
     * until separately verified.
     */
    public function orderHash(string $orderId, string $amount, string $currency): string
    {
        $path = "/?payment={$this->mid()}.{$orderId}.{$amount}.{$currency}";

        return hash_hmac('sha256', $path, $this->paymentApiKey());
    }

    public function createCheckout(Enrollment $enrollment, string $method = 'card'): string
    {
        // Amounts are DECIMAL major units here (150.00), not the integer
        // piastres Paymob used (15000). Same string in the hash and the query.
        $amount = $this->pricing->format($this->pricing->amountFor($enrollment));
        $currency = EnrollmentPricing::CURRENCY;

        // Fresh order id per attempt — reuse semantics after an abandoned or
        // successful payment are undocumented. We correlate via our own column.
        // Hyphens only: dots are the hash separator.
        $orderId = 'ENR-' . $enrollment->id . '-' . now()->timestamp;

        $enrollment->forceFill([
            'gateway' => $this->name(),
            'gateway_order_id' => $orderId,
            'amount' => $amount,
            'currency' => $currency,
        ])->save();

        $query = [
            'merchantId' => $this->mid(),
            'orderId' => $orderId,
            'amount' => $amount,
            'currency' => $currency,
            'hash' => $this->orderHash($orderId, $amount, $currency),
            'mode' => $this->mode(),
            'merchantRedirect' => route('payment.return'),
            'serverWebhook' => route('payment.callback'),
            'allowedMethods' => $method === 'wallet' ? 'wallet' : 'card',
            'defaultMethod' => $method === 'wallet' ? 'wallet' : 'card',
            'failureRedirect' => route('payment.return'),
            'redirectMethod' => 'get',
            'display' => 'en',
            'type' => 'external',
            'interactionSource' => 'Ecommerce',
            'enable3DS' => 'true',
            // Kept under the documented 120-character limit.
            'description' => mb_substr('Enrollment #' . $enrollment->id, 0, 119),
        ];

        return self::HOSTED_CHECKOUT . '?' . http_build_query($query, '', '&', PHP_QUERY_RFC3986);
    }

    // --------------------------------------------------------------- webhook

    /**
     * Kashier's webhook signature is self-describing: the payload names which
     * fields are signed via data.signatureKeys. We sort those keys, build an
     * RFC3986 query string from them, and HMAC it with the Payment API Key.
     *
     * Do NOT hardcode the field list — if Kashier adds a signed field, a
     * hardcoded verifier breaks silently.
     */
    public function verifyWebhook(Request $request): bool
    {
        $received = $request->header('x-kashier-signature');
        if (blank($received)) {
            return false;
        }

        $data = $request->input('data');
        $keys = $data['signatureKeys'] ?? null;

        if (! is_array($data) || ! is_array($keys) || $keys === []) {
            return false;
        }

        sort($keys, SORT_STRING);

        $signed = [];
        foreach ($keys as $key) {
            // A named-but-absent key would change the string; refuse rather
            // than silently signing a different payload than Kashier did.
            if (! array_key_exists($key, $data)) {
                return false;
            }
            $signed[$key] = $data[$key];
        }

        // RFC3986, not form encoding: spaces must be %20, never '+'.
        $queryString = http_build_query($signed, '', '&', PHP_QUERY_RFC3986);

        return hash_equals(
            hash_hmac('sha256', $queryString, $this->paymentApiKey()),
            $received
        );
    }

    public function parseWebhook(Request $request): ?PaymentEvent
    {
        $event = $request->input('event');
        $data = $request->input('data');

        if (! is_array($data) || blank($event)) {
            return null;
        }

        $status = strtoupper((string) ($data['status'] ?? ''));
        $merchantOrderId = $data['merchantOrderId'] ?? null;
        $transactionId = $data['transactionId'] ?? null;

        return new PaymentEvent(
            type: (string) $event,
            // Kashier returns HTTP 200 on failures too — branch on status,
            // never on the response code.
            success: $status === 'SUCCESS',
            enrollmentId: $this->enrollmentIdFrom($merchantOrderId),
            gatewayOrderId: $merchantOrderId,
            gatewayTransactionId: $transactionId,
            amount: isset($data['amount']) ? (float) $data['amount'] : null,
            currency: $data['currency'] ?? null,
            // One transaction emits several events (authorize/capture/refund),
            // so the pair is what makes a delivery unique.
            eventId: $transactionId ? "{$event}:{$transactionId}" : null,
        );
    }

    /** 'ENR-42-1750000000' -> 42 */
    private function enrollmentIdFrom(?string $merchantOrderId): ?int
    {
        if (! $merchantOrderId) {
            return null;
        }

        $parts = explode('-', $merchantOrderId);

        return (($parts[0] ?? null) === 'ENR' && ctype_digit($parts[1] ?? ''))
            ? (int) $parts[1]
            : null;
    }

    // -------------------------------------------------------------- redirect

    /**
     * The browser redirect uses a DIFFERENT scheme from the webhook: every
     * query param in the order given, joined as "&k=v", skipping `signature`
     * and `mode`, with raw (unencoded) values.
     */
    public function verifyRedirect(Request $request): bool
    {
        $received = $request->query('signature');
        if (blank($received)) {
            return false;
        }

        $queryString = '';
        foreach ($request->query() as $key => $value) {
            if ($key === 'signature' || $key === 'mode') {
                continue;
            }
            $queryString .= "&{$key}={$value}";
        }

        return hash_equals(
            hash_hmac('sha256', ltrim($queryString, '&'), $this->paymentApiKey()),
            $received
        );
    }

    // ---------------------------------------------------------------- refund

    /**
     * NOT YET ENABLED.
     *
     * The published docs give three mutually inconsistent refund endpoints
     * (fep.kashier.io/v3/orders/:id, test-api.kashier.io/orders/:id/, and the
     * community SDK's /orders/{id}/transactions/{txn}?operation=refund). Rather
     * than guess at a money-moving call, this stays disabled until Kashier
     * support confirms the canonical endpoint. The request shape below is
     * believed correct and is left in place for when it is switched on.
     *
     * Set services.kashier.refund_endpoint once confirmed.
     */
    public function refund(string $gatewayTransactionId, ?float $amount = null, string $reason = ''): PaymentEvent
    {
        $endpoint = config('services.kashier.refund_endpoint');

        if (blank($endpoint)) {
            throw new RuntimeException(
                'Kashier refunds are not enabled: confirm the canonical refund endpoint '
                . 'with Kashier support, then set KASHIER_REFUND_ENDPOINT.'
            );
        }

        $response = Http::withHeaders([
                // Raw secret key — no "Bearer" prefix.
                'Authorization' => $this->secretKey(),
            ])
            ->timeout(20)
            ->put(rtrim($endpoint, '/') . '/' . $gatewayTransactionId, array_filter([
                'apiOperation' => 'REFUND',
                'reason' => $reason ?: 'Merchant-initiated refund',
                'transaction' => $amount !== null
                    ? ['amount' => $this->pricing->format($amount)]
                    : null,
            ]));

        if (! $response->successful()) {
            throw new RuntimeException('Kashier refund request failed: ' . $response->body());
        }

        $body = $response->json();

        return new PaymentEvent(
            type: 'refund',
            success: strtoupper((string) ($body['status'] ?? '')) === 'SUCCESS',
            enrollmentId: null,
            gatewayOrderId: $body['orderReference'] ?? null,
            gatewayTransactionId: $body['transactionId'] ?? $gatewayTransactionId,
            amount: isset($body['amount']) ? (float) $body['amount'] : $amount,
            currency: EnrollmentPricing::CURRENCY,
            eventId: isset($body['transactionId']) ? "refund:{$body['transactionId']}" : null,
        );
    }
}
