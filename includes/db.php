<?php
/**
 * Afrochick — Database entry (use db() everywhere in the app)
 */
require_once __DIR__ . '/env.php';
loadEnv();
require_once __DIR__ . '/connection.php';

function db(): PDO
{
    static $pdo = null;
    static $checked = false;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $pdo = appDb();

    if (!$checked) {
        $checked = true;
        try {
            $count = (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
            if ($count === 0) {
                require_once __DIR__ . '/migrate.php';
                seedDatabase($pdo);
                markMigration($pdo, '002_seed');
            }
        } catch (Throwable) {
            // Tables missing — run: php database/migrate.php
        }
    }

    return $pdo;
}
