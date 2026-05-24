<?php
$pageTitle = 'Analyze';
$pageDescription = 'Choose skin or hair analysis for personalized recommendations.';
$currentPage = 'analyze';
$bodyClass = 'page-dashboard';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
    <div class="container page-hero-content">
        <span class="section-label">Start analysis</span>
        <h1 class="page-title">What would you like to analyze?</h1>
        <p class="page-subtitle">Choose a guided clinical intake — personalized routines and ingredient guidance in minutes.</p>
    </div>
</section>

<section class="section section-compact">
    <div class="container">
        <div class="analysis-grid">
            <a href="/skin-analysis.php" class="glass-card analysis-card reveal reveal-delay-1">
                <div class="analysis-icon skin">🧴</div>
                <h2>Skin Analysis</h2>
                <p>Understand your skin type, concerns, and sensitivity. Get morning, night, and weekly routines.</p>
                <span class="btn btn-primary">Start skin analysis <i data-lucide="arrow-right"></i></span>
            </a>
            <a href="/hair-analysis.php" class="glass-card analysis-card reveal reveal-delay-2">
                <div class="analysis-icon hair">💆</div>
                <h2>Hair Analysis</h2>
                <p>Map your hair type, scalp health, and lifestyle. Receive targeted actives and product picks.</p>
                <span class="btn btn-primary">Start hair analysis <i data-lucide="arrow-right"></i></span>
            </a>
        </div>
    </div>
</section>

<?php
$extraJs = ['dashboard.js'];
require_once __DIR__ . '/includes/footer.php';
?>
