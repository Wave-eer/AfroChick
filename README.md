# Afrochick

Premium Skin Analysis & Hair Protection Center — a luxury dermatology-inspired web application.

## Tech Stack

- **HTML / CSS / JavaScript** — frontend
- **PHP 8.3** — API & server-side includes
- **MySQL 8** — database `afrochick` (users, products, submissions, analyses, newsletter)

## Database

MySQL database **`afrochick`** with tables:

| Table | Purpose |
|-------|---------|
| `users` | Accounts (bcrypt passwords) |
| `products` | Product catalog |
| `product_submissions` | Public submit form |
| `analyses` | Skin/hair analysis log |
| `newsletter_subscribers` | Newsletter emails |
| `admin_settings` | Admin preferences (JSON) |

Schema: `database/schema.sql` — auto-applied on first Docker start.

Seed data (demo user, admin, 10 products) runs automatically when `users` table is empty.

**Credentials (Docker):**

| | |
|--|--|
| Database | `afrochick` |
| User | `afrochick` |
| Password | `afrochick_secret` |
| Host (from web container) | `db` |
| Host (from your machine) | `localhost:3307` |

Check connection: [http://localhost:8888/api/health.php](http://localhost:8888/api/health.php)

## Project Structure

```
afrochick/
├── admin/
│   ├── index.php          # Analytics dashboard
│   ├── products.php       # Product CRUD
│   └── settings.php       # Profile, password, preferences

├── database/
│   └── schema.sql         # MySQL tables
├── api/                   # JSON REST API → MySQL
=======

├── index.php              # Landing page (Home)

├── login.php              # Login
├── signup.php             # Sign up
├── forgot-password.php    # Password reset
├── dashboard.php          # Analyze — skin or hair selection
├── skin-analysis.php      # Skin wizard (stub)
├── hair-analysis.php      # Hair wizard (stub)
├── products.php           # Product center
├── submit-product.php       # Submit product form

├── index.php              # Landing page
├── includes/
│   ├── config.php         # Site constants & helpers
│   ├── header.php         # Navbar, <head>, opening layout
│   └── footer.php         # Footer, scripts
├── assets/
│   ├── css/
│   │   └── style.css      # Design system & page styles
│   └── js/
│       └── main.js        # Interactions & animations
├── api/
│   └── newsletter.php     # Newsletter subscription endpoint
├── login.php              # (planned) Auth
├── signup.php             # (planned) Auth
├── dashboard.php          # (planned) Category selection
├── skin-analysis.php      # (planned) Skin wizard
├── hair-analysis.php      # (planned) Hair wizard
├── products.php           # (planned) Product center
├── submit-product.php     # (planned) Product submission
└── admin/                 # (planned) Admin dashboard

```

## Run Locally

### Docker (recommended)

```bash
cd afrochick
docker compose up --build -d
```

Wait until MySQL is healthy (~30s on first run), then open [http://localhost:8888](http://localhost:8888)


**Admin:** `admin@afrochick.com` / `admin1234` → `/admin/index.php`


### PHP built-in server

Requires PHP 8+:

```bash
cd afrochick
php -S localhost:8080
```

Open [http://localhost:8888](http://localhost:8888)

## Design

- Medical-luxury aesthetic with sage green, beige, and light blue palette
- Glassmorphism cards, soft gradients, floating product animations
- DM Sans (body) + Playfair Display (headings)
- Dark mode via CSS class toggle
- Mobile-first responsive layout

## Build Roadmap

1. ✅ Landing page
2. ✅ Auth pages (login, signup, forgot password)
3. ✅ Dashboard (Analyze) + product pages

4. ✅ Admin dashboard
5. Analysis wizards (skin & hair)

4. Analysis wizards (skin & hair)

2. Auth pages (login, signup, forgot password)
3. Dashboard & analysis wizards
4. Product center & submission

5. Admin dashboard

6. Supabase integration

