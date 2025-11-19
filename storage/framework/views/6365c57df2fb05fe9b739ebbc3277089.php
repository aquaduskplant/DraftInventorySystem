<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo e(config('app.name', 'Inventory System')); ?></title>


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
<?php if(app()->environment('production')): ?>
    
    <link rel="stylesheet" href="/build/assets/app-BAwC6vSq.css">
    <script type="module" src="/build/assets/app-CJy8ASEk.js"></script>
<?php else: ?>
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
<?php endif; ?>
    </head>
    <body class="font-sans antialiased bg-slate-950 text-slate-100">
        <div class="min-h-screen flex items-center justify-center relative overflow-hidden">

            
            <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-950 to-slate-900"></div>
            <div class="pointer-events-none absolute -top-24 -left-24 w-80 h-80 bg-red-500/20 blur-3xl rounded-full"></div>
            <div class="pointer-events-none absolute -bottom-24 -right-24 w-96 h-96 bg-indigo-500/25 blur-3xl rounded-full"></div>

            
            <div class="relative z-10 w-full max-w-md px-4">
                <?php echo e($slot); ?>

            </div>
        </div>
    </body>
</html>
<?php /**PATH C:\Users\Renz\Documents\it107finalproject\DraftInventorySystem\resources\views/layouts/guest.blade.php ENDPATH**/ ?>