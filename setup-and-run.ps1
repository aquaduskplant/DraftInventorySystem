# Quick Setup and Run Script for Inventory System
# Run this script to set up and start your Laravel application

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "Inventory System - Setup & Run Script" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Check if .env exists
if (!(Test-Path .env)) {
    Write-Host "Creating .env file..." -ForegroundColor Yellow
    if (Test-Path .env.example) {
        Copy-Item .env.example .env
        Write-Host "✓ .env file created from .env.example" -ForegroundColor Green
    } else {
        Write-Host "⚠ .env.example not found. Creating basic .env file..." -ForegroundColor Yellow
        @"
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
SESSION_DRIVER=database
SESSION_LIFETIME=120

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug
"@ | Out-File -FilePath .env -Encoding utf8
        Write-Host "✓ Basic .env file created" -ForegroundColor Green
    }
} else {
    Write-Host "✓ .env file already exists" -ForegroundColor Green
}

# Generate app key if not set
Write-Host ""
Write-Host "Generating application key..." -ForegroundColor Yellow
php artisan key:generate
Write-Host "✓ Application key generated" -ForegroundColor Green

# Create database file
Write-Host ""
Write-Host "Setting up database..." -ForegroundColor Yellow
if (!(Test-Path "database\database.sqlite")) {
    New-Item -ItemType File -Path "database\database.sqlite" -Force | Out-Null
    Write-Host "✓ SQLite database file created" -ForegroundColor Green
} else {
    Write-Host "✓ SQLite database file already exists" -ForegroundColor Green
}

# Run migrations
Write-Host ""
Write-Host "Running database migrations..." -ForegroundColor Yellow
php artisan migrate --force
Write-Host "✓ Database migrations completed" -ForegroundColor Green

# Build frontend assets
Write-Host ""
Write-Host "Building frontend assets..." -ForegroundColor Yellow
npm run build
Write-Host "✓ Frontend assets built" -ForegroundColor Green

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "Setup Complete!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Starting development server..." -ForegroundColor Yellow
Write-Host "Open your browser and go to: http://127.0.0.1:8000" -ForegroundColor Cyan
Write-Host "Press Ctrl+C to stop the server" -ForegroundColor Yellow
Write-Host ""

# Start the server
php artisan serve

