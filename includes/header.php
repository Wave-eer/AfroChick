<?php
require_once __DIR__ . '/config.php';

$meta = page_meta($pageTitle ?? '', $pageDescription ?? '');
$currentPage = $currentPage ?? 'home';
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($meta['description']) ?>">
    <title><?= htmlspecialchars($meta['title']) ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js" defer></script>

    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/style.css">
    <?php if (!empty($extraCss)): ?>
        <?php foreach ((array)$extraCss as $css): ?>
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/<?= htmlspecialchars($css) ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body class="<?= htmlspecialchars($bodyClass ?? '') ?>">
    <!-- Premium Splash Screen -->
    <div class="splash-screen" id="splash-screen">
        <div class="splash-content">
            <div class="splash-logo-container">
                <svg width="100%" height="100%" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <defs>
                    <linearGradient id="splashGold" x1="0" y1="0" x2="100" y2="100" gradientUnits="userSpaceOnUse">
                      <stop offset="0%" stop-color="#cca43b" />
                      <stop offset="50%" stop-color="#e5c185" />
                      <stop offset="100%" stop-color="#b08c25" />
                    </linearGradient>
                    <linearGradient id="splashTerra" x1="0" y1="100" x2="100" y2="0" gradientUnits="userSpaceOnUse">
                      <stop offset="0%" stop-color="#b55331" />
                      <stop offset="100%" stop-color="#e0c6ad" />
                    </linearGradient>
                  </defs>
                  <path d="M50 12C29.01 12 12 29.01 12 50C12 58.55 14.83 66.45 19.61 72.82C18.15 75.87 18.52 79.57 21.05 82.1C23.98 85.03 28.53 85.39 31.86 83.21C37.07 86.87 43.34 89 50.1 89C57.48 89 64.28 86.41 69.75 82.1C72.83 83.74 76.81 83.33 79.5 80.64C82.19 77.95 82.6 73.97 80.96 70.89C85.83 65.28 89 58 89 50C89 29.01 70.99 12 50 12ZM50 82C32.33 82 18 67.67 18 50C18 32.33 32.33 18 50 18C67.67 18 82 32.33 82 50C82 67.67 67.67 82 50 82Z" fill="url(#splashGold)" />
                  <path d="M48 35C48 35 52.5 35 54.5 38.5C56.5 42 54 46.5 54 46.5C54 46.5 58.5 47.5 59.5 51C60.5 54.5 56.5 56.5 55 58C53.5 59.5 54.5 62 57 63C59.5 64 58.5 68 54.5 69.5C50.5 71 44.5 70.5 42 64.5C40 59.7 41.5 53.5 44 48" stroke="url(#splashTerra)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <h1 class="splash-title">AfroChic</h1>
            <p class="splash-subtitle">Tailored Melanin Beauty &amp; Science</p>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const splash = document.getElementById('splash-screen');
            if (splash) {
                if (sessionStorage.getItem('afrochick-splash-shown')) {
                    splash.style.display = 'none';
                } else {
                    setTimeout(function() {
                        splash.classList.add('fade-out');
                        sessionStorage.setItem('afrochick-splash-shown', 'true');
                    }, 1200);
                }
            }
        });
    </script>

    <!-- Navbar -->
    <header class="navbar" id="navbar">
        <div class="navbar-inner">
            <a href="/index.php" class="navbar-logo">
                <svg class="afro-logo-svg" width="30" height="30" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <defs>
                    <linearGradient id="logoGold" x1="0" y1="0" x2="100" y2="100" gradientUnits="userSpaceOnUse">
                      <stop offset="0%" stop-color="#cca43b" />
                      <stop offset="50%" stop-color="#e5c185" />
                      <stop offset="100%" stop-color="#b08c25" />
                    </linearGradient>
                    <linearGradient id="logoTerra" x1="0" y1="100" x2="100" y2="0" gradientUnits="userSpaceOnUse">
                      <stop offset="0%" stop-color="#b55331" />
                      <stop offset="100%" stop-color="#e0c6ad" />
                    </linearGradient>
                  </defs>
                  <path d="M50 12C29.01 12 12 29.01 12 50C12 58.55 14.83 66.45 19.61 72.82C18.15 75.87 18.52 79.57 21.05 82.1C23.98 85.03 28.53 85.39 31.86 83.21C37.07 86.87 43.34 89 50.1 89C57.48 89 64.28 86.41 69.75 82.1C72.83 83.74 76.81 83.33 79.5 80.64C82.19 77.95 82.6 73.97 80.96 70.89C85.83 65.28 89 58 89 50C89 29.01 70.99 12 50 12ZM50 82C32.33 82 18 67.67 18 50C18 32.33 32.33 18 50 18C67.67 18 82 32.33 82 50C82 67.67 67.67 82 50 82Z" fill="url(#logoGold)" />
                  <path d="M48 35C48 35 52.5 35 54.5 38.5C56.5 42 54 46.5 54 46.5C54 46.5 58.5 47.5 59.5 51C60.5 54.5 56.5 56.5 55 58C53.5 59.5 54.5 62 57 63C59.5 64 58.5 68 54.5 69.5C50.5 71 44.5 70.5 42 64.5C40 59.7 41.5 53.5 44 48" stroke="url(#logoTerra)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="logo-text"><?= SITE_NAME ?></span>
            </a>

            <nav class="navbar-nav" id="navbar-nav">
                <a href="/index.php" class="nav-link <?= $currentPage === 'home' ? 'active' : '' ?>">Home</a>
                <a href="/dashboard.php" class="nav-link <?= $currentPage === 'analyze' ? 'active' : '' ?>">Analyze</a>
                <a href="/products.php" class="nav-link <?= $currentPage === 'products' ? 'active' : '' ?>">Products</a>
                <a href="/submit-product.php" class="nav-link <?= $currentPage === 'submit' ? 'active' : '' ?>">Submit</a>
            </nav>

            <div class="navbar-actions">
                <button class="btn-icon theme-toggle" id="theme-toggle" aria-label="Toggle dark mode">
                    <i data-lucide="sun" class="icon-sun"></i>
                    <i data-lucide="moon" class="icon-moon"></i>
                </button>
                <a href="/signup.php" class="btn btn-secondary btn-sm nav-signup" id="nav-signup-btn">Sign up</a>
                <a href="/login.php" class="btn btn-ghost btn-sm nav-login" id="nav-login-btn">Login</a>
                <div class="nav-user-menu hidden" id="nav-user-menu">
                    <span class="nav-user-name" id="nav-user-name">User</span>
                    <a href="/admin/index.php" class="btn btn-ghost btn-sm hidden" id="nav-admin-link">Admin</a>
                    <a href="/dashboard.php" class="btn btn-ghost btn-sm">Analyze</a>
                    <button type="button" class="btn btn-ghost btn-sm" id="nav-logout-btn">Logout</button>
                </div>
                <button class="btn-icon hamburger" id="hamburger" aria-label="Open menu" aria-expanded="false">
                    <i data-lucide="menu"></i>
                </button>
            </div>
        </div>
    </header>

    <main>
