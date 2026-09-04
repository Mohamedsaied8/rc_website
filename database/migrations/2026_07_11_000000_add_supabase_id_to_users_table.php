<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add the Supabase identity link. Users are provisioned/merged from the
     * canonical Supabase project; this column ties a local row to its
     * Supabase auth.users UUID for SSO.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('supabase_id')->nullable()->unique()->after('id');
            // Local password is no longer the auth source; make it optional so
            // SSO-provisioned users (who authenticate via Supabase) don't need one.
            $table->string('password')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['supabase_id']);
            $table->dropColumn('supabase_id');
        });
    }
};
