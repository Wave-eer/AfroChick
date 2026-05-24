<?php
require_once dirname(__DIR__, 2) . '/includes/api_helpers.php';
apiBootstrap();

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    jsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
}

requireAdminApi();
$pdo = db();

$totalUsers = (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
$totalAnalyses = (int) $pdo->query('SELECT COUNT(*) FROM analyses')->fetchColumn();
$skinAnalyses = (int) $pdo->query("SELECT COUNT(*) FROM analyses WHERE type = 'skin'")->fetchColumn();
$hairAnalyses = (int) $pdo->query("SELECT COUNT(*) FROM analyses WHERE type = 'hair'")->fetchColumn();
$pendingSubmissions = (int) $pdo->query("SELECT COUNT(*) FROM product_submissions WHERE status = 'pending'")->fetchColumn();
$approvedProducts = (int) $pdo->query("SELECT COUNT(*) FROM products WHERE status = 'approved'")->fetchColumn();
$totalProducts = (int) $pdo->query('SELECT COUNT(*) FROM products')->fetchColumn();
$pendingProducts = (int) $pdo->query("SELECT COUNT(*) FROM products WHERE status = 'pending'")->fetchColumn();

jsonResponse([
    'success' => true,
    'data' => [
        'totalUsers' => $totalUsers,
        'totalAnalyses' => $totalAnalyses,
        'skinAnalyses' => $skinAnalyses,
        'hairAnalyses' => $hairAnalyses,
        'pendingSubmissions' => $pendingSubmissions,
        'approvedProducts' => $approvedProducts,
        'totalProducts' => $totalProducts,
        'pendingProducts' => $pendingProducts,
    ],
]);
