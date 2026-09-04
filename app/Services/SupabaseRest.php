<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Minimal PostgREST client for the canonical Supabase project.
 *
 * The four apps (rc_website, RoboHub, ConnectedLabs, RoboAgent) share one
 * Supabase project, so the sibling apps' subscription data is readable straight
 * from here — no service-to-service API needed.
 *
 * SECURITY: this uses the service-role key, which bypasses RLS. Callers must
 * always scope to a single user, and the only entry point that takes a user is
 * selectForUser(), which requires the owner column explicitly. Never build a
 * query here from unvalidated request input.
 */
class SupabaseRest
{
    /** Fail fast rather than hanging the profile page on a slow upstream. */
    protected const TIMEOUT = 4;

    public function isConfigured(): bool
    {
        return (bool) (config('supabase.url') && config('supabase.service_role_key'));
    }

    /**
     * Select rows from `$table` belonging to one Supabase user.
     *
     * @param  string  $table    PostgREST table name (trusted, code-supplied)
     * @param  string  $userId   auth.users UUID (the local users.supabase_id)
     * @param  array   $query    extra PostgREST params: select, order, limit, ...
     * @param  string  $ownerCol column holding the owning user's UUID
     * @return array   rows, or [] on any failure (never throws)
     */
    public function selectForUser(string $table, string $userId, array $query = [], string $ownerCol = 'user_id'): array
    {
        if (!$this->isConfigured() || $userId === '') {
            return [];
        }

        $key = config('supabase.service_role_key');
        $url = rtrim(config('supabase.url'), '/')."/rest/v1/{$table}";

        try {
            $response = Http::withHeaders([
                    'apikey'        => $key,
                    'Authorization' => 'Bearer '.$key,
                    'Accept'        => 'application/json',
                ])
                ->timeout(self::TIMEOUT)
                ->get($url, array_merge([$ownerCol => 'eq.'.$userId], $query));

            if ($response->failed()) {
                // Body can echo row data; log status only.
                Log::warning('SupabaseRest: query failed', [
                    'table'  => $table,
                    'status' => $response->status(),
                ]);

                return [];
            }

            $rows = $response->json();

            return is_array($rows) ? $rows : [];
        } catch (\Throwable $e) {
            // A sibling app being down must never 500 the profile page.
            Log::warning('SupabaseRest: query threw', [
                'table' => $table,
                'error' => $e->getMessage(),
            ]);

            return [];
        }
    }
}
