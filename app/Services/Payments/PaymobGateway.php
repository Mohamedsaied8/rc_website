<?php

namespace App\Services\Payments;

use App\Models\Enrollment;
use App\Services\PaymobService;
use Illuminate\Http\Request;
use RuntimeException;

/**
 * Legacy Paymob support, retained for the cutover window only.
 *
 * Paymob callbacks keep arriving for hours after the switch, and those
 * transactions stay refundable for months — so this must continue to resolve
 * for any enrollment whose `gateway` column says 'paymob'. It is NOT selectable
 * as the default gateway for new checkouts once Kashier is live.
 *
 * Delegates the wire protocol to the original PaymobService; this class only
 * adapts it to the PaymentGateway contract.
 */
class PaymobGateway implements PaymentGateway
{
    public function __construct(
        private PaymobService $paymob,
        private EnrollmentPricing $pricing,
    ) {
    }

    public function name(): string
    {
        return 'paymob';
    }

    public function createCheckout(Enrollment $enrollment, string $method = 'card'): string
    {
        $url = $this->paymob->processPayment($enrollment, $method === 'wallet' ? 'wallet' : 'card');

        // PaymobService writes the legacy column; mirror it into the neutral
        // ones so both gateways read back the same way.
        $enrollment->refresh();
        $enrollment->forceFill([
            'gateway' => $this->name(),
            'gateway_order_id' => $enrollment->paymob_order_id,
            'amount' => $this->pricing->format($this->pricing->amountFor($enrollment)),
            'currency' => EnrollmentPricing::CURRENCY,
        ])->save();

        return $url;
    }

    public function verifyWebhook(Request $request): bool
    {
        return $this->paymob->verifyHmac($request->all());
    }

    public function parseWebhook(Request $request): ?PaymentEvent
    {
        $obj = $request->input('obj');

        if (! is_array($obj)) {
            return null;
        }

        $transactionId = isset($obj['id']) ? (string) $obj['id'] : null;

        return new PaymentEvent(
            type: 'pay',
            success: filter_var($obj['success'] ?? false, FILTER_VALIDATE_BOOLEAN),
            enrollmentId: $this->enrollmentIdFrom($obj['order']['merchant_order_id'] ?? null),
            gatewayOrderId: isset($obj['order']['id']) ? (string) $obj['order']['id'] : null,
            gatewayTransactionId: $transactionId,
            // Paymob reports integer piastres; normalise to decimal EGP so the
            // controller's amount check is gateway-agnostic.
            amount: isset($obj['amount_cents']) ? ((int) $obj['amount_cents']) / 100 : null,
            currency: $obj['currency'] ?? null,
            eventId: $transactionId ? "pay:{$transactionId}" : null,
        );
    }

    /** 'ENR_42_1750000000' -> 42 (legacy underscore format). */
    private function enrollmentIdFrom(?string $merchantOrderId): ?int
    {
        if (! $merchantOrderId) {
            return null;
        }

        $parts = explode('_', $merchantOrderId);

        return (($parts[0] ?? null) === 'ENR' && ctype_digit($parts[1] ?? ''))
            ? (int) $parts[1]
            : null;
    }

    /**
     * Paymob does sign its redirect params, but the original integration never
     * verified them. We do not add that now — the redirect is presentation-only
     * (see PaymentController::returnUrl) and legacy traffic is short-lived.
     */
    public function verifyRedirect(Request $request): bool
    {
        return false;
    }

    public function refund(string $gatewayTransactionId, ?float $amount = null, string $reason = ''): PaymentEvent
    {
        throw new RuntimeException(
            'Paymob refunds were never implemented. Issue this refund from the Paymob dashboard.'
        );
    }
}
