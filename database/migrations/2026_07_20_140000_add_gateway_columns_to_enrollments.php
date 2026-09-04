<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Make the payment columns gateway-neutral ahead of the Kashier migration.
 *
 * The two paymob_* columns are RENAMED rather than dropped so historical
 * Paymob payments stay queryable next to Kashier ones — in-flight transactions
 * outlive cutover day and remain refundable for months.
 *
 * Also adds what was never persisted: the amount and currency actually charged.
 * Until now nothing recorded what the customer paid; it was only ever
 * recomputed on demand, so a later price change silently rewrote history.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            if (! Schema::hasColumn('enrollments', 'gateway')) {
                $table->string('gateway', 32)->nullable()->after('payment_method');
            }
            if (! Schema::hasColumn('enrollments', 'amount')) {
                $table->decimal('amount', 10, 2)->nullable()->after('payment_status');
            }
            if (! Schema::hasColumn('enrollments', 'currency')) {
                $table->string('currency', 3)->nullable()->after('amount');
            }
        });

        // Rename separately — doctrine/dbal requires its own schema pass.
        Schema::table('enrollments', function (Blueprint $table) {
            if (Schema::hasColumn('enrollments', 'paymob_order_id')
                && ! Schema::hasColumn('enrollments', 'gateway_order_id')) {
                $table->renameColumn('paymob_order_id', 'gateway_order_id');
            }
        });

        Schema::table('enrollments', function (Blueprint $table) {
            if (Schema::hasColumn('enrollments', 'paymob_transaction_id')
                && ! Schema::hasColumn('enrollments', 'gateway_transaction_id')) {
                $table->renameColumn('paymob_transaction_id', 'gateway_transaction_id');
            }
        });

        // Backfill: every pre-existing payment was Paymob's.
        DB::table('enrollments')
            ->whereNull('gateway')
            ->where(function ($q) {
                $q->whereNotNull('gateway_order_id')
                  ->orWhereNotNull('gateway_transaction_id');
            })
            ->update(['gateway' => 'paymob']);

        Schema::table('enrollments', function (Blueprint $table) {
            $table->index(['gateway', 'gateway_order_id'], 'enrollments_gateway_order_idx');
        });
    }

    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropIndex('enrollments_gateway_order_idx');
        });

        Schema::table('enrollments', function (Blueprint $table) {
            if (Schema::hasColumn('enrollments', 'gateway_order_id')) {
                $table->renameColumn('gateway_order_id', 'paymob_order_id');
            }
        });

        Schema::table('enrollments', function (Blueprint $table) {
            if (Schema::hasColumn('enrollments', 'gateway_transaction_id')) {
                $table->renameColumn('gateway_transaction_id', 'paymob_transaction_id');
            }
        });

        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn(['gateway', 'amount', 'currency']);
        });
    }
};
