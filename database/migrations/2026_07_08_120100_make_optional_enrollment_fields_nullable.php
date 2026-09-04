<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * These enrollment fields are optional in the enrollment form
     * (validated as "nullable"), but the original schema created them as
     * NOT NULL with no default. On MySQL strict mode that causes the whole
     * enrollment insert to fail whenever a user leaves them blank. Make them
     * nullable so the enrollment (and downstream Paymob payment) succeeds.
     */
    private array $columns = ['experience', 'motivation', 'selected_course', 'preferred_schedule'];

    public function up(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            foreach ($this->columns as $column) {
                if (Schema::hasColumn('enrollments', $column)) {
                    $type = in_array($column, ['experience', 'motivation']) ? 'text' : 'string';
                    $table->{$type}($column)->nullable()->change();
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            foreach ($this->columns as $column) {
                if (Schema::hasColumn('enrollments', $column)) {
                    $type = in_array($column, ['experience', 'motivation']) ? 'text' : 'string';
                    $table->{$type}($column)->nullable(false)->change();
                }
            }
        });
    }
};
