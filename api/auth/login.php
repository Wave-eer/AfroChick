<?php
require_once dirname(__DIR__, 2) . '/includes/api_helpers.php';
apiBootstrap();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
}

$body = readJsonBody();
$email = strtolower(trim($body['email'] ?? ''));
$password = $body['password'] ?? '';

if (!$email || !$password) {
    jsonResponse(['success' => false, 'message' => 'Email and password are required.'], 400);
}

$pdo = db();
$stmt = $pdo->prepare('SELECT id, name, email, password_hash, role FROM users WHERE email = ? LIMIT 1');
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password_hash'])) {
    jsonResponse(['success' => false, 'message' => 'Invalid email or password.'], 401);
}

$session = [
    'id' => (int) $user['id'],
    'name' => $user['name'],
    'email' => $user['email'],
    'role' => $user['role'],
];
$_SESSION['user'] = $session;

jsonResponse(['success' => true, 'user' => $session]);
