<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php
        $productCount   = \App\Models\Product::count();
        $categoryCount  = \App\Models\Category::count();
        $totalQuantity  = \App\Models\Product::sum('quantity');
        $lowStockCount  = \App\Models\Product::where('quantity', '<', 5)->count(); // simple low-stock rule
    ?>

    <div class="px-6 py-6 space-y-6">

        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
                <div class="text-xs text-slate-500 uppercase tracking-wide mb-1">Products</div>
                <div class="text-3xl font-semibold text-slate-800"><?php echo e($productCount); ?></div>
                <div class="text-[11px] text-slate-400 mt-1">Total active products</div>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
                <div class="text-xs text-slate-500 uppercase tracking-wide mb-1">Categories</div>
                <div class="text-3xl font-semibold text-slate-800"><?php echo e($categoryCount); ?></div>
                <div class="text-[11px] text-slate-400 mt-1">Groups to organize items</div>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
                <div class="text-xs text-slate-500 uppercase tracking-wide mb-1">Total Qty In Stock</div>
                <div class="text-3xl font-semibold text-emerald-500"><?php echo e($totalQuantity); ?></div>
                <div class="text-[11px] text-slate-400 mt-1">All units across products</div>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
                <div class="text-xs text-slate-500 uppercase tracking-wide mb-1">Low Stock Items</div>
                <div class="text-3xl font-semibold text-red-500"><?php echo e($lowStockCount); ?></div>
                <div class="text-[11px] text-slate-400 mt-1">Quantity &lt; 5</div>
            </div>
        </div>

        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm lg:col-span-2">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-sm font-semibold text-slate-800 uppercase tracking-wide">
                        Product Details
                    </h2>
                    <span class="text-xs text-slate-400">
                        Quick overview of inventory health
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm">
                    <div>
                        <div class="text-slate-500">Low Stock Items</div>
                        <div class="text-red-500 font-semibold text-lg"><?php echo e($lowStockCount); ?></div>
                    </div>
                    <div>
                        <div class="text-slate-500">All Categories</div>
                        <div class="text-slate-800 font-semibold text-lg"><?php echo e($categoryCount); ?></div>
                    </div>
                    <div>
                        <div class="text-slate-500">All Products</div>
                        <div class="text-slate-800 font-semibold text-lg"><?php echo e($productCount); ?></div>
                    </div>
                    <div>
                        <div class="text-slate-500">Total Quantity</div>
                        <div class="text-emerald-500 font-semibold text-lg"><?php echo e($totalQuantity); ?></div>
                    </div>
                </div>

                <div class="mt-6 border-t border-slate-100 pt-4 grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                    <a href="<?php echo e(route('products.index')); ?>"
                       class="inline-flex items-center justify-center rounded-lg border border-slate-200 px-4 py-2 hover:bg-slate-50 text-slate-700">
                        📦 View Products
                    </a>
                    <a href="<?php echo e(route('categories.index')); ?>"
                       class="inline-flex items-center justify-center rounded-lg border border-slate-200 px-4 py-2 hover:bg-slate-50 text-slate-700">
                        🗂 Manage Categories
                    </a>
                    <a href="<?php echo e(route('stock.index')); ?>"
                       class="inline-flex items-center justify-center rounded-lg border border-slate-200 px-4 py-2 hover:bg-slate-50 text-slate-700">
                        📊 View Stock History
                    </a>
                </div>
            </div>

            
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                <h2 class="text-sm font-semibold text-slate-800 uppercase tracking-wide mb-4">
                    Inventory Summary
                </h2>

                <div class="space-y-3 text-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Quantity in Hand</span>
                        <span class="font-semibold text-slate-800"><?php echo e($totalQuantity); ?></span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Low Stock Items</span>
                        <span class="font-semibold text-red-500"><?php echo e($lowStockCount); ?></span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Categories</span>
                        <span class="font-semibold text-slate-800"><?php echo e($categoryCount); ?></span>
                    </div>
                </div>

                <div class="mt-6 text-xs text-slate-400 leading-relaxed">
                    Keep an eye on low-stock items to avoid running out.
                    Use categories to group similar products and simplify restocking decisions.
                </div>
            </div>
        </div>

        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                <h2 class="text-sm font-semibold text-slate-800 uppercase tracking-wide mb-3">
                    Recent Products
                </h2>
                <table class="w-full text-xs text-slate-600">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="py-2 text-left">Name</th>
                            <th class="py-2 text-left">Category</th>
                            <th class="py-2 text-right">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = \App\Models\Product::with('category')->latest()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b border-slate-50">
                                <td class="py-2"><?php echo e($prod->name); ?></td>
                                <td class="py-2 text-slate-500"><?php echo e($prod->category->name ?? '—'); ?></td>
                                <td class="py-2 text-right"><?php echo e($prod->quantity); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($productCount === 0): ?>
                            <tr>
                                <td colspan="3" class="py-4 text-center text-slate-400">
                                    No products yet. Add your first product to see it here.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                <h2 class="text-sm font-semibold text-slate-800 uppercase tracking-wide mb-3">
                    User Info
                </h2>
                <p class="text-sm text-slate-700">
                    Logged in as <span class="font-semibold"><?php echo e(Auth::user()->name); ?></span>
                    (<span class="uppercase text-xs"><?php echo e(Auth::user()->role); ?></span>)
                </p>
                <p class="mt-3 text-xs text-slate-400">
                    Only admins can create, edit, or delete products and categories. Regular users can
                    log in to view inventory levels and product details.
                </p>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Renz\Documents\it107finalprojectDeploy\DraftInventorySystem\resources\views/dashboard.blade.php ENDPATH**/ ?>