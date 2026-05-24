<?php
require_once dirname(__DIR__, 2) . '/includes/api_helpers.php';
apiBootstrap();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
}

$body = readJsonBody();
$name = trim($body['name'] ?? '');
$email = strtolower(trim($body['email'] ?? ''));
$password = $body['password'] ?? '';

if (strlen($name) < 2) {
    jsonResponse(['success' => false, 'message' => 'Enter your full name.'], 400);
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    jsonResponse(['success' => false, 'message' => 'Enter a valid email.'], 400);
}
if (strlen($password) < 8) {
    jsonResponse(['success' => false, 'message' => 'Password must be at least 8 characters.'], 400);
}

$pdo = db();
$exists = $pdo->prepare('SELECT id FROM users WHERE email = ?');
$exists->execute([$email]);
if ($exists->fetch()) {
    jsonResponse(['success' => false, 'message' => 'An account with this email already exists.'], 409);
}

$stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, ?)');
$stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT), 'user']);

$session = [
    'id' => (int) $pdo->lastInsertId(),
    'name' => $name,
    'email' => $email,
    'role' => 'user',
];
$_SESSION['user'] = $session;

jsonResponse(['success' => true, 'user' => $session]);
