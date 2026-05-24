<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);

if (!$email) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
    exit;
}

// TODO: Save to Supabase or database when connected
// For now, mock success response
echo json_encode([
    'success' => true,
    'message' => 'Thank you for subscribing! Check your inbox for a confirmation.',
]);
