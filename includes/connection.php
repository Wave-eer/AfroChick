<?php
/**
 * Afrochick — Database connection & migration helpers
 */
require_once __DIR__ . '/env.php';
require_once __DIR__ . '/config.php';

function dbConfig(): array
{
    return [
        'host' => DB_HOST,
        'port' => DB_PORT,
        'name' => DB_NAME,
        'user' => DB_USER,
        'pass' => DB_PASS,
    ];
}

/** Connect to MySQL server (no database selected). */
function dbServer(): PDO
{
    $c = dbConfig();
    $dsn = sprintf('mysql:host=%s;port=%s;charset=utf8mb4', $c['host'], $c['port']);

    return new PDO($dsn, $c['user'], $c['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
}

/** Create database if it does not exist. */
function ensureDatabaseExists(): void
{
    $c = dbConfig();
    $pdo = dbServer();
    $name = str_replace('`', '``', $c['name']);
    $pdo->exec(
        "CREATE DATABASE IF NOT EXISTS `{$name}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
    );
}

/** Application PDO connection to afrochick database. */
function appDb(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $c = dbConfig();
    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
        $c['host'],
        $c['port'],
        $c['name']
    );

    $pdo = new PDO($dsn, $c['user'], $c['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    return $pdo;
}

/** Test connection; returns [ok, message]. */
function testDatabaseConnection(): array
{
    try {
        ensureDatabaseExists();
        $pdo = appDb();
        $pdo->query('SELECT 1');
        $version = $pdo->query('SELECT VERSION()')->fetchColumn();
        return ['ok' => true, 'message' => "Connected to " . DB_NAME . " (MySQL $version)"];
    } catch (Throwable $e) {
        return ['ok' => false, 'message' => $e->getMessage()];
    }
}
