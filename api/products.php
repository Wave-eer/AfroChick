<?php
require_once dirname(__DIR__) . '/includes/api_helpers.php';
apiBootstrap();

$pdo = db();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $status = $_GET['status'] ?? null;
    $sql = 'SELECT * FROM products';
    $params = [];
    if ($status) {
        $sql .= ' WHERE status = ?';
        $params[] = $status;
    }
    $sql .= ' ORDER BY id DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $rows = array_map('mapProductRow', $stmt->fetchAll());
    jsonResponse(['success' => true, 'data' => $rows]);
}

if ($method === 'POST') {
    requireAdminApi();
    $body = readJsonBody();
    $name = trim($body['name'] ?? '');
    if (!$name) {
        jsonResponse(['success' => false, 'message' => 'Product name required.'], 400);
    }

    $stmt = $pdo->prepare(
        'INSERT INTO products (name, category, status, image, price, ingredients, benefits, description)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([
        $name,
        $body['category'] ?? 'Serums',
        $body['status'] ?? 'approved',
        $body['image'] ?? '🧴',
        $body['price'] ?? '$0',
        json_encode(parseListField($body['ingredients'] ?? [])),
        json_encode(parseListField($body['benefits'] ?? [])),
        trim($body['description'] ?? ''),
    ]);

    $id = (int) $pdo->lastInsertId();
    $get = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $get->execute([$id]);
    jsonResponse(['success' => true, 'data' => mapProductRow($get->fetch())], 201);
}

jsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
