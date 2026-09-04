# Robotics Corner Website (`rc_website`)

The main **Robotics Corner** website — marketing site + student portal, live at **https://www.roboticscorner.tech**.

What it does:
- Public pages: home, about, services (incl. bespoke R&D pages), products, programs, freelance, contact
- Student portal: register/login (Supabase SSO), enroll in programs, pay online (Kashier) or manually (wallet/InstaPay), profile
- Blog: user-submitted posts with admin moderation
- Admin panel (`/admin`): courses, programs, cohorts, enrollments, blog moderation, contact messages, CMS pages with inline editing

It is one of four Robotics Corner apps served from a single origin behind one host nginx (`rc_website` at `/`, plus `/connectedlabs`, `/robohub`, `/roboagent`). They share a Supabase project for SSO — see [ARCHITECTURE.md](ARCHITECTURE.md).

## Tech stack

- **Laravel 12** (PHP 8.2) — the main app
- **Legacy standalone PHP** (`blog.php`, `blog_admin.php`, `db_config.php`, …) — old blog/admin pages that talk to MySQL directly; still present, kept for compatibility
- **Vite 7 + Tailwind CSS v4** (CSS-first config in `resources/css/app.css`), Alpine.js, Font Awesome 6 (CDN)
- **MySQL 8** (Docker), **Supabase** (auth + cross-app data), **Kashier** (payments; Paymob legacy)
- **Docker Compose**: nginx (`:8000`) + php-fpm + MySQL (`127.0.0.1:33061`)

## Running locally

```bash
git clone https://github.com/ahmed-codics/rc_website.git
cd rc_website
cp .env.example .env        # then fill in DB passwords, Supabase keys, Kashier keys
docker compose up -d --build
docker compose exec app composer install
docker compose exec -u www-data app php artisan key:generate
docker compose exec -u www-data app php artisan migrate
docker compose exec app npm install
docker compose exec app npm run build
docker compose exec app chown -R www-data:www-data storage bootstrap/cache
```

Site is then at http://localhost:8000.

> ⚠️ Run `php artisan` as **www-data** (`-u www-data`) but `npm run build` as **root**. Getting this backwards breaks the site — see [DEPLOYMENT.md](DEPLOYMENT.md#permissions--the-1-source-of-500s).

Use **MySQL**, not SQLite: the legacy PHP pages hardcode a MySQL DSN and the compose stack provisions it (`DB_HOST=db`).

## Documentation map

| Doc | What's in it |
|---|---|
| [DEPLOYMENT.md](DEPLOYMENT.md) | Production server, deploy steps, restarts, logs, gotchas |
| [ARCHITECTURE.md](ARCHITECTURE.md) | Auth/SSO, payments, data model, env vars, cross-app integration |
| [CLAUDE.md](CLAUDE.md) | Conventions and gotchas for AI-assisted development |
| `GO-LIVE.md` | Original go-live checklist (mostly done; SMTP still pending) |
| `BLOG_SETUP.md`, `DEPLOYMENT_GUIDE.md`, `FILE_MANAGER_README.md`, `SLAM_POST_README.md` | **Legacy** docs for the old standalone-PHP blog system — historical reference only |
