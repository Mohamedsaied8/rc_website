# Go-Live Checklist — Robotics Corner

Most production hardening is already done in the codebase. The items below need
**your** input (domain, certificates, credentials) and must be completed before
pointing a real domain at the site.

## 1. Domain & HTTPS (required)
- [ ] Point your domain's DNS A record to the server (`72.60.214.152`).
- [ ] Set `APP_URL=https://yourdomain.tld` in `.env`.
- [ ] Provision TLS certificates (e.g. Certbot/Let's Encrypt or Cloudflare) and add
      a `listen 443 ssl;` server block in `docker/nginx/conf.d/app.conf` (with an
      80→443 redirect). Publish port 443 on the `web` service in `docker-compose.yml`.
- [ ] Once HTTPS is live, flip these in `.env`:
      - `FORCE_HTTPS=true`
      - `SESSION_SECURE_COOKIE=true`
- [ ] Update `Sitemap:` URL in `public/robots.txt` to your real domain.

## 2. Email / SMTP (required for notifications)
Enrollment confirmations, contact-form alerts, and password-reset links are wired
up but currently use the `log` mailer (they are written to `storage/logs`, NOT sent).
- [ ] In `.env` set `MAIL_MAILER=smtp` and real SMTP creds (`MAIL_HOST`, `MAIL_PORT`,
      `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_ENCRYPTION`).
- [ ] Confirm `MAIL_FROM_ADDRESS` and `MAIL_ADMIN_ADDRESS` are correct.
- [ ] Send a test (enroll or contact) and confirm delivery.

## 3. Database (mostly done)
- [x] MySQL port is now bound to `127.0.0.1` only (not public).
- [x] `MYSQL_ALLOW_EMPTY_PASSWORD` removed; `DB_ROOT_PASSWORD` required.
- [ ] The **live** root account still has a blank password (a Docker volume keeps its
      original init). Set it once:
      ```
      docker exec -it robotics-corner-mysql mysql -uroot
      ALTER USER 'root'@'%' IDENTIFIED BY '<DB_ROOT_PASSWORD from .env>';
      ALTER USER 'root'@'localhost' IDENTIFIED BY '<DB_ROOT_PASSWORD from .env>';
      FLUSH PRIVILEGES;
      ```
- [ ] Set up scheduled `mysqldump` backups of the `dbdata` volume.

## 4. Admin accounts
- [x] Seeded weak passwords (`admin123` / `courses123`) have been reset to strong
      random values (delivered separately — change them after first login).
- [ ] For future seeds, set `ADMIN_EMAIL` and `ADMIN_PASSWORD` in `.env`
      (the seeder now reads them and never ships a known password).

## 5. Paymob (verify)
- [x] Live API key, integration id (5418408), iframe id (983651) and HMAC are in `.env`.
- [ ] Set the Paymob dashboard **Transaction Processed Callback** and **Response
      Callback** to `https://yourdomain.tld/payment/callback` and `/payment/return`.
- [ ] Run one real (or test-mode) card payment end-to-end and confirm the enrollment's
      `payment_status` flips to `paid` in the admin panel. (This also confirms the API
      key was transcribed correctly.)

## 6. Content / config to confirm
- [ ] Set the **freelance / RoboHub** link: add a `freelance_link` site setting (admin
      → settings) or it will fall back to the contact page.
- [ ] Set real footer social URLs (LinkedIn/GitHub/Twitter) in the CMS, or they stay hidden.
- [ ] (Optional) Add `public/images/og-image.png` (1200×630) for nicer link previews;
      falls back to the logo otherwise.

## 7. Production caching (on each deploy)
```
docker exec robotics-corner-app php artisan config:cache
docker exec robotics-corner-app php artisan route:cache
docker exec robotics-corner-app php artisan view:cache
docker exec robotics-corner-app php artisan event:cache
npm run build
```
(Clear with `php artisan optimize:clear` when changing `.env`.)

## Already handled in code
- Removed secret-leaking `/test` & `/test2` routes.
- `APP_ENV=production`, `APP_DEBUG=false`, `LOG_LEVEL=warning`, daily logs.
- Rate limiting on login/register/contact/enroll/admin-login.
- Payment status bug fixed (`payment_status` column + txn/order IDs + amount check).
- Paymob webhook CSRF-exempt (HMAC-verified) + trusted proxies configured.
- Upload validation tightened (no SVG in web root).
- GTM wired, OG/Twitter/canonical meta, sitemap.xml, custom error pages.
- Password reset flow, enrollment/contact email notifications.
- Fixed Connected Labs link; dead coupon/quote stubs removed; fake homepage stats replaced.
- nginx security headers + dotfile protection; storage symlinked.
