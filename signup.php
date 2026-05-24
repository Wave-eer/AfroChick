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
