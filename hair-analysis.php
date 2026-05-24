<?php
$pageTitle = 'Hair Analysis';
$currentPage = 'analyze';
$bodyClass = 'page-wizard';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-hero page-hero-sm">
    <div class="container page-hero-content">
        <h1 class="page-title">Hair Analysis</h1>
        <p class="page-subtitle">Coming next — multi-step clinical intake wizard.</p>
        <a href="/dashboard.php" class="btn btn-secondary">← Back to Analyze</a>
    </div>
</section>

<?php
$extraJs = ['dashboard.js'];
require_once __DIR__ . '/includes/footer.php';
?>
