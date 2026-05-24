<?php

require_once __DIR__ . '/db.php';

function apiBootstrap(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    header('Content-Type: application/json; charset=utf-8');
}

function jsonResponse(array $data, int $code = 200): void
{
    http_response_code($code);
    echo json_encode($data);
    exit;
}

function readJsonBody(): array
{
    $raw = file_get_contents('php://input');
    if (!$raw) {
        return $_POST ?: [];
    }
    $data = json_decode($raw, true);
    return is_array($data) ? $data : [];
}

function currentUser(): ?array
{
    return $_SESSION['user'] ?? null;
}

function requireAuthApi(): array
{
    $user = currentUser();
    if (!$user) {
        jsonResponse(['success' => false, 'message' => 'Unauthorized'], 401);
    }
    return $user;
}

function requireAdminApi(): array
{
    $user = requireAuthApi();
    if (($user['role'] ?? '') !== 'admin') {
        jsonResponse(['success' => false, 'message' => 'Forbidden'], 403);
    }
    return $user;
}

function mapProductRow(array $row): array
{
    return [
        'id' => (int) $row['id'],
        'name' => $row['name'],
        'category' => $row['category'],
        'status' => $row['status'],
        'image' => $row['image'],
        'price' => $row['price'],
        'ingredients' => json_decode($row['ingredients'], true) ?: [],
        'benefits' => json_decode($row['benefits'], true) ?: [],
        'description' => $row['description'],
        'createdAt' => $row['created_at'],
        'updatedAt' => $row['updated_at'],
    ];
}

function mapSubmissionRow(array $row): array
{
    return [
        'id' => (int) $row['id'],
        'product_name' => $row['product_name'],
        'category' => $row['category'],
        'ingredients' => $row['ingredients'],
        'benefits' => $row['benefits'],
        'description' => $row['description'],
        'website' => $row['website_url'],
        'contact_email' => $row['contact_email'],
        'status' => $row['status'],
        'createdAt' => $row['created_at'],
    ];
}

function mapAnalysisRow(array $row): array
{
    return [
        'id' => (int) $row['id'],
        'type' => $row['type'],
        'userEmail' => $row['user_email'],
        'skinType' => $row['type'] === 'skin' ? $row['profile_label'] : null,
        'hairType' => $row['type'] === 'hair' ? $row['profile_label'] : null,
        'createdAt' => $row['created_at'],
    ];
}

function parseListField($value): array
{
    if (is_array($value)) {
        return array_values(array_filter(array_map('trim', $value)));
    }
    return array_values(array_filter(array_map('trim', explode(',', (string) $value))));
}
