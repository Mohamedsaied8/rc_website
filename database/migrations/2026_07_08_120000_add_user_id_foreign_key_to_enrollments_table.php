<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add a proper foreign key on enrollments.user_id.
     *
     * The user_id column already exists (added in the revamp migration) but
     * without a foreign key constraint. This adds it safely:
     *  - nullOnDelete keeps historical enrollments if a user is removed
     *  - skipped on SQLite, where adding a FK to an existing table is not
     *    supported via ALTER (and the test suite runs on SQLite)
     *  - skipped if a foreign key on user_id already exists
     */
    public function up(): void
    {
        if (! Schema::hasColumn('enrollments', 'user_id')) {
            return;
        }

        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        if ($this->foreignKeyExists()) {
            return;
        }

        Schema::table('enrollments', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        if (! $this->foreignKeyExists()) {
            return;
        }

        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }

    private function foreignKeyExists(): bool
    {
        $database = DB::getDatabaseName();

        $count = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', $database)
            ->where('TABLE_NAME', 'enrollments')
            ->where('COLUMN_NAME', 'user_id')
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->count();

        return $count > 0;
    }
};
