<?php
$pageTitle = 'Forgot Password';
$pageDescription = 'Reset your Afrochick password.';
$currentPage = '';
$bodyClass = 'page-auth';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-hero page-hero-sm">
    <div class="container page-hero-content">
        <h1 class="page-title">Reset password</h1>
        <p class="page-subtitle">Enter your email and we'll send you a reset link.</p>
    </div>
</section>

<section class="section section-compact">
    <div class="container container-narrow">
        <div class="glass-card auth-card reveal">
            <form id="forgot-form" class="auth-form" novalidate>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" autocomplete="email" required>
                    <span class="field-error" hidden></span>
                </div>
                <button type="submit" class="btn btn-primary btn-full">Send reset link</button>
                <p class="form-message" id="form-message" hidden></p>
            </form>

            <div class="success-state hidden" id="success-state">
                <div class="success-icon"><i data-lucide="mail-check"></i></div>
                <h3>Check your inbox</h3>
                <p>We've sent a password reset link to your email. (Demo: no email is actually sent.)</p>
            </div>

            <p class="auth-footer-text">
                <a href="/login.php">← Back to login</a>
            </p>
        </div>
    </div>
</section>

<?php
$extraJs = ['forgot-password.js'];
require_once __DIR__ . '/includes/footer.php';
?>
