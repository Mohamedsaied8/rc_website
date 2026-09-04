# Architecture — rc_website

How the app is put together and how it connects to the rest of the Robotics Corner ecosystem.

## The one-origin ecosystem

Four apps are served from **one origin** (`www.roboticscorner.tech`) by the host nginx, each under a path:

| Path | App | Where |
|---|---|---|
| `/` | **rc_website** (this repo, Laravel) | `/var/www/rc_website`, Docker `:8000` |
| `/robohub` | RoboHub (React SPA) | `/var/www/RoboHub` |
| `/connectedlabs` | ConnectedLabs (Node `:3002` + React) | `/var/www/connected-labs/web-server` |
| `/roboagent` | roboagentweb (Next.js `:3003`) | `/var/www/roboagentweb/web` |

All four share **one Supabase project** (ref `cgylgvvgyggfyvryqxxy`) as the sole identity provider. SSO works because the Supabase session cookie is host-only with `path=/` on the shared origin — **not** a domain cookie, **not** OAuth. Consequence: serving any app from its own subdomain breaks SSO.

**Path-prefix rule:** any URL one app generates for a user (redirects, emails, payment callbacks) must include that app's prefix, or it lands on Laravel's `location /` catch-all → 404. This has caused real production incidents twice (both payment-callback related).

## Authentication

Two auth systems coexist; **Supabase SSO is the real one**.

- **Login/registration is client-side:** `resources/js/auth.js` calls `supabase.signInWithPassword()` via `@supabase/ssr` with **cookie storage** (not localStorage), so PHP can read the session. There is no SSO callback route.
- **`app/Http/Middleware/SupabaseAuth.php`** (global, registered in `bootstrap/app.php`) reads the `sb-<ref>-auth-token[.N]` cookie chunks from `$_COOKIE`, verifies the JWT against Supabase JWKS, and mirrors the user into local MySQL `users` keyed by `supabase_id`. Gated by `SUPABASE_SSO_ENABLED` (true in prod).
- **PHP cookie mangling:** PHP rewrites `.` → `_` in `$_COOKIE` keys, so chunked cookies arrive as `..._0`, `..._1`. `SupabaseAuth::extractAccessToken` matches `[._](\d+)`. Any new PHP code reading these cookies must handle **both** separators — this bug once caused silent login failures for (only) accounts with large sessions.
- **Legacy path still reachable:** `StudentAuthController::login/register` is the old pure-Laravel auth. The JS bypasses it (`preventDefault`), but hitting it directly would create a local user with **no `supabase_id` and no Supabase user**. Don't build on it.
- **User metadata rule:** when writing Supabase user metadata, set **both** `name` and `full_name` — RoboHub's `handle_new_user` trigger reads `name`, other apps read `full_name`.
- Separate **admin guard** (`auth:admin`, `Admin` model) for `/admin` — plain Laravel auth, unrelated to Supabase.

## Payments

Gateway abstraction in `app/Services/Payments/`:

- `GatewayManager` picks the gateway; **default is `kashier`** (`config/services.php`, `PAYMENT_GATEWAY` env). `KASHIER_MODE=test` as of 2026-08-11 — not yet live keys.
- **Paymob is legacy** (`PaymobGateway`, `PaymobService`): kept in `PAYMENT_GATEWAYS_ACTIVE` only so old webhooks can drain. **Do not build new Paymob features.**
- Kashier refunds are deliberately disabled (`KASHIER_REFUND_ENDPOINT` blank) until Kashier support confirms the canonical endpoint — see `KashierService::refund()`.
- **Manual payments** (`ManualPaymentController`, `ManualPayment` model): wallet/InstaPay numbers from `MANUAL_WALLET_NUMBER` / `MANUAL_INSTAPAY_ADDRESS`, admin-approved.
- **Promo codes**: `PromoCodeService`, `promo_codes` + `promo_redemptions` tables (migration `2026_07_27_100000`).
- Gateway callbacks recorded in `gateway_events`; enrollments carry `gateway` + `payment_status` columns.

## Data model

**Local MySQL** (`laravel` db in the compose stack) owns:

- `users` — mirror of Supabase users, keyed by `supabase_id` (+ legacy password column)
- `programs`, `program_cohorts`, `courses` — catalog. **Enrollments attach to programs** (`selected_program` slug), not to `courses` rows; there is no user↔course relation and no public courses route (browse = `route('programs.index')`).
- `enrollments` — the money table: program, cohort, payment status, gateway
- `blog_posts`, `blog_images` — user blog with moderation workflow (pending → approve/reject)
- `cms_pages`, `cms_sections`, `cms_blocks`, `site_settings` — admin-editable CMS; `/{slug}` catch-all route renders custom pages; `site_settings` holds e.g. the RoboAgent download link (`/download/roboagent` redirect)
- `contact_messages`, `manual_payments`, `promo_codes`, `promo_redemptions`

**Supabase** (canonical project) owns cross-app data:

- RoboHub Premium → `premium_plans` (UNIQUE user_id; `plan_type` is free text defaulting to `'free'` — treat anything ≠ `'free'` as premium)
- ConnectedLabs → `bookings` (pay-per-booking, not a membership)
- RoboAgent Pro/Max → **no data exists**; its pricing page is hardcoded copy

⚠️ `public.bookings`, `users`, `robots`, `sessions` in Supabase have **RLS enabled with no SELECT policy** (default-deny). rc_website reads them through `app/Services/SupabaseRest.php` using the **service-role key**, which bypasses RLS — every query there **must** stay scoped to the authenticated user's `supabase_id`.

## Frontend

- Tailwind **v4, CSS-first**: theme tokens live in `resources/css/app.css` under `@theme` — there is no meaningful `tailwind.config.js` config. Inter font, light theme (`bg-slate-50`), cyan/emerald/blue/purple accents. Admin uses a dark theme (`admin/layout`).
- Landing page = `resources/views/home.blade.php`. **`welcome.blade.php` is dead code** (~2000 lines) — don't edit it expecting changes.
- Shared shell: `components/layout`, `header`, `footer`, `page-hero` Blade components.
- Scroll animations: `.reveal-on-scroll` elements start at `opacity:0`; `resources/js/app.js` reveals them (IntersectionObserver + load fallback + reduced-motion + no-JS CSS fallback). **Never hide content behind JS without a fallback** — this once shipped 5 blank service pages to production.

## Legacy standalone PHP

`blog.php`, `blog_admin.php`, `admin_*.php`, `db_config.php`, `database_*.php`, `setup_blog.php` + `includes/`, `uploads/` predate the Laravel blog. They connect to MySQL directly (`db_config.php` reads the Laravel `.env`). The Laravel blog (`BlogController`, `/blog`) is the live one. Don't extend the legacy files; they exist so old URLs/uploads keep working.

## Environment variables

Beyond Laravel's standard set (`.env.example` documents them):

| Var | Purpose |
|---|---|
| `SUPABASE_SSO_ENABLED` | Master switch for the SSO middleware |
| `SUPABASE_URL` / `SUPABASE_PROJECT_REF` / `SUPABASE_ANON_KEY` | Supabase project + public key (also `VITE_`-prefixed copies for the JS bundle) |
| `SUPABASE_SERVICE_ROLE_KEY` | **Secret.** Bypasses RLS; used only by `SupabaseRest.php` |
| `PAYMENT_GATEWAY` / `PAYMENT_GATEWAYS_ACTIVE` / `PAYMENT_DISPLAY_NAME` | Gateway selection (default kashier; paymob webhook-only) |
| `KASHIER_MERCHANT_ID` / `KASHIER_PAYMENT_API_KEY` / `KASHIER_SECRET_KEY` / `KASHIER_MODE` / `KASHIER_REFUND_ENDPOINT` | Kashier — note `PAYMENT_API_KEY` (HMAC) and `SECRET_KEY` (REST auth) are different keys, don't mix them |
| `PAYMOB_*` | Legacy, webhook verification only |
| `MANUAL_WALLET_NUMBER` / `MANUAL_INSTAPAY_ADDRESS` | Shown for manual payment |
| `MAIL_ADMIN_ADDRESS` | Contact-form notification target |
| `FORCE_HTTPS` | Currently false; host nginx handles the redirect |
