<?php
require_once dirname(__DIR__, 2) . '/includes/api_helpers.php';
apiBootstrap();

requireAdminApi();
$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->query(
        'SELECT id, name, email, role, created_at, updated_at FROM users ORDER BY role DESC, id ASC'
    );
    $rows = array_map(static function (array $row): array {
        return [
            'id' => (int) $row['id'],
            'name' => $row['name'],
            'email' => $row['email'],
            'role' => $row['role'],
            'createdAt' => $row['created_at'],
            'updatedAt' => $row['updated_at'],
        ];
    }, $stmt->fetchAll());

    jsonResponse(['success' => true, 'data' => $rows]);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = (int) ($_GET['id'] ?? 0);
    $current = currentUser();

    if ($id < 1) {
        jsonResponse(['success' => false, 'message' => 'Invalid user id.'], 400);
    }
    if ($id === (int) $current['id']) {
        jsonResponse(['success' => false, 'message' => 'You cannot delete your own account.'], 400);
    }

    $del = $pdo->prepare('DELETE FROM users WHERE id = ?');
    $del->execute([$id]);
    jsonResponse(['success' => true]);
}

jsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
