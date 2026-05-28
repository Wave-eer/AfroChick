<?php
/**
 * Web migration endpoint (run once after deploy)
 * Optional key: ?key=YOUR_INSTALL_KEY (set INSTALL_KEY in .env)
 */
require_once dirname(__DIR__) . '/includes/env.php';
loadEnv();
require_once dirname(__DIR__) . '/includes/api_helpers.php';

$installKey = getenv('INSTALL_KEY') ?: '';
$provided = $_GET['key'] ?? '';

if ($installKey !== '' && !hash_equals($installKey, $provided)) {
    jsonResponse(['success' => false, 'message' => 'Invalid install key'], 403);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $_SERVER['REQUEST_METHOD'] !== 'GET') {
    jsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
}

$force = isset($_GET['force']) || isset($_POST['force']);

try {
    require_once dirname(__DIR__) . '/includes/migrate.php';
    $log = runMigrations($force);
    jsonResponse(['success' => true, 'log' => $log]);
} catch (Throwable $e) {
    jsonResponse(['success' => false, 'message' => $e->getMessage()], 500);
}
