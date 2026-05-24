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
}
