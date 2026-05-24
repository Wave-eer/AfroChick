<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';

$meta = page_meta(($adminTitle ?? 'Admin') . ' Dashboard', 'Afrochick admin panel');
$adminPage = $adminPage ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($meta['title']) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js" defer></script>
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/style.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/admin.css">
</head>
<body class="admin-body">
<div class="admin-layout">
    <aside class="admin-sidebar" id="admin-sidebar">
        <a href="/admin/index.php" class="admin-brand">
            <span class="logo-icon">✦</span>
            <span><?= SITE_NAME ?></span>
            <small>Admin</small>
        </a>
        <nav class="admin-nav">
            <a href="/admin/index.php" class="admin-nav-link <?= $adminPage === 'dashboard' ? 'active' : '' ?>">
                <i data-lucide="layout-dashboard"></i> Dashboard
            </a>
            <a href="/admin/products.php" class="admin-nav-link <?= $adminPage === 'products' ? 'active' : '' ?>">
                <i data-lucide="package"></i> Products
            </a>
            <a href="/admin/users.php" class="admin-nav-link <?= $adminPage === 'users' ? 'active' : '' ?>">
                <i data-lucide="users"></i> Users
            </a>
            <a href="/admin/settings.php" class="admin-nav-link <?= $adminPage === 'settings' ? 'active' : '' ?>">
                <i data-lucide="settings"></i> Settings
            </a>
        </nav>
        <div class="admin-sidebar-footer">
            <a href="/index.php" class="admin-nav-link">
                <i data-lucide="external-link"></i> View site
            </a>
            <button type="button" class="admin-nav-link admin-logout" id="admin-logout">
                <i data-lucide="log-out"></i> Logout
            </button>
        </div>
    </aside>
    <div class="admin-main">
        <header class="admin-topbar">
            <button type="button" class="btn-icon admin-menu-toggle" id="admin-menu-toggle" aria-label="Toggle menu">
                <i data-lucide="menu"></i>
            </button>
            <div class="admin-topbar-title">
                <h1><?= htmlspecialchars($adminHeading ?? 'Dashboard') ?></h1>
                <?php if (!empty($adminSubheading)): ?>
                    <p><?= htmlspecialchars($adminSubheading) ?></p>
                <?php endif; ?>
            </div>
            <div class="admin-topbar-actions">
                <button type="button" class="btn-icon theme-toggle" id="theme-toggle" aria-label="Toggle dark mode">
                    <i data-lucide="sun" class="icon-sun"></i>
                    <i data-lucide="moon" class="icon-moon"></i>
                </button>
                <div class="admin-user-chip" id="admin-user-chip">Admin</div>
            </div>
        </header>
        <div class="admin-content">
