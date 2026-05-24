<?php
require_once dirname(__DIR__) . '/includes/api_helpers.php';
apiBootstrap();

$pdo = db();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    requireAdminApi();
    $status = $_GET['status'] ?? null;
    $sql = 'SELECT * FROM product_submissions';
    $params = [];
    if ($status) {
        $sql .= ' WHERE status = ?';
        $params[] = $status;
    }
    $sql .= ' ORDER BY created_at DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $rows = array_map('mapSubmissionRow', $stmt->fetchAll());
    jsonResponse(['success' => true, 'data' => $rows]);
}

if ($method === 'POST') {
    $body = readJsonBody();
    if (empty($body) && !empty($_POST)) {
        $body = $_POST;
    }

    $productName = trim($body['product_name'] ?? '');
    $category = trim($body['category'] ?? '');
    $contact = strtolower(trim($body['contact_email'] ?? ''));

    if (!$productName || !$category || !$contact) {
        jsonResponse(['success' => false, 'message' => 'Required fields missing.'], 400);
    }
    if (!filter_var($contact, FILTER_VALIDATE_EMAIL)) {
        jsonResponse(['success' => false, 'message' => 'Invalid contact email.'], 400);
    }

    $stmt = $pdo->prepare(
        'INSERT INTO product_submissions (product_name, category, ingredients, benefits, description, website_url, contact_email)
         VALUES (?, ?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([
        $productName,
        $category,
        trim($body['ingredients'] ?? ''),
        trim($body['benefits'] ?? ''),
        trim($body['description'] ?? ''),
        trim($body['website'] ?? '') ?: null,
        $contact,
    ]);

    jsonResponse([
        'success' => true,
        'message' => 'Your product has been submitted for review.',
        'id' => (int) $pdo->lastInsertId(),
    ], 201);
}

jsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
