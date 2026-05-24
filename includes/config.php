<?php
/**
 * Afrochick — Site Configuration
 */

define('SITE_NAME', 'Afrochick');
define('SITE_TAGLINE', 'Skin & Hair Analysis Center');
define('SITE_URL', '/');
define('ASSETS_URL', '/assets');
define('CONTACT_EMAIL', 'hello@afrochick.com');

// Page metadata helper
function page_meta(string $title = '', string $description = ''): array {
    return [
        'title' => $title ? "$title — " . SITE_NAME : SITE_NAME . ' — ' . SITE_TAGLINE,
        'description' => $description ?: 'Clinical-grade skin & hair analysis with personalized routines, nutrients, and ingredient guidance.',
    ];
}
