#!/bin/bash
set -e

# Fix permissions on mounted volumes so www-data can write to them
chown -R www-data:www-data /var/www/html/assets

exec "$@"