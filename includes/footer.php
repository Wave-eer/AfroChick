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


                <a href="/index.php" class="navbar-logo">

                    <svg class="afro-logo-svg" width="30" height="30" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <defs>
                        <linearGradient id="logoGoldFooter" x1="0" y1="0" x2="100" y2="100" gradientUnits="userSpaceOnUse">
                          <stop offset="0%" stop-color="#cca43b" />
                          <stop offset="50%" stop-color="#e5c185" />
                          <stop offset="100%" stop-color="#b08c25" />
                        </linearGradient>
                        <linearGradient id="logoTerraFooter" x1="0" y1="100" x2="100" y2="0" gradientUnits="userSpaceOnUse">
                          <stop offset="0%" stop-color="#b55331" />
                          <stop offset="100%" stop-color="#e0c6ad" />
                        </linearGradient>
                      </defs>
                      <path d="M50 12C29.01 12 12 29.01 12 50C12 58.55 14.83 66.45 19.61 72.82C18.15 75.87 18.52 79.57 21.05 82.1C23.98 85.03 28.53 85.39 31.86 83.21C37.07 86.87 43.34 89 50.1 89C57.48 89 64.28 86.41 69.75 82.1C72.83 83.74 76.81 83.33 79.5 80.64C82.19 77.95 82.6 73.97 80.96 70.89C85.83 65.28 89 58 89 50C89 29.01 70.99 12 50 12ZM50 82C32.33 82 18 67.67 18 50C18 32.33 32.33 18 50 18C67.67 18 82 32.33 82 50C82 67.67 67.67 82 50 82Z" fill="url(#logoGoldFooter)" />
                      <path d="M48 35C48 35 52.5 35 54.5 38.5C56.5 42 54 46.5 54 46.5C54 46.5 58.5 47.5 59.5 51C60.5 54.5 56.5 56.5 55 58C53.5 59.5 54.5 62 57 63C59.5 64 58.5 68 54.5 69.5C50.5 71 44.5 70.5 42 64.5C40 59.7 41.5 53.5 44 48" stroke="url(#logoTerraFooter)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                <a href="/" class="navbar-logo">

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

    <script src="<?= ASSETS_URL ?>/js/main.js"></script>


</body>
</html>
