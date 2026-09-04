# Deployment — rc_website

Production runbook. Read this before touching the server.

## Where it lives

| Thing | Value |
|---|---|
| Server | Hostinger VPS `72.60.214.152` |
| Path | `/var/www/rc_website` (git clone of `main`, https://github.com/ahmed-codics/rc_website.git) |
| Runtime | Docker Compose (this repo's `docker-compose.yml`) |
| Containers | `robotics-corner-nginx` (→ host `:8000`), `robotics-corner-app` (php-fpm 8.2), `robotics-corner-mysql` (MySQL 8 → `127.0.0.1:33061`, db/user `laravel`) |
| Public URL | https://www.roboticscorner.tech (host nginx proxies `/` → `127.0.0.1:8000`) |
| Host nginx vhost | `/etc/nginx/sites-available/roboticscorner` — also mounts the sibling apps at `/connectedlabs`, `/robohub`, `/roboagent` |
| TLS | Let's Encrypt (`certbot --nginx`), auto-renew via `certbot.timer` |

The MySQL port is bound to localhost only — never expose it publicly.

## Deploying a change

```bash
cd /var/www/rc_website
git pull origin main
docker compose exec app composer install --no-dev        # only if composer.json changed
docker compose exec -u www-data app php artisan migrate  # only if new migrations
docker compose exec app npm run build                    # only if JS/CSS changed (as root!)
docker compose exec -u www-data app php artisan config:clear
docker compose exec -u www-data app php artisan view:clear
```

No process restart is needed for PHP changes (php-fpm picks them up). If `.env` changed, `config:clear` is required.

Then smoke-test: `bash /var/www/ops/domain-smoke-test.sh` — checks every app on the domain answered with the *right* `<title>`, not just a 200. Run it after **any** nginx, domain, or callback-URL change.

## Permissions — the #1 source of 500s

php-fpm runs as **www-data**, but `docker compose exec app ...` runs as **root**.

- **`php artisan` → always as www-data:** `docker compose exec -u www-data app php artisan ...`
  Running artisan as root creates root-owned files under `storage/` (esp. `storage/logs/laravel.log`) → php-fpm can't write → **every request 500s and the error can't even be logged**.
- **`php artisan tinker` → add a writable HOME:** `docker compose exec -u www-data -e HOME=/tmp app php artisan tinker`
- **`npm run build` → as root** (the opposite!): `node_modules` is root-owned, so www-data hits EACCES. Build output is read-only for php-fpm, so root ownership there is fine.

If the site 500s with an empty/stale log, this is almost certainly it. Fix:

```bash
docker compose exec app chown -R www-data:www-data storage bootstrap/cache
```

## When something is down

```bash
cd /var/www/rc_website
docker compose ps                        # are all 3 containers up?
docker compose logs --tail=50 app web db
docker compose restart                   # restart the stack
docker compose up -d --build             # rebuild after Dockerfile/compose changes
tail -50 storage/logs/laravel.log        # app-level errors
sudo nginx -t && sudo systemctl reload nginx   # host nginx (after vhost edits)
```

Containers have `restart: unless-stopped`, so they survive reboots on their own.

## Server-wide gotchas

- This box also serves `72.60.214.152.nip.io` and `talent.roboticscorner.cloud` vhosts. **Any new domain needs its own `listen 443` block**, or requests fall through to the nip.io SSL block and browsers show `ERR_CERT_COMMON_NAME_INVALID`.
- Laravel's `location /` is the nginx catch-all for the whole origin. A sibling app generating a URL without its path prefix (`/connectedlabs/...`) lands on Laravel's 404. Payment-callback URLs are the classic victim — see ARCHITECTURE.md.
- MySQL runs in strict mode. The schema was originally written for SQLite, so watch for optional columns declared `NOT NULL` without a default — they 500 the insert on MySQL when left blank (fixed for `enrollments` in migration `2026_07_08_120100`; the pattern may lurk in other tables).

## Known pending items

- `MAIL_MAILER=log` — enrollment confirmations, contact alerts, and password resets are written to `storage/logs`, **not actually sent**. Real SMTP is still TODO (see GO-LIVE.md §2).
- `FORCE_HTTPS=false` and `SESSION_SECURE_COOKIE` not yet flipped, even though TLS is live (host nginx handles the redirect).
- Kashier is in **test mode** (`KASHIER_MODE=test`); refunds are disabled until Kashier support confirms the canonical endpoint (`KASHIER_REFUND_ENDPOINT` deliberately blank).
