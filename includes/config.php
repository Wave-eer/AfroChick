<?php
/**
 * Afrochick — Site Configuration
 */
require_once __DIR__ . '/env.php';
loadEnv();

define('SITE_NAME', 'Afrochick');
define('SITE_TAGLINE', 'Skin & Hair Analysis Center');
define('SITE_URL', '/');
define('ASSETS_URL', '/assets');
define('CONTACT_EMAIL', 'hello@afrochick.com');

// Database (Docker: set via docker-compose environment)
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'afrochick');
define('DB_USER', getenv('DB_USER') ?: 'afrochick');
define('DB_PASS', getenv('DB_PASS') ?: 'afrochick_secret');

// Page metadata helper
function page_meta(string $title = '', string $description = ''): array {
    return [
        'title' => $title ? "$title — " . SITE_NAME : SITE_NAME . ' — ' . SITE_TAGLINE,
        'description' => $description ?: 'Clinical-grade skin & hair analysis with personalized routines, nutrients, and ingredient guidance.',
    ];
}
