#!/bin/bash

set -e

echo "Starting StudyMate AI..."

# Create storage link
php artisan storage:link || true

# Cache Laravel configuration and routes
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start PHP-FPM
php-fpm -D

# Start Nginx
nginx -g "daemon off;"