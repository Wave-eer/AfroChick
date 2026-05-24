<?php
require_once dirname(__DIR__) . '/includes/api_helpers.php';
apiBootstrap();

try {
    $pdo = db();
    $pdo->query('SELECT 1');
    jsonResponse(['success' => true, 'database' => DB_NAME, 'status' => 'connected']);
} catch (Throwable $e) {
    jsonResponse(['success' => false, 'message' => 'Database unavailable'], 503);
}
