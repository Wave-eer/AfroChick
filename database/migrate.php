#!/usr/bin/env php
<?php
/**
 * Afrochick — Database migration CLI
 *
 * Usage:
 *   php database/migrate.php
 *   php database/migrate.php --force   # re-seed (clears users, products, etc.)
 *
 * Docker:
 *   docker compose exec web php database/migrate.php
 */
declare(strict_types=1);

$root = dirname(__DIR__);
chdir($root);

require_once $root . '/includes/env.php';
loadEnv();
require_once $root . '/includes/migrate.php';

$force = in_array('--force', $argv ?? [], true);

echo "Afrochick database migration\n";
echo "Host: " . (getenv('DB_HOST') ?: '127.0.0.1') . " | Database: " . (getenv('DB_NAME') ?: 'afrochick') . "\n\n";

try {
    $log = runMigrations($force);
    foreach ($log as $line) {
        echo "  • $line\n";
    }
    echo "\nMigration completed successfully.\n";
    exit(0);
} catch (Throwable $e) {
    fwrite(STDERR, "Migration failed: " . $e->getMessage() . "\n");
    exit(1);
}
