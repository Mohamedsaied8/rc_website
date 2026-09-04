<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Services\Payments\EnrollmentPricing;
use App\Services\Payments\GatewayManager;
use App\Services\Payments\PaymentEvent;
use App\Services\Payments\PaymentGateway;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct(
        private GatewayManager $gateways,
        private EnrollmentPricing $pricing,
    ) {
    }

    /**
     * Send the payer to the gateway's checkout.
     */
    public function process(Request $request, Enrollment $enrollment)
    {
        if ($enrollment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        if ($enrollment->payment_status === 'paid') {
            return redirect()->route('enroll.success')->with('success', 'This enrollment is already paid.');
        }

        try {
            $method = $enrollment->payment_method === 'wallet' ? 'wallet' : 'card';

            return redirect()->away(
                $this->gateways->default()->createCheckout($enrollment, $method)
            );
        } catch (Exception $e) {
            Log::error('Payment initiation failed', [
                'enrollment_id' => $enrollment->id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('enroll')
                ->withErrors(['error' => 'Failed to initiate payment. Please try again.']);
        }
    }

    /**
     * Server-to-server webhook.
     *
     * A callback carries no hint of which provider sent it, so each active
     * gateway is offered the request and the signature decides. Unsigned or
     * badly-signed payloads are rejected — this endpoint is public and the
     * signature is its only authentication.
     */
    public function callback(Request $request)
    {
        $gateway = $this->resolveGatewayFor($request);

        if (! $gateway) {
            Log::warning('Payment callback rejected: no gateway accepted the signature.');

            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $event = $gateway->parseWebhook($request);

        if (! $event || ! $event->eventId) {
            Log::warning('Payment callback verified but unparseable.', ['gateway' => $gateway->name()]);

            // 4xx so the gateway retries — a 200 here would tell it the payment
            // was handled when nothing was recorded.
            return response()->json(['message' => 'Unprocessable payload'], 422);
        }

        // Claim the event before doing any work. The unique index makes this
        // exactly-once even if two deliveries land concurrently.
        $claimed = $this->claimEvent($gateway->name(), $event);

        if (! $claimed) {
            return response()->json(['message' => 'Already processed'], 200);
        }

        try {
            $this->applyEvent($gateway, $event);
        } catch (Exception $e) {
            // Release the claim so the gateway's retry can have another go.
            DB::table('gateway_events')
                ->where('gateway', $gateway->name())
                ->where('event_id', $event->eventId)
                ->delete();

            Log::error('Payment callback processing failed', [
                'gateway' => $gateway->name(),
                'event_id' => $event->eventId,
                'error' => $e->getMessage(),
            ]);

            return response()->json(['message' => 'Processing failed'], 500);
        }

        return response()->json(['message' => 'Processed'], 200);
    }

    /**
     * Browser redirect back from the gateway.
     *
     * Presentation only — it never writes payment state; the webhook is the
     * source of truth. It also verifies the redirect signature, because the old
     * implementation trusted a bare ?success=true query param and would tell
     * anyone who visited that URL their enrollment was confirmed.
     */
    public function returnUrl(Request $request)
    {
        $gateway = $this->gateways->default();
        $verified = $gateway->verifyRedirect($request);

        if (! $verified) {
            Log::info('Unverified payment redirect; falling back to a neutral message.');

            return redirect()->route('profile')
                ->with('info', 'Thanks — we are confirming your payment. This page will update once your bank confirms it.');
        }

        $status = strtoupper((string) $request->query('paymentStatus', $request->query('status', '')));

        if ($status === 'SUCCESS') {
            return redirect()->route('enroll.success')
                ->with('success', 'Payment successful! Your enrollment is confirmed.');
        }

        return redirect()->route('enroll')
            ->withErrors(['error' => 'Payment failed or was cancelled. Please try again.']);
    }

    // ----------------------------------------------------------- internals

    private function resolveGatewayFor(Request $request): ?PaymentGateway
    {
        foreach ($this->gateways->active() as $gateway) {
            try {
                if ($gateway->verifyWebhook($request)) {
                    return $gateway;
                }
            } catch (Exception $e) {
                // An unconfigured gateway must not block a configured one.
                Log::debug('Gateway declined callback', [
                    'gateway' => $gateway->name(),
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return null;
    }

    /** @return bool True when this process won the race to handle the event. */
    private function claimEvent(string $gateway, PaymentEvent $event): bool
    {
        try {
            DB::table('gateway_events')->insert([
                'gateway' => $gateway,
                'event_id' => $event->eventId,
                'event_type' => $event->type,
                'enrollment_id' => $event->enrollmentId,
                'processed_at' => now(),
            ]);

            return true;
        } catch (\Illuminate\Database\QueryException $e) {
            // Unique violation — another delivery already claimed it.
            return false;
        }
    }

    private function applyEvent(PaymentGateway $gateway, PaymentEvent $event): void
    {
        if (! $event->enrollmentId) {
            Log::warning('Payment event carries no enrollment reference.', ['event_id' => $event->eventId]);

            return;
        }

        DB::transaction(function () use ($gateway, $event) {
            $enrollment = Enrollment::whereKey($event->enrollmentId)->lockForUpdate()->first();

            if (! $enrollment) {
                Log::warning('Payment event for unknown enrollment.', ['id' => $event->enrollmentId]);

                return;
            }

            if ($event->type === 'refund') {
                $enrollment->forceFill(['payment_status' => 'refunded'])->save();
                Log::info("Enrollment {$enrollment->id} marked refunded.");

                return;
            }

            if (! $event->success) {
                // Never downgrade a paid enrollment. A late failure callback for
                // an earlier attempt must not clobber a successful one.
                if ($enrollment->payment_status !== 'paid') {
                    $enrollment->forceFill([
                        'payment_status' => 'failed',
                        'gateway' => $gateway->name(),
                        'gateway_transaction_id' => $event->gatewayTransactionId,
                    ])->save();
                }

                return;
            }

            if ($enrollment->payment_status === 'paid') {
                return;
            }

            // Confirm we were paid what we asked for. Both sides are decimal
            // major units — PaymobGateway normalises piastres on the way in.
            $expected = $this->pricing->amountFor($enrollment);

            if ($event->amount !== null && ! $this->pricing->matches($expected, $event->amount)) {
                Log::warning('Payment amount mismatch — NOT marking paid.', [
                    'enrollment_id' => $enrollment->id,
                    'expected' => $expected,
                    'received' => $event->amount,
                    'transaction' => $event->gatewayTransactionId,
                ]);

                $enrollment->forceFill([
                    'payment_status' => 'failed',
                    'gateway' => $gateway->name(),
                    'gateway_transaction_id' => $event->gatewayTransactionId,
                ])->save();

                return;
            }

            $enrollment->forceFill([
                'payment_status' => 'paid',
                'gateway' => $gateway->name(),
                'gateway_order_id' => $event->gatewayOrderId ?? $enrollment->gateway_order_id,
                'gateway_transaction_id' => $event->gatewayTransactionId,
                'amount' => $event->amount ?? $expected,
                'currency' => $event->currency ?? EnrollmentPricing::CURRENCY,
                'paid_at' => now(),
            ])->save();

            Log::info("Enrollment {$enrollment->id} marked paid.", [
                'gateway' => $gateway->name(),
                'transaction' => $event->gatewayTransactionId,
            ]);
        });
    }
}
