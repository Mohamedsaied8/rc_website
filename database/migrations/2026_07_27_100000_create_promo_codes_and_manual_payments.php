<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Manual payments (mobile wallet / InstaPay transfers reviewed by an admin)
 * and admin-generated percentage promo codes.
 *
 * Status columns are plain strings, not DB enums — the test suite runs on
 * SQLite and enum changes have already bitten this schema once (see the
 * payment_status migration).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            // Stored uppercase; lookups normalise before comparing.
            $table->string('code', 64)->unique();
            $table->unsignedTinyInteger('discount_percent'); // 1-100
            $table->unsignedInteger('max_uses')->nullable(); // null = unlimited
            $table->boolean('active')->default(true);
            $table->timestamp('expires_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('promo_redemptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promo_code_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('enrollment_id')->nullable()->constrained()->nullOnDelete();
            $table->string('status', 16)->default('pending'); // pending|completed
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            // One use per user, ever. Abandoned pending redemptions are DELETED
            // (never flagged) so the slot frees up — see PromoCodeService.
            $table->unique(['promo_code_id', 'user_id']);
        });

        Schema::create('manual_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('method', 32); // manual_wallet|instapay
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('EGP');
            $table->string('reference_number', 100);
            $table->string('screenshot_path');
            $table->string('status', 16)->default('pending'); // pending|approved|rejected
            $table->text('reject_reason')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();

            $table->index('status');
        });

        Schema::table('enrollments', function (Blueprint $table) {
            // The percent is COPIED onto the enrollment so pricing stays
            // deterministic even if the promo row is later edited or deleted.
            $table->foreignId('promo_code_id')->nullable()->constrained()->nullOnDelete()->after('program_cohort_id');
            $table->unsignedTinyInteger('discount_percent')->nullable()->after('promo_code_id');
            $table->decimal('original_amount', 10, 2)->nullable()->after('discount_percent');
        });
    }

    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            if (Schema::getConnection()->getDriverName() !== 'sqlite') {
                $table->dropForeign(['promo_code_id']);
            }
            $table->dropColumn(['promo_code_id', 'discount_percent', 'original_amount']);
        });

        Schema::dropIfExists('manual_payments');
        Schema::dropIfExists('promo_redemptions');
        Schema::dropIfExists('promo_codes');
    }
};
