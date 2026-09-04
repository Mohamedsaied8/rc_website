<?php

namespace App\Services\Payments;

use App\Models\Enrollment;
use Illuminate\Contracts\Container\Container;
use InvalidArgumentException;

/**
 * Resolves which PaymentGateway to use.
 *
 * New checkouts use the configured default. Callbacks and refunds resolve off
 * the enrollment's stored `gateway` column, so in-flight Paymob payments keep
 * working after the default flips to Kashier.
 */
class GatewayManager
{
    private const GATEWAYS = [
        'kashier' => KashierService::class,
        'paymob' => PaymobGateway::class,
    ];

    public function __construct(private Container $container)
    {
    }

    public function default(): PaymentGateway
    {
        return $this->driver(config('services.payments.default', 'kashier'));
    }

    public function driver(string $name): PaymentGateway
    {
        if (! isset(self::GATEWAYS[$name])) {
            throw new InvalidArgumentException("Unknown payment gateway [{$name}].");
        }

        return $this->container->make(self::GATEWAYS[$name]);
    }

    /**
     * The gateway that owns this enrollment's payment. Falls back to the
     * default for rows predating the `gateway` column.
     */
    public function forEnrollment(Enrollment $enrollment): PaymentGateway
    {
        return $enrollment->gateway
            ? $this->driver($enrollment->gateway)
            : $this->default();
    }

    /**
     * Every gateway that might legitimately deliver a webhook right now.
     *
     * A callback carries no hint of which provider sent it, so we try each in
     * turn and let the signature decide. During cutover that is Kashier plus
     * Paymob; once legacy traffic has drained, drop Paymob from the config.
     */
    public function active(): array
    {
        $names = config('services.payments.active', ['kashier']);

        return array_map(fn (string $name) => $this->driver($name), $names);
    }
}
