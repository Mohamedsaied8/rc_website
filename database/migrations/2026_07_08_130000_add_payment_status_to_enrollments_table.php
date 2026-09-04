<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Track payment state separately from the admin workflow "status" column.
     *
     * The webhook previously wrote 'paid'/'failed' into the `status` enum, which
     * only allows pending/approved/rejected/completed — so successful payments
     * were never recorded. This introduces a dedicated payment_status column plus
     * columns to reconcile against Paymob.
     */
    public function up(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            if (! Schema::hasColumn('enrollments', 'payment_status')) {
                $table->enum('payment_status', ['unpaid', 'paid', 'failed', 'refunded'])
                    ->default('unpaid')
                    ->after('payment_method');
            }
            if (! Schema::hasColumn('enrollments', 'paymob_order_id')) {
                $table->string('paymob_order_id')->nullable()->after('payment_status');
            }
            if (! Schema::hasColumn('enrollments', 'paymob_transaction_id')) {
                $table->string('paymob_transaction_id')->nullable()->after('paymob_order_id');
            }
            if (! Schema::hasColumn('enrollments', 'paid_at')) {
                $table->timestamp('paid_at')->nullable()->after('paymob_transaction_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn([
                'payment_status',
                'paymob_order_id',
                'paymob_transaction_id',
                'paid_at',
            ]);
        });
    }
};
