<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * SSO bridge: on every web request, read the shared Supabase session cookie,
 * verify the access-token JWT, and log the corresponding user into Laravel's
 * `web` guard. If there is no valid Supabase session, ensure the web guard is
 * logged out — so signing out in any of the four apps propagates here.
 *
 * The `admin` guard / admin area is intentionally out of scope.
 */
class SupabaseAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Dormant until SSO is deliberately enabled — keeps the legacy
        // Laravel/MySQL auth fully intact during the migration.
        if (!config('supabase.enabled')) {
            return $next($request);
        }

        if ($request->is('admin') || $request->is('admin/*')) {
            return $next($request);
        }

        $claims = $this->verifyFromCookie();

        if ($claims) {
            $user = $this->syncUser($claims);
            if ($user && Auth::guard('web')->id() !== $user->id) {
                Auth::guard('web')->login($user);
            }
        } elseif (Auth::guard('web')->check()) {
            // Supabase session gone -> mirror the sign-out locally.
            Auth::guard('web')->logout();
        }

        return $next($request);
    }

    /** Read + reassemble the Supabase cookie and verify the JWT. */
    protected function verifyFromCookie(): ?array
    {
        $ref = config('supabase.project_ref');
        if (!$ref) {
            return null;
        }
        $token = $this->extractAccessToken($ref);
        return $token ? $this->verifyJwt($token) : null;
    }

    /**
     * @supabase/ssr stores the session as cookie `sb-<ref>-auth-token`, split
     * into `.0`, `.1`, ... chunks when large. The value is `base64-<payload>`.
     * We read the raw PHP cookie jar so Laravel's cookie encryption doesn't
     * interfere with these foreign, dynamically-named cookies.
     *
     * IMPORTANT: PHP rewrites `.` to `_` in incoming variable names, so the
     * chunked cookies arrive as `..._0`, `..._1` even though the browser (and
     * every JS sibling app) sees `....0`, `....1`. Match BOTH separators —
     * matching only the dot form silently breaks login for exactly those users
     * whose session is large enough to be chunked (>~3180 bytes).
     */
    protected function extractAccessToken(string $ref): ?string
    {
        $base = "sb-{$ref}-auth-token";
        $raw = $_COOKIE[$base] ?? '';

        if ($raw === '') {
            $chunks = [];
            foreach ($_COOKIE as $key => $value) {
                if (preg_match('/^'.preg_quote($base, '/').'[._](\d+)$/', $key, $m)) {
                    $chunks[(int) $m[1]] = $value;
                }
            }
            if ($chunks) {
                ksort($chunks);
                $raw = implode('', $chunks);
            }
        }

        if ($raw === '') {
            return null;
        }

        if (Str::startsWith($raw, 'base64-')) {
            $payload = base64_decode(strtr(substr($raw, 7), '-_', '+/'), true);
        } else {
            $payload = $raw;
        }

        if (!is_string($payload) || $payload === '') {
            return null;
        }

        $session = json_decode($payload, true);
        if (!is_array($session)) {
            return null;
        }

        if (!empty($session['access_token'])) {
            return $session['access_token'];
        }
        if (isset($session[0]) && is_string($session[0])) {
            return $session[0]; // legacy array-encoded session
        }
        return null;
    }

    /** Verify via JWKS (preferred), falling back to the legacy HS256 secret. */
    protected function verifyJwt(string $token): ?array
    {
        $jwksUrl = config('supabase.jwks_url');
        if ($jwksUrl) {
            try {
                $jwks = Cache::remember('supabase_jwks', (int) config('supabase.jwks_cache_ttl', 600), function () use ($jwksUrl) {
                    $resp = Http::timeout(5)->get($jwksUrl);
                    return $resp->ok() ? $resp->json() : null;
                });
                if (is_array($jwks) && !empty($jwks['keys'])) {
                    $decoded = (array) JWT::decode($token, JWK::parseKeySet($jwks));
                    return $this->validateClaims($decoded);
                }
            } catch (\Throwable $e) {
                // fall through to legacy secret
            }
        }

        $secret = config('supabase.jwt_secret');
        if ($secret) {
            try {
                $decoded = (array) JWT::decode($token, new Key($secret, 'HS256'));
                return $this->validateClaims($decoded);
            } catch (\Throwable $e) {
                return null;
            }
        }

        return null;
    }

    protected function validateClaims(array $claims): ?array
    {
        $expectedIss = config('supabase.issuer');
        $expectedAud = config('supabase.audience', 'authenticated');

        if ($expectedIss && ($claims['iss'] ?? null) !== $expectedIss) {
            return null;
        }
        if ($expectedAud && ($claims['aud'] ?? null) !== $expectedAud) {
            return null;
        }
        if (empty($claims['sub'])) {
            return null;
        }
        return $claims;
    }

    /** Find-or-create the local mirror row for this Supabase user. */
    protected function syncUser(array $claims): ?User
    {
        $sub = $claims['sub'];
        $email = $claims['email'] ?? null;
        $meta = (array) ($claims['user_metadata'] ?? []);
        $name = $meta['full_name'] ?? $meta['name'] ?? ($email ? Str::before($email, '@') : 'User');
        $phone = $meta['phone'] ?? $meta['phone_number'] ?? null;

        $user = User::where('supabase_id', $sub)
            ->when($email, fn ($q) => $q->orWhere('email', $email))
            ->first();

        if (!$user) {
            if (!$email) {
                return null;
            }
            return User::create([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'supabase_id' => $sub,
                'email_verified_at' => now(),
            ]);
        }

        if (!$user->supabase_id) {
            $user->supabase_id = $sub;
            $user->save();
        }

        return $user;
    }
}
