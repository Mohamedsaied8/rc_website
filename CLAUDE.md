# CLAUDE.md — rc_website

Laravel 12 app in Docker Compose at `/var/www/rc_website`, live at https://www.roboticscorner.tech. Read `ARCHITECTURE.md` for auth/payments/data model; `DEPLOYMENT.md` for the runbook.

## Commands

```bash
cd /var/www/rc_website
docker compose exec -u www-data app php artisan <cmd>          # artisan: ALWAYS -u www-data
docker compose exec -u www-data -e HOME=/tmp app php artisan tinker   # tinker needs writable HOME
docker compose exec app npm run build                          # build: as root (NOT www-data)
docker compose exec app chown -R www-data:www-data storage bootstrap/cache  # fix after any root-run artisan
bash /var/www/ops/domain-smoke-test.sh                         # after nginx/domain/callback changes
```

Running artisan as root silently breaks logging and 500s every request — the #1 recurring incident.

## Hard rules

- **No new Paymob work.** Kashier is the gateway (Paymob = draining legacy webhooks only). All Robotics Corner projects are migrating Paymob → Kashier.
- **MySQL, not SQLite** — legacy PHP pages hardcode a MySQL DSN. New migrations: never add `NOT NULL` columns without defaults for user-optional fields (MySQL strict mode 500s the insert; SQLite tolerated it).
- **`SupabaseRest.php` uses the service-role key** (bypasses RLS) — every query must be scoped to the authenticated user's `supabase_id`.
- **Supabase user metadata:** always set both `name` and `full_name`.
- **PHP mangles cookie dots to underscores** — code reading `sb-*-auth-token` chunk cookies must match both `.N` and `_N`.
- **URLs for sibling apps need their path prefix** (`/connectedlabs/...`, `/robohub/...`, `/roboagent/...`) — bare paths hit Laravel's 404 catch-all.
- **Never hide content behind JS without a no-JS/fallback path** (see `.reveal-on-scroll` in `resources/js/app.js` — regression here shipped blank pages once).

## Map / gotchas

- Landing page is `home.blade.php`; **`welcome.blade.php` is dead code**, don't touch it.
- Tailwind v4 CSS-first: theme lives in `resources/css/app.css` `@theme`, not `tailwind.config.js`.
- `StudentAuthController::login/register` is bypassed legacy auth — real login is client-side Supabase (`resources/js/auth.js`) + `SupabaseAuth` middleware. Don't extend the legacy path.
- Root-level `blog.php` / `admin_*.php` / `db_config.php` are legacy standalone PHP — don't extend.
- Emails currently go to `storage/logs` (`MAIL_MAILER=log`), not to users.
- Screenshots for UI review: host has no Chromium — use Playwright from the scratchpad against `http://localhost:8000`; pages using `.reveal-on-scroll` need scroll + ~2.6s wait or they capture blank.
