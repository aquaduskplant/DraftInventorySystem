#!/usr/bin/env bash
set -e

echo "Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "Installing Node.js dependencies..."
npm ci

echo "Building frontend assets..."
npm run build

echo "Generating application key..."
php artisan key:generate --force || true

echo "Caching configuration..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Caching views..."
php artisan view:cache

echo "Running database migrations..."
php artisan migrate --force

echo "Optimizing application..."
php artisan optimize

echo "Build completed successfully!"

