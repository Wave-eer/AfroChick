<?php
$pageTitle = 'Submit Product';
$pageDescription = 'Submit a product for review in the Afrochick Product Center.';
$currentPage = 'submit';
$bodyClass = 'page-submit';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-hero page-hero-sm">
    <div class="container page-hero-content">
        <span class="section-label">Submit Product</span>
        <h1 class="page-title">Share a product you love</h1>
        <p class="page-subtitle">Our team reviews every submission before it appears in the Product Center.</p>
    </div>
</section>

<section class="section section-compact">
    <div class="container container-narrow">
        <div class="glass-card submit-card reveal" id="submit-form-wrap">
            <form id="submit-form" class="submit-form" enctype="multipart/form-data" novalidate>
                <div class="form-group">
                    <label for="product_name">Product Name *</label>
                    <input type="text" id="product_name" name="product_name" required>
                    <span class="field-error" hidden></span>
                </div>
                <div class="form-group">
                    <label for="category">Category *</label>
                    <select id="category" name="category" required>
                        <option value="">Select category</option>
                    </select>
                    <span class="field-error" hidden></span>
                </div>
                <div class="form-group">
                    <label for="ingredients">Ingredients *</label>
                    <textarea id="ingredients" name="ingredients" rows="3" placeholder="List key ingredients, comma-separated" required></textarea>
                    <span class="field-error" hidden></span>
                </div>
                <div class="form-group">
                    <label for="benefits">Benefits *</label>
                    <textarea id="benefits" name="benefits" rows="2" placeholder="What does this product help with?" required></textarea>
                    <span class="field-error" hidden></span>
                </div>
                <div class="form-group">
                    <label for="description">Description *</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                    <span class="field-error" hidden></span>
                </div>
                <div class="form-group">
                    <label for="image">Product image</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    <span class="field-hint">Optional — stored locally in demo mode</span>
                </div>
                <div class="form-group">
                    <label for="website">Website URL</label>
                    <input type="url" id="website" name="website" placeholder="https://">
                    <span class="field-error" hidden></span>
                </div>
                <div class="form-group">
                    <label for="contact_email">Contact Email *</label>
                    <input type="email" id="contact_email" name="contact_email" required>
                    <span class="field-error" hidden></span>
                </div>
                <button type="submit" class="btn btn-primary btn-full">Submit for review</button>
                <p class="form-message" id="form-message" hidden></p>
            </form>
        </div>

        <div class="glass-card success-card hidden reveal" id="submit-success">
            <div class="success-icon large"><i data-lucide="check-circle"></i></div>
            <h2>Thank you!</h2>
            <p>Your product has been submitted for review. We'll notify you once it's approved.</p>
            <a href="/products.php" class="btn btn-primary">Browse products</a>
            <button type="button" class="btn btn-ghost" id="submit-another">Submit another</button>
        </div>
    </div>
</section>

<?php
$extraJs = ['mockData.js', 'api.js', 'submit-product.js'];
require_once __DIR__ . '/includes/footer.php';
?>
