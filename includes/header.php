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
</head>
<body>
    <!-- Navbar -->
    <header class="navbar" id="navbar">
        <div class="navbar-inner">
            <a href="/" class="navbar-logo">
                <span class="logo-icon">✦</span>
                <span class="logo-text"><?= SITE_NAME ?></span>
            </a>

            <nav class="navbar-nav" id="navbar-nav">
                <a href="/" class="nav-link <?= $currentPage === 'home' ? 'active' : '' ?>">Home</a>
                <a href="/dashboard.php" class="nav-link <?= $currentPage === 'analyze' ? 'active' : '' ?>">Analyze</a>
                <a href="/products.php" class="nav-link <?= $currentPage === 'products' ? 'active' : '' ?>">Products</a>
                <a href="/submit-product.php" class="nav-link <?= $currentPage === 'submit' ? 'active' : '' ?>">Submit</a>
            </nav>

            <div class="navbar-actions">
                <button class="btn-icon theme-toggle" id="theme-toggle" aria-label="Toggle dark mode">
                    <i data-lucide="sun" class="icon-sun"></i>
                    <i data-lucide="moon" class="icon-moon"></i>
                </button>
                <a href="/login.php" class="btn btn-ghost btn-sm nav-login">Login</a>
                <button class="btn-icon hamburger" id="hamburger" aria-label="Open menu" aria-expanded="false">
                    <i data-lucide="menu"></i>
                </button>
            </div>
        </div>
    </header>

    <main>
