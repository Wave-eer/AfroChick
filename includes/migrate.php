<?php
/**
 * Run schema + seed migrations
 */
require_once __DIR__ . '/connection.php';
require_once __DIR__ . '/seed_data.php';

function runMigrations(bool $forceSeed = false): array
{
    $log = [];

    ensureDatabaseExists();
    $log[] = 'Database `' . DB_NAME . '` ready.';

    $pdo = appDb();

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS schema_migrations (
            version VARCHAR(64) PRIMARY KEY,
            applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4'
    );

    $schemaFile = dirname(__DIR__) . '/database/schema.sql';
    if (!is_readable($schemaFile)) {
        throw new RuntimeException('Missing database/schema.sql');
    }

    if (!migrationApplied($pdo, '001_schema')) {
        $sql = file_get_contents($schemaFile);
        $pdo->exec($sql);
        markMigration($pdo, '001_schema');
        $log[] = 'Applied migration: 001_schema (tables created).';
    } else {
        $log[] = 'Skipped 001_schema (already applied). Re-running CREATE IF NOT EXISTS via schema file.';
        $pdo->exec(file_get_contents($schemaFile));
    }

    $userCount = (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
    if ($userCount === 0 || $forceSeed) {
        if ($forceSeed && $userCount > 0) {
            $log[] = 'Force seed: truncating data tables…';
            truncateSeedTables($pdo);
        }
        seedDatabase($pdo);
        markMigration($pdo, '002_seed');
        $log[] = 'Applied migration: 002_seed (demo users, products, analyses).';
    } else {
        $log[] = 'Skipped 002_seed (data already present). Use --force to re-seed.';
    }

    $stats = migrationStats($pdo);
    $log[] = sprintf(
        'Done. users=%d products=%d submissions=%d analyses=%d newsletter=%d',
        $stats['users'],
        $stats['products'],
        $stats['submissions'],
        $stats['analyses'],
        $stats['newsletter']
    );

    return $log;
}

function migrationApplied(PDO $pdo, string $version): bool
{
    $stmt = $pdo->prepare('SELECT 1 FROM schema_migrations WHERE version = ?');
    $stmt->execute([$version]);
    return (bool) $stmt->fetchColumn();
}

function markMigration(PDO $pdo, string $version): void
{
    $stmt = $pdo->prepare(
        'INSERT INTO schema_migrations (version) VALUES (?) ON DUPLICATE KEY UPDATE version = version'
    );
    $stmt->execute([$version]);
}

function truncateSeedTables(PDO $pdo): void
{
    $pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
    foreach (['admin_settings', 'analyses', 'product_submissions', 'products', 'newsletter_subscribers', 'users'] as $table) {
        $pdo->exec("TRUNCATE TABLE `$table`");
    }
    $pdo->exec('DELETE FROM schema_migrations WHERE version = "002_seed"');
    $pdo->exec('SET FOREIGN_KEY_CHECKS = 1');
}

function seedDatabase(PDO $pdo): void
{
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

function migrationStats(PDO $pdo): array
{
    return [
        'users' => (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn(),
        'products' => (int) $pdo->query('SELECT COUNT(*) FROM products')->fetchColumn(),
        'submissions' => (int) $pdo->query('SELECT COUNT(*) FROM product_submissions')->fetchColumn(),
        'analyses' => (int) $pdo->query('SELECT COUNT(*) FROM analyses')->fetchColumn(),
        'newsletter' => (int) $pdo->query('SELECT COUNT(*) FROM newsletter_subscribers')->fetchColumn(),
    ];
}
