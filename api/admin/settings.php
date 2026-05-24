<?php
require_once dirname(__DIR__, 2) . '/includes/api_helpers.php';
apiBootstrap();

$user = requireAdminApi();
$pdo = db();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $stmt = $pdo->prepare('SELECT settings FROM admin_settings WHERE user_id = ?');
    $stmt->execute([$user['id']]);
    $row = $stmt->fetch();
    $settings = $row ? json_decode($row['settings'], true) : [];
    jsonResponse(['success' => true, 'data' => $settings ?: []]);
}

if ($method === 'PUT' || $method === 'POST') {
    $body = readJsonBody();
    $settings = json_encode($body);
    $stmt = $pdo->prepare(
        'INSERT INTO admin_settings (user_id, settings) VALUES (?, ?)
         ON DUPLICATE KEY UPDATE settings = VALUES(settings)'
    );
    $stmt->execute([$user['id'], $settings]);
    jsonResponse(['success' => true, 'data' => $body]);
}

jsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
