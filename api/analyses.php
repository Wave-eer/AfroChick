<?php
require_once dirname(__DIR__) . '/includes/api_helpers.php';
apiBootstrap();

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    jsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
}

requireAdminApi();

$pdo = db();
$stmt = $pdo->query('SELECT * FROM analyses ORDER BY created_at DESC LIMIT 50');
$rows = array_map('mapAnalysisRow', $stmt->fetchAll());

jsonResponse(['success' => true, 'data' => $rows]);
