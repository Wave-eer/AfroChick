<?php
/**
 * Load .env file into getenv() / $_ENV
 */
function loadEnv(string $path = null): void
{
    static $loaded = false;
    if ($loaded) {
        return;
    }

    $path = $path ?? dirname(__DIR__) . '/.env';
    if (!is_readable($path)) {
        $loaded = true;
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }
        if (!str_contains($line, '=')) {
            continue;
        }
        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value, " \t\"'");
        if ($key !== '' && getenv($key) === false) {
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }

    $loaded = true;
}
