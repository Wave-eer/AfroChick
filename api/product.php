<?php
require_once dirname(__DIR__) . '/includes/api_helpers.php';
apiBootstrap();

$id = (int) ($_GET['id'] ?? 0);
if ($id < 1) {
    jsonResponse(['success' => false, 'message' => 'Invalid product id.'], 400);
}

$pdo = db();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if (!$row) {
        jsonResponse(['success' => false, 'message' => 'Product not found.'], 404);
    }
    jsonResponse(['success' => true, 'data' => mapProductRow($row)]);
}

if ($method === 'PUT' || ($method === 'POST' && ($_POST['_method'] ?? '') === 'PUT')) {
    requireAdminApi();
    $body = readJsonBody();

    $stmt = $pdo->prepare(
        'UPDATE products SET name = ?, category = ?, status = ?, image = ?, price = ?,
         ingredients = ?, benefits = ?, description = ? WHERE id = ?'
    );
    $stmt->execute([
        trim($body['name'] ?? ''),
        $body['category'] ?? 'Serums',
        $body['status'] ?? 'approved',
        $body['image'] ?? '🧴',
        $body['price'] ?? '$0',
        json_encode(parseListField($body['ingredients'] ?? [])),
        json_encode(parseListField($body['benefits'] ?? [])),
        trim($body['description'] ?? ''),
        $id,
    ]);

    $get = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $get->execute([$id]);
    jsonResponse(['success' => true, 'data' => mapProductRow($get->fetch())]);
}

if ($method === 'DELETE' || ($method === 'POST' && ($_POST['_method'] ?? '') === 'DELETE')) {
    requireAdminApi();
    $del = $pdo->prepare('DELETE FROM products WHERE id = ?');
    $del->execute([$id]);
    jsonResponse(['success' => true]);
}

jsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
