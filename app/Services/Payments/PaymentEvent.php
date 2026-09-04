<?php

namespace App\Services\Payments;

/**
 * A normalised, gateway-agnostic payment notification.
 *
 * Every gateway's webhook payload is parsed down to this shape so the
 * controller never sees provider-specific envelopes.
 */
class PaymentEvent
{
    public function __construct(
        /** 'pay' | 'refund' | 'authorize' | 'void' | 'capture' */
        public readonly string $type,
        public readonly bool $success,
        /** Our reference — the enrollment id we sent as the merchant order id. */
        public readonly ?int $enrollmentId,
        public readonly ?string $gatewayOrderId,
        public readonly ?string $gatewayTransactionId,
        /** Decimal major units (e.g. 1500.00 EGP), or null when not reported. */
        public readonly ?float $amount,
        public readonly ?string $currency,
        /**
         * Stable per-event id used for idempotency. Two deliveries of the same
         * event MUST produce the same value.
         */
        public readonly ?string $eventId,
    ) {
    }
}
