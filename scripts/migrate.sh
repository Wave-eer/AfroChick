#!/usr/bin/env bash
# Run database migration inside Docker
set -e
cd "$(dirname "$0")/.."
docker compose exec web php database/migrate.php "$@"
