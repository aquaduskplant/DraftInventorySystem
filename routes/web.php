<?php
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

// Optional: root redirects to dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {
    // Dashboard (decides admin vs user view)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // =========================
    // SHARED ROUTES (all logged-in users)
    // =========================

    // Products list: users & admins can see this page
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    // (Optional) if you want users to also view stock history,
    // you can move stock.index here instead of admin-only.

    // =========================
    // ADMIN-ONLY ROUTES
    // =========================
    Route::middleware('admin')->group(function () {
        // Products CRUD (except index, already defined above)
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        // Categories CRUD
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // Stock movements
        Route::get('/stock', [StockMovementController::class, 'index'])->name('stock.index');

        Route::get('/stock/in/{product}', [StockMovementController::class, 'createIn'])
            ->name('stock.in.create');
        Route::post('/stock/in/{product}', [StockMovementController::class, 'storeIn'])
            ->name('stock.in.store');

        Route::get('/stock/out/{product}', [StockMovementController::class, 'createOut'])
            ->name('stock.out.create');
        Route::post('/stock/out/{product}', [StockMovementController::class, 'storeOut'])
            ->name('stock.out.store');
    });
});
Route::get('/run-migrations-once', function () {
    // Be a bit safe: only allow in production on Render
    if (!app()->environment('production')) {
        abort(403, 'Not allowed in non-production environment.');
    }

    try {
        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('db:seed', ['--force' => true]);

        return '<h1>✅ Migrations and seed completed.</h1><pre>'
            . Artisan::output()
            . '</pre>';
    } catch (\Throwable $e) {
        return '<h1>❌ Error running migrations.</h1><pre>'
            . e($e->getMessage())
            . '</pre>';
    }
});
require __DIR__ . '/auth.php';
