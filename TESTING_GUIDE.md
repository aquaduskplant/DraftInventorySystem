# How to Test Your Inventory System Web Application

This guide will help you run and test your Laravel inventory system application locally in your web browser.

## Prerequisites

Make sure you have installed:
- **PHP 8.2 or higher** (check with `php -v`)
- **Composer** (PHP package manager - check with `composer --version`)
- **Node.js and npm** (for frontend assets - check with `node -v` and `npm -v`)

## Step-by-Step Setup

### Step 1: Install PHP Dependencies
Open your terminal in the project directory and run:
```bash
composer install
```

### Step 2: Set Up Environment File
Create a `.env` file if it doesn't exist:
```bash
# On Windows PowerShell:
if (!(Test-Path .env)) { Copy-Item .env.example .env }
# Or manually copy .env.example to .env
```

### Step 3: Generate Application Key
```bash
php artisan key:generate
```

### Step 4: Set Up Database (SQLite - Easiest Option)
The application is configured to use SQLite by default. Create the database file:
```bash
# On Windows PowerShell:
New-Item -ItemType File -Path "database\database.sqlite" -Force
```

Or manually create an empty file at: `database/database.sqlite`

### Step 5: Run Database Migrations
This creates all the necessary database tables:
```bash
php artisan migrate
```

### Step 6: (Optional) Seed Database with Sample Data
If you have seeders, run:
```bash
php artisan db:seed
```

### Step 7: Install Frontend Dependencies
```bash
npm install
```

### Step 8: Build Frontend Assets
```bash
npm run build
```

## Running the Application

### Option 1: Simple Development Server (Recommended for Testing)
Run this command:
```bash
php artisan serve
```

You should see output like:
```
INFO  Server running on [http://127.0.0.1:8000]
```

Then open your web browser and go to:
**http://127.0.0.1:8000** or **http://localhost:8000**

### Option 2: Full Development Mode (with Hot Reload)
If you want automatic page refresh when you change code:
```bash
composer run dev
```

This will start:
- Laravel server on http://127.0.0.1:8000
- Vite dev server for hot module replacement
- Queue worker
- Log viewer

## Testing the Application

### 1. Register a New User
- Go to http://127.0.0.1:8000
- Click "Register" 
- Create a new account

### 2. Login
- Use your credentials to log in
- You'll be redirected to the dashboard

### 3. Test Features
Based on your routes, you can test:
- **Dashboard**: View your dashboard (different for admin vs regular users)
- **Products**: View products list
- **Admin Features** (if you're an admin):
  - Create/Edit/Delete products
  - Manage categories
  - Stock movements (in/out)

### 4. Create an Admin User (Optional)
If you need admin access, you can create one via tinker:
```bash
php artisan tinker
```

Then in tinker:
```php
$user = App\Models\User::create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'role' => 'admin'
]);
exit
```

## Troubleshooting

### Port Already in Use
If port 8000 is busy, use a different port:
```bash
php artisan serve --port=8001
```

### Database Errors
- Make sure `database/database.sqlite` file exists
- Check file permissions (should be writable)
- Try running migrations again: `php artisan migrate:fresh`

### Frontend Assets Not Loading
- Make sure you ran `npm run build`
- Clear cache: `php artisan cache:clear` and `php artisan config:clear`

### Can't See Styles/CSS
- Rebuild assets: `npm run build`
- Or use dev mode: `npm run dev` (in a separate terminal)

## Quick Start Commands (All-in-One)

If you want to set everything up quickly:

```bash
# Install dependencies
composer install
npm install

# Set up environment (if .env doesn't exist)
if (!(Test-Path .env)) { Copy-Item .env.example .env }
php artisan key:generate

# Set up database
New-Item -ItemType File -Path "database\database.sqlite" -Force
php artisan migrate

# Build frontend
npm run build

# Start server
php artisan serve
```

Then open **http://localhost:8000** in your browser!

