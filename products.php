<?php
$pageTitle = 'Product Center';
$pageDescription = 'Browse approved skincare and haircare products curated for your needs.';
$currentPage = 'products';
$bodyClass = 'page-products';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-hero page-hero-sm">
    <div class="container page-hero-content">
        <span class="section-label">Product Center</span>
        <h1 class="page-title">Curated for your skin &amp; hair</h1>
        <p class="page-subtitle">Ingredient-first products, dermatology-reviewed and editorially approved.</p>
    </div>
</section>

<section class="section section-compact">
    <div class="container">
        <div class="products-toolbar reveal">
            <div class="search-wrap">
                <i data-lucide="search"></i>
                <input type="search" id="product-search" placeholder="Search products or ingredients…" aria-label="Search products">
            </div>
            <div class="category-tabs" id="category-tabs" role="tablist"></div>
        </div>

        <div class="products-grid" id="products-grid"></div>
        <p class="empty-state hidden" id="products-empty">No products match your search.</p>
    </div>
</section>

<!-- Product Modal -->
<div class="modal-overlay hidden" id="product-modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
    <div class="modal glass-card">
        <button class="modal-close btn-icon" id="modal-close" aria-label="Close">
            <i data-lucide="x"></i>
        </button>
        <div class="modal-body" id="modal-body"></div>
    </div>
</div>

<?php
$extraJs = ['mockData.js', 'api.js', 'admin-store.js', 'products.js'];
require_once __DIR__ . '/includes/footer.php';
?>
