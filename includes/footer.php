    </main>

    <?php if (!empty($showFloatingCta)): ?>
    <!-- Floating CTA -->
    <a href="/dashboard.php" class="floating-cta" id="floating-cta" aria-label="Start analysis">
        <i data-lucide="sparkles"></i>
        <span>Start analysis</span>
    </a>
    <?php endif; ?>

    <!-- Footer -->
    <footer class="footer">
        <div class="container footer-grid">
            <div class="footer-brand">
                <a href="/index.php" class="navbar-logo">
                    <span class="logo-icon">✦</span>
                    <span class="logo-text"><?= SITE_NAME ?></span>
                </a>
                <p class="footer-tagline">Clinical-grade skin &amp; hair analysis. Personalized, gentle, evidence-informed.</p>
            </div>

            <div class="footer-links">
                <h4>Explore</h4>
                <ul>
                    <li><a href="/skin-analysis.php">Skin Analysis</a></li>
                    <li><a href="/hair-analysis.php">Hair Analysis</a></li>
                    <li><a href="/products.php">Product Center</a></li>
                    <li><a href="/submit-product.php">Submit Product</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h4>Company</h4>
                <ul>
                    <li><a href="#about">About</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>

            <div class="footer-trust">
                <h4>Trust</h4>
                <div class="trust-badges">
                    <span class="trust-badge"><i data-lucide="shield-check"></i> Dermatology-reviewed</span>
                    <span class="trust-badge"><i data-lucide="leaf"></i> Clean ingredients</span>
                    <span class="trust-badge"><i data-lucide="award"></i> Editorially curated</span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container footer-bottom-inner">
                <p>&copy; <?= date('Y') ?> <?= SITE_NAME ?>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="<?= ASSETS_URL ?>/js/api.js"></script>
    <script src="<?= ASSETS_URL ?>/js/auth.js"></script>
    <script src="<?= ASSETS_URL ?>/js/main.js"></script>
    <?php if (!empty($extraJs)): ?>
        <?php foreach ((array)$extraJs as $js): ?>
    <script src="<?= ASSETS_URL ?>/js/<?= htmlspecialchars($js) ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
