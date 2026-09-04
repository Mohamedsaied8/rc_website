<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Webhook idempotency ledger.
 *
 * The old callback guarded replays only by checking `payment_status === 'paid'`,
 * which left the failure path unprotected and had no locking — two concurrent
 * deliveries could both pass the check and both write.
 *
 * Kashier retries aggressively on any non-2xx (every 5 min for 15 min, then
 * every 8 h for 24 h), so duplicate deliveries are expected, not exceptional.
 * The unique constraint on event_id is what makes processing exactly-once.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gateway_events', function (Blueprint $table) {
            $table->id();
            $table->string('gateway', 32);
            // "{event}:{transactionId}" — one transaction emits several events
            // (authorize / capture / refund), so the pair is the unique key.
            $table->string('event_id', 191);
            $table->string('event_type', 32);
            $table->unsignedBigInteger('enrollment_id')->nullable();
            $table->timestamp('processed_at')->useCurrent();

            $table->unique(['gateway', 'event_id']);
            $table->index('enrollment_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gateway_events');
    }
};
