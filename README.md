# MV Industrial & Mining Supplies Limited — Website

Corporate marketing site for **MV Industrial & Mining Supplies Limited**, a Zambian-owned industrial and mining supplies, labour hire, procurement, construction and mechanical engineering company based in Kitwe, Copperbelt.

Built with Laravel (Blade views, no SPA), Vite and Tailwind CSS.

## Features

- Home, Services, Service detail, Products, About and Contact pages
- Contact enquiry form that emails the team (`ContactController` → `ContactEnquiry` mailable), rate-limited to 5 submissions/minute
- All company content (contact details, services, products, clients, values, stats, etc.) centralised in [`config/company.php`](config/company.php) — update copy there rather than in the Blade views
- Floating WhatsApp chat button and WhatsApp links sourced from the same config
- Responsive layout with a shared header/footer across all pages

## Tech stack

- PHP 8.3+, Laravel 13
- Blade templates
- Vite + Tailwind CSS 4
- SQLite by default for local development (sessions, cache and queue tables)

## Getting started

### Requirements

- PHP 8.3+
- Composer

### Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
```

### Running locally

```bash
php artisan serve
```

The site is then available at the URL printed by `php artisan serve` (defaults to `http://localhost:8000`).

### Front-end assets

There is no build step. The stylesheets are hand-authored CSS partials pulled
together by `public/css/app.css`, and the scripts are native ES modules
imported by `public/js/app.js`. Edit the files in place and reload.

The layout appends a cache-busting query string derived from the newest file
mtime across `public/css` and `public/js` (see
[`app/Support/Assets.php`](app/Support/Assets.php)), and `public/.htaccess`
marks CSS and JS `no-cache` so the imported partials revalidate too.

## Configuration

Copy `.env.example` to `.env` and set:

- `APP_URL` — the site's public URL
- `MAIL_*` — an SMTP (or other) mailer so contact form enquiries actually deliver; the default `log` mailer just writes emails to the log file

Company details, navigation, services, products, client logos and social/WhatsApp links live in [`config/company.php`](config/company.php). Contact enquiries are sent to `contact.email` from that file.

## Project structure

```
app/Http/Controllers/    Page and contact form controllers
app/Mail/                Contact enquiry mailable
app/Support/Assets.php   Cache-busting version for the CSS and JS entry points
config/company.php       All site content and company details
resources/views/         Blade templates (pages, sections, partials)
public/assets/           Images, logos and client marks
public/css/              Design tokens, base, primitives, components, pages
public/js/               ES modules: nav, listbox, products, modal
routes/web.php           Route definitions
```

## Testing

```bash
php artisan test
```
