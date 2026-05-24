<?php
$pageTitle = 'Login';
$pageDescription = 'Sign in to your Afrochick account.';
$currentPage = '';
$bodyClass = 'page-auth';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-hero page-hero-sm">
    <div class="container page-hero-content">
        <h1 class="page-title">Welcome back</h1>
        <p class="page-subtitle">Sign in to access your analyses and personalized recommendations.</p>
    </div>
</section>

<section class="section section-compact">
    <div class="container container-narrow">
        <div class="glass-card auth-card reveal">
            <form id="login-form" class="auth-form" novalidate>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" autocomplete="email" required>
                    <span class="field-error" hidden></span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Your password" autocomplete="current-password" required>
                    <span class="field-error" hidden></span>
                </div>
                <div class="form-row-between">
                    <a href="/forgot-password.php" class="form-link">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-primary btn-full">Login</button>
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
                Don't have an account? <a href="/signup.php">Sign up</a>
            </p>
            <p class="auth-demo-note">
                Admin: admin@afrochick.com / admin1234<br>
                User: demo@afrochick.com / demo1234
            </p>
        </div>
    </div>
</section>

<?php
$extraJs = ['login.js'];
require_once __DIR__ . '/includes/footer.php';
?>
