<?php
require_once __DIR__ . '/config.php';

function db(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
        DB_HOST,
        DB_PORT,
        DB_NAME
    );

    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    seedIfEmpty($pdo);

    return $pdo;
}

function seedIfEmpty(PDO $pdo): void
{
    $count = (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
    if ($count > 0) {
        return;
    }

    require_once __DIR__ . '/seed_data.php';

    $stmtUser = $pdo->prepare(
        'INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, ?)'
    );
    foreach (SEED_USERS as $u) {
        $stmtUser->execute([
            $u['name'],
            $u['email'],
            password_hash($u['password'], PASSWORD_DEFAULT),
            $u['role'],
        ]);
    }

    $stmtProduct = $pdo->prepare(
        'INSERT INTO products (name, category, status, image, price, ingredients, benefits, description)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
    );
    foreach (SEED_PRODUCTS as $p) {
        $stmtProduct->execute([
            $p['name'],
            $p['category'],
            $p['status'],
            $p['image'],
            $p['price'],
            json_encode($p['ingredients']),
            json_encode($p['benefits']),
            $p['description'],
        ]);
    }

    $stmtAnalysis = $pdo->prepare(
        'INSERT INTO analyses (user_email, type, profile_label) VALUES (?, ?, ?)'
    );
    foreach (SEED_ANALYSES as $a) {
        $stmtAnalysis->execute([$a['userEmail'], $a['type'], $a['profile_label']]);
    }
}
