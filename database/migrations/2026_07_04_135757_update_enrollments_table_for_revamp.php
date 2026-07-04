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
        Schema::table('enrollments', function (Blueprint $table) {
            $table->string('second_name')->nullable()->after('first_name');
            $table->string('university')->nullable()->after('education_level');
            $table->string('graduation_year')->nullable()->after('university');
            $table->string('college')->nullable()->after('graduation_year');
            $table->foreignId('program_cohort_id')->nullable()->constrained()->nullOnDelete()->after('selected_course');
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropForeign(['program_cohort_id']);
            $table->dropColumn([
                'user_id',
                'second_name',
                'university',
                'graduation_year',
                'college',
                'program_cohort_id'
            ]);
        });
    }
};
