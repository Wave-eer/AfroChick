<?php
require_once dirname(__DIR__) . '/includes/api_helpers.php';
apiBootstrap();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
}

$body = readJsonBody();
$email = filter_var(trim($body['email'] ?? $_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);

if (!$email) {
    jsonResponse(['success' => false, 'message' => 'Please enter a valid email address.'], 400);
}

try {
    $pdo = db();
    $stmt = $pdo->prepare('INSERT INTO newsletter_subscribers (email) VALUES (?)');
    $stmt->execute([$email]);
    jsonResponse([
        'success' => true,
        'message' => 'Thank you for subscribing! Check your inbox for a confirmation.',
    ]);
} catch (PDOException $e) {
    if ((int) $e->getCode() === 23000) {
        jsonResponse([
            'success' => true,
            'message' => 'You are already subscribed.',
        ]);
    }
    jsonResponse(['success' => false, 'message' => 'Could not subscribe. Please try again.'], 500);
}
