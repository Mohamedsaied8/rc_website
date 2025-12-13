<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add currency column to programs table
        Schema::table('programs', function (Blueprint $table) {
            $table->string('currency', 3)->default('EGP')->after('price');
        });

        // Add currency column to courses table
        Schema::table('courses', function (Blueprint $table) {
            $table->string('currency', 3)->default('EGP')->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove currency column from programs table
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn('currency');
        });

        // Remove currency column from courses table
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('currency');
        });
    }
};
