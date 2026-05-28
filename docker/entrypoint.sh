#!/bin/bash
set -e
# Ensure MySQL PDO is available (fallback if image was built without it)
if ! php -m | grep -q pdo_mysql; then
  docker-php-ext-install pdo_mysql 2>/dev/null || true
  docker-php-ext-enable pdo_mysql 2>/dev/null || true
fi
# Seed demo users/products when the users table is empty
php database/migrate.php 2>/dev/null || true
exec apache2-foreground
