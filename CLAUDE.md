# CLAUDE.md - Project Guide

## Project Overview
Immigration consultation booking system (IKIC) built on CodeIgniter 3.x. Two user types: applicants (paid booking via Stripe) and employers (free booking). Admin dashboard for appointment and slot management.

## Build & Run
- **Local dev:** XAMPP with Apache + MySQL. Access via `https://localhost/ikic.ca/`
- **No build step** — plain PHP, no compilation needed
- **Composer:** `composer install` for dev dependencies (PHPUnit only)
- **Database:** MySQL `ikic_db` — see `application/migrations/` for schema

## Architecture Conventions
- **Base controllers:** `MY_Controller` (public pages), `Admin_Controller` (auth-required admin pages)
- **Service layer:** Business logic in `application/libraries/*_service.php` — controllers stay thin
- **Models:** `Booking_model` base class with table-name parameterization; subclassed per user type
- **Config from env:** All secrets loaded from `.env` via `env()` helper — never hardcode credentials
- **Routes:** Grouped by concern in `config/routes.php` — admin/, api/, cron/, service/

## Code Style
- CI3 naming conventions: controllers PascalCase, models PascalCase, helpers snake_case
- Use `$this->json_success()` / `$this->json_error()` for JSON responses (defined in MY_Controller)
- Use `$this->post('key')` for XSS-safe trimmed POST input
- Validate all user input with CI3's `form_validation` library
- Log payments and auth events with `log_message()`
