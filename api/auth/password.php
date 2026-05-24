<?php
require_once dirname(__DIR__, 2) . '/includes/api_helpers.php';
apiBootstrap();

if ($_SERVER['REQUEST_METHOD'] !== 'PUT' && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
}

$user = requireAuthApi();
$body = readJsonBody();
$current = $body['currentPassword'] ?? '';
$new = $body['newPassword'] ?? '';

if (strlen($new) < 8) {
    jsonResponse(['success' => false, 'message' => 'New password must be at least 8 characters.'], 400);
}

$pdo = db();
$stmt = $pdo->prepare('SELECT password_hash FROM users WHERE id = ?');
$stmt->execute([$user['id']]);
$row = $stmt->fetch();

if (!$row || !password_verify($current, $row['password_hash'])) {
    jsonResponse(['success' => false, 'message' => 'Current password is incorrect.'], 400);
}

$upd = $pdo->prepare('UPDATE users SET password_hash = ? WHERE id = ?');
$upd->execute([password_hash($new, PASSWORD_DEFAULT), $user['id']]);

jsonResponse(['success' => true, 'message' => 'Password updated successfully.']);
