<?php

// Configuration for the Supabase SSO bridge.
//
// rc_website does not own credentials anymore — the canonical Supabase project
// is the single identity provider. This app only VERIFIES the Supabase access
// token carried in the shared cookie and mirrors the user into the local
// `users` table (keyed by `supabase_id`). Prefer asymmetric JWKS verification;
// the legacy HS256 shared secret is an optional fallback.

$url = env('SUPABASE_URL');

return [
    // Master switch for the SSO bridge. While false (the default), the
    // SupabaseAuth middleware is a complete no-op and the site uses its existing
    // Laravel/MySQL auth untouched. Flip to true at go-live AFTER: composer
    // require firebase/php-jwt, npm build, real keys, and the user migration.
    'enabled' => (bool) env('SUPABASE_SSO_ENABLED', false),

    'url' => $url,

    // Project ref, e.g. "cgylgvvgyggfyvryqxxy". Drives the cookie name
    // sb-<ref>-auth-token[.N].
    'project_ref' => env('SUPABASE_PROJECT_REF'),

    // Public anon key (used by the browser client on the auth pages).
    'anon_key' => env('SUPABASE_ANON_KEY'),

    // Service-role key — SERVER SIDE ONLY, never expose to the browser.
    // Needed because the sibling-app tables read for the subscriptions panel
    // (public.bookings) have RLS enabled with no SELECT policy, so a user's own
    // access token is default-denied; the ConnectedLabs backend reads them the
    // same way. Every query made with this key MUST be explicitly scoped to the
    // authenticated user's supabase_id — see App\Services\SupabaseRest.
    'service_role_key' => env('SUPABASE_SERVICE_ROLE_KEY'),

    // Per-request cache TTL (seconds) for sibling-app subscription lookups.
    'subscriptions_cache_ttl' => (int) env('SUPABASE_SUBS_CACHE_TTL', 60),

    // Asymmetric verification (recommended).
    'jwks_url' => env('SUPABASE_JWKS_URL', $url ? rtrim($url, '/').'/auth/v1/.well-known/jwks.json' : null),
    'jwks_cache_ttl' => (int) env('SUPABASE_JWKS_CACHE_TTL', 600),

    // Legacy symmetric secret (only if you keep the shared HS256 JWT secret).
    'jwt_secret' => env('SUPABASE_JWT_SECRET'),

    // Claim expectations.
    'issuer' => $url ? rtrim($url, '/').'/auth/v1' : null,
    'audience' => env('SUPABASE_AUD', 'authenticated'),
];
