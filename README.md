# Afrochick

Premium Skin Analysis & Hair Protection Center — a luxury dermatology-inspired web application.

## Tech Stack

- **HTML / CSS / JavaScript** — frontend
- **PHP** — server-side includes, form handling, API stubs
- **Supabase** — auth, database, storage (planned; mock data for now)

## Project Structure

```
afrochick/
├── index.php              # Landing page (Home)
├── login.php              # Login
├── signup.php             # Sign up
├── forgot-password.php    # Password reset
├── dashboard.php          # Analyze — skin or hair selection
├── skin-analysis.php      # Skin wizard (stub)
├── hair-analysis.php      # Hair wizard (stub)
├── products.php           # Product center
├── submit-product.php       # Submit product form
```

## Run Locally

### Docker (recommended)

```bash
cd afrochick
docker compose up --build
```

Open [http://localhost:8888](http://localhost:8888)

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
4. Analysis wizards (skin & hair)
5. Admin dashboard
6. Supabase integration
