# WinCart (winscart)


### UAE Ecommerce & courier Operations Platform

Full-featured ecommerce, fulfillment, inventory, courier, and operational management system built with Laravel 9.

---

# Overview

WinCart is a UAE-focused ecommerce and operational management platform designed for high-volume order processing, inventory management, courier integrations, reporting, and fulfillment workflows.

The platform combines:

- Ecommerce storefront
- Inventory & warehouse management
- courier operations
- CRM-style order handling
- Driver assignment workflows
- Reporting & analytics
- Product bundles & SKU combinations
- Stripe payment integration

Built using Laravel 9 monolith architecture with Blade, Tailwind CSS, Alpine.js, and Vite.

---

# Features

## Ecommerce Storefront

- Home, shop, and category pages
- Advanced product search
- Product detail pages
- Product bundles
- Cart & checkout system
- Stripe payment integration
- Customer authentication
- Phone-based customer flow
- Contact forms
- Dynamic promotions & coupons

---

## Product & Inventory Management

- Product CRUD
- Product bundle management
- SKU combinations & variants
- Attributes & attribute values
- Inventory tracking
- Consumables management
- Barcode generation
- Product image galleries
- Banner management

---

## Order Management

- Order creation & editing
- CRM-style order views
- Order notes & activity logs
- Invoice PDF generation
- Barcode invoices
- Order status workflows
- Missing orders management
- Bulk order operations
- Excel import/export
- RMA & returns management

---

## Courier Integrations

- J&T Express integration
- Tawseel integration
- iMile workflows
- Driver assignment system
- Store packing flows
- RTO handling
- Courier webhook support
- Delivery status synchronization

---

## Admin Dashboard & Reporting

- Sales reports
- Operational reports
- Dashboard filters
- Ads report uploads
- Charts & analytics
- User activity logs
- Performance tracking

---

## Authentication & Permissions

- Laravel Sanctum API authentication
- Role-based access control
- Spatie Laravel Permission integration
- Admin authorization flows
- Driver login APIs

---

# Tech Stack

| Category | Technology |
|---|---|
| Backend | Laravel 9 |
| Language | PHP ^8.0.2 |
| Frontend | Blade |
| Styling | Tailwind CSS 3 |
| Build Tool | Vite 3 |
| UI Interactions | Alpine.js |
| API Auth | Laravel Sanctum |
| Database | MySQL |
| Payments | Stripe |
| HTTP Client | Guzzle |
| Charts | Chart.js |
| Real-time | Pusher |

---

# Project Structure

```bash
app/
├── Http/
│   ├── Controllers/
│   ├── Middleware/
│   └── Requests/
│
├── Models/
├── Helpers/
│
routes/
├── web.php
├── api.php
│
database/
├── migrations/
├── seeders/
│
resources/
├── views/
├── js/
├── css/
```

---

# API Features

- Driver authentication
- Assigned order APIs
- Order status updates
- Courier webhooks
- add_to_order endpoint
- Sanctum protected routes

---

# Quick Setup

## Requirements

- PHP 8.0+
- Composer
- Node.js 16+
- MySQL

---

## Installation

### Clone Repository

```bash
git clone git@github-default:Jd-developer302/winscart-ecommerce.git
```

### Install Dependencies

```bash
composer install
npm install
```

### Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Configure:

- Database credentials
- Stripe keys
- Mail configuration
- Pusher credentials
- Courier API keys

---

## Database Setup

```bash
php artisan migrate
php artisan db:seed
```

---

## Frontend Assets

```bash
npm run dev
```

Production build:

```bash
npm run build
```

---

## Run Application

```bash
php artisan serve
```

---

# Notable Packages

| Area | Package |
|---|---|
| PDF Invoices | barryvdh/laravel-dompdf |
| Excel Import/Export | maatwebsite/excel |
| Permissions | spatie/laravel-permission |
| Activity Logs | spatie/laravel-activitylog |
| Payments | stripe/stripe-php |
| Barcode Generator | picqer/php-barcode-generator |
| API Authentication | laravel/sanctum |
| Blade Forms | laravelcollective/html |

---

# Business Workflows

## Supported Operations

- Ecommerce operations
- Inventory management
- Fulfillment workflows
- Courier assignment
- Delivery management
- Returns management
- Operational reporting

# Development Notes

- Follow existing controller and Blade patterns
- Preserve UAE-centric order workflows
- Do not bypass permissions logic
- Maintain existing SKU and bundle semantics
- Keep feature scope isolated when implementing changes

---

# Deployment Stack

Recommended production stack:

- Ubuntu Server
- Nginx
- PHP-FPM
- MySQL
- Redis
- Supervisor
- SSL (Cloudflare / Nginx)

---

# License

MIT License