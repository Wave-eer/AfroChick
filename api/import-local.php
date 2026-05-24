<?php
/**
 * Import data from browser localStorage export (POST JSON body)
 * Admin session required.
 *
 * Body example:
 * {
 *   "users": [...],
 *   "products": [...],
 *   "submissions": [...],
 *   "analyses": [...]
 * }
 */
require_once dirname(__DIR__) . '/includes/api_helpers.php';
apiBootstrap();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
}

requireAdminApi();
require_once dirname(__DIR__) . '/includes/migrate.php';

$body = readJsonBody();
$pdo = db();
$imported = ['users' => 0, 'products' => 0, 'submissions' => 0, 'analyses' => 0];

// Users (localStorage had plain passwords — re-hash if provided)
foreach ($body['users'] ?? [] as $u) {
    $email = strtolower(trim($u['email'] ?? ''));
    if (!$email) {
        continue;
    }
    $exists = $pdo->prepare('SELECT id FROM users WHERE email = ?');
    $exists->execute([$email]);
    if ($exists->fetch()) {
        continue;
    }
    $pass = $u['password'] ?? 'changeme123';
    $stmt = $pdo->prepare(
        'INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, ?)'
    );
    $stmt->execute([
        $u['name'] ?? 'User',
        $email,
        password_hash($pass, PASSWORD_DEFAULT),
        $u['role'] ?? 'user',
    ]);
    $imported['users']++;
}

foreach ($body['products'] ?? [] as $p) {
    if (empty($p['name'])) {
        continue;
    }
    $stmt = $pdo->prepare(
        'INSERT INTO products (name, category, status, image, price, ingredients, benefits, description)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([
        $p['name'],
        $p['category'] ?? 'Serums',
        $p['status'] ?? 'approved',
        $p['image'] ?? '🧴',
        $p['price'] ?? '$0',
        json_encode($p['ingredients'] ?? []),
        json_encode($p['benefits'] ?? []),
        $p['description'] ?? '',
    ]);
    $imported['products']++;
}

foreach ($body['submissions'] ?? [] as $s) {
    if (empty($s['product_name'])) {
        continue;
    }
    $stmt = $pdo->prepare(
        'INSERT INTO product_submissions (product_name, category, ingredients, benefits, description, website_url, contact_email, status)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([
        $s['product_name'],
        $s['category'] ?? '',
        $s['ingredients'] ?? '',
        $s['benefits'] ?? '',
        $s['description'] ?? '',
        $s['website'] ?? $s['website_url'] ?? null,
        $s['contact_email'] ?? '',
        $s['status'] ?? 'pending',
    ]);
    $imported['submissions']++;
}

foreach ($body['analyses'] ?? [] as $a) {
    $stmt = $pdo->prepare(
        'INSERT INTO analyses (user_email, type, profile_label) VALUES (?, ?, ?)'
    );
    $stmt->execute([
        $a['userEmail'] ?? $a['user_email'] ?? '',
        $a['type'] ?? 'skin',
        $a['skinType'] ?? $a['hairType'] ?? $a['profile_label'] ?? null,
    ]);
    $imported['analyses']++;
}

jsonResponse(['success' => true, 'imported' => $imported]);
