<?php
$pageTitle = 'Sign Up';
$pageDescription = 'Create your Afrochick account.';
$currentPage = '';
$bodyClass = 'page-auth';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-hero page-hero-sm">
    <div class="container page-hero-content">
        <h1 class="page-title">Create your account</h1>
        <p class="page-subtitle">Join Afrochick for personalized skin and hair guidance.</p>
    </div>
</section>

<section class="section section-compact">
    <div class="container container-narrow">
        <div class="glass-card auth-card reveal">
            <!-- Premium Center Logo -->
            <div style="text-align: center; margin-bottom: 2rem;">
                <svg width="48" height="48" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" style="filter: drop-shadow(0 4px 10px rgba(212, 175, 55, 0.25)); margin: 0 auto;">
                  <defs>
                    <linearGradient id="authGold" x1="0" y1="0" x2="100" y2="100" gradientUnits="userSpaceOnUse">
                      <stop offset="0%" stop-color="#cca43b" />
                      <stop offset="50%" stop-color="#e5c185" />
                      <stop offset="100%" stop-color="#b08c25" />
                    </linearGradient>
                    <linearGradient id="authTerra" x1="0" y1="100" x2="100" y2="0" gradientUnits="userSpaceOnUse">
                      <stop offset="0%" stop-color="#b55331" />
                      <stop offset="100%" stop-color="#e0c6ad" />
                    </linearGradient>
                  </defs>
                  <path d="M50 12C29.01 12 12 29.01 12 50C12 58.55 14.83 66.45 19.61 72.82C18.15 75.87 18.52 79.57 21.05 82.1C23.98 85.03 28.53 85.39 31.86 83.21C37.07 86.87 43.34 89 50.1 89C57.48 89 64.28 86.41 69.75 82.1C72.83 83.74 76.81 83.33 79.5 80.64C82.19 77.95 82.6 73.97 80.96 70.89C85.83 65.28 89 58 89 50C89 29.01 70.99 12 50 12ZM50 82C32.33 82 18 67.67 18 50C18 32.33 32.33 18 50 18C67.67 18 82 32.33 82 50C82 67.67 67.67 82 50 82Z" fill="url(#authGold)" />
                  <path d="M48 35C48 35 52.5 35 54.5 38.5C56.5 42 54 46.5 54 46.5C54 46.5 58.5 47.5 59.5 51C60.5 54.5 56.5 56.5 55 58C53.5 59.5 54.5 62 57 63C59.5 64 58.5 68 54.5 69.5C50.5 71 44.5 70.5 42 64.5C40 59.7 41.5 53.5 44 48" stroke="url(#authTerra)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <h3 style="font-family: var(--font-heading); font-size: 1.5rem; margin-top: 0.5rem; color: var(--text);">AfroChic</h3>
            </div>
            <form id="signup-form" class="auth-form" novalidate>
                <div class="form-group">
                    <label for="name">Full name</label>
                    <input type="text" id="name" name="name" placeholder="Your full name" autocomplete="name" required>
                    <span class="field-error" hidden></span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" autocomplete="email" required>
                    <span class="field-error" hidden></span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="At least 8 characters" autocomplete="new-password" required>
                    <span class="field-error" hidden></span>
                </div>
                <div class="form-group">
                    <label for="confirm">Confirm password</label>
                    <input type="password" id="confirm" name="confirm" placeholder="Repeat your password" autocomplete="new-password" required>
                    <span class="field-error" hidden></span>
                </div>
                <button type="submit" class="btn btn-primary btn-full">Sign up</button>
                <p class="form-message" id="form-message" hidden></p>
            </form>

            <div class="auth-divider"><span>or continue with</span></div>

            <div class="social-buttons">
                <button type="button" class="btn btn-secondary btn-full social-btn" disabled>
                    <i data-lucide="chrome"></i> Google
                </button>
                <button type="button" class="btn btn-secondary btn-full social-btn" disabled>
                    <i data-lucide="apple"></i> Apple
                </button>
            </div>
            <p class="social-note">Social login coming soon</p>

            <p class="auth-footer-text">
                Already have an account? <a href="/login.php">Login</a>
            </p>
        </div>
    </div>
</section>

<?php
$extraJs = ['signup.js'];
require_once __DIR__ . '/includes/footer.php';
?>
