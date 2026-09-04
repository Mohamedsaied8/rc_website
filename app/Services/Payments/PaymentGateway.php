<?php

namespace App\Services\Payments;

use App\Models\Enrollment;
use Illuminate\Http\Request;

/**
 * Contract every payment provider implements.
 *
 * Kept deliberately narrow — three concerns only: send the user to a checkout,
 * authenticate what comes back, and reverse a charge. Anything to do with
 * pricing lives in EnrollmentPricing, not here; a gateway should never decide
 * what something costs.
 */
interface PaymentGateway
{
    /** Short slug persisted in enrollments.gateway, e.g. 'kashier'. */
    public function name(): string;

    /**
     * Build a checkout for this enrollment and persist the gateway order id.
     *
     * @param  string  $method  'card' | 'wallet'
     * @return string  Absolute URL to redirect the payer to.
     */
    public function createCheckout(Enrollment $enrollment, string $method = 'card'): string;

    /** Authenticate a server-to-server webhook. MUST fail closed. */
    public function verifyWebhook(Request $request): bool;

    /** Normalise a verified webhook. Returns null when unparseable. */
    public function parseWebhook(Request $request): ?PaymentEvent;

    /**
     * Authenticate the browser redirect back from the gateway.
     *
     * Separate from verifyWebhook: providers commonly sign the redirect with a
     * different scheme than the webhook, and conflating them is how "anyone can
     * visit ?success=true" bugs happen.
     */
    public function verifyRedirect(Request $request): bool;

    /**
     * Reverse a charge, fully or partially.
     *
     * @param  float|null  $amount  null refunds the full captured amount.
     * @throws \RuntimeException when the provider is not configured for refunds.
     */
    public function refund(string $gatewayTransactionId, ?float $amount = null, string $reason = ''): PaymentEvent;
}
