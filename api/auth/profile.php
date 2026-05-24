<?php
require_once dirname(__DIR__, 2) . '/includes/api_helpers.php';
apiBootstrap();

if ($_SERVER['REQUEST_METHOD'] !== 'PUT' && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
}

$user = requireAuthApi();
$body = readJsonBody();
$name = trim($body['name'] ?? '');
$email = strtolower(trim($body['email'] ?? ''));

if (strlen($name) < 2) {
    jsonResponse(['success' => false, 'message' => 'Name is required.'], 400);
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    jsonResponse(['success' => false, 'message' => 'Valid email required.'], 400);
}

$pdo = db();
$dup = $pdo->prepare('SELECT id FROM users WHERE email = ? AND id != ?');
$dup->execute([$email, $user['id']]);
if ($dup->fetch()) {
    jsonResponse(['success' => false, 'message' => 'Email already in use.'], 409);
}

$stmt = $pdo->prepare('UPDATE users SET name = ?, email = ? WHERE id = ?');
$stmt->execute([$name, $email, $user['id']]);

$updated = ['id' => $user['id'], 'name' => $name, 'email' => $email, 'role' => $user['role']];
$_SESSION['user'] = $updated;

jsonResponse(['success' => true, 'user' => $updated]);
