<?php

require_once dirname(__DIR__) . '/includes/env.php';
loadEnv();
require_once dirname(__DIR__) . '/includes/config.php';
require_once dirname(__DIR__) . '/includes/connection.php';

header('Content-Type: application/json; charset=utf-8');

$result = testDatabaseConnection();

if ($result['ok']) {
    echo json_encode([
        'success' => true,
        'database' => DB_NAME,
        'host' => DB_HOST,
        'status' => 'connected',
        'message' => $result['message'],
    ]);
} else {
    http_response_code(503);
    echo json_encode([
        'success' => false,
        'message' => $result['message'],
        'hint' => 'Run: docker compose exec web php database/migrate.php',
    ]);

require_once dirname(__DIR__) . '/includes/api_helpers.php';
apiBootstrap();

try {
    $pdo = db();
    $pdo->query('SELECT 1');
    jsonResponse(['success' => true, 'database' => DB_NAME, 'status' => 'connected']);
} catch (Throwable $e) {
    jsonResponse(['success' => false, 'message' => 'Database unavailable'], 503);

}
