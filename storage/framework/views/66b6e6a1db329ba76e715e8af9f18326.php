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
     <?php $__env->slot('header', null, []); ?> 
    <div class="flex items-center justify-end">
        <?php if(auth()->user()->role === 'admin'): ?>
            <a href="<?php echo e(route('products.create')); ?>"
               class="inline-flex items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-sm font-semibold rounded-lg text-white shadow-md transition">
                + Add Product
            </a>
        <?php endif; ?>
    </div>
 <?php $__env->endSlot(); ?>


    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <?php if(session('success')): ?>
                <div class="mb-4 rounded-lg bg-green-600/20 border border-green-500/50 text-green-100 px-4 py-3 text-sm">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div class="bg-gray-900/80 border border-gray-800 rounded-xl shadow-xl overflow-hidden">
                <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <h3 class="text-lg font-semibold text-white">Product List</h3>
                        <p class="text-sm text-gray-400">All items currently tracked in the inventory.</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-300">
                        <thead class="bg-gray-800/90 text-xs uppercase tracking-wide text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Name</th>
                                <th class="px-6 py-3">SKU</th>
                                <th class="px-6 py-3">Category</th>
                                <th class="px-6 py-3">Cost</th>
                                <th class="px-6 py-3">Price</th>
                                <th class="px-6 py-3">Quantity</th>
                                <?php if(auth()->user()->role === 'admin'): ?>
                                    <th class="px-6 py-3 text-right">Actions</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800 bg-gray-900/60">
                            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-gray-800/70 transition">
                                    <td class="px-6 py-3 font-medium text-white">
                                        <?php echo e($product->name); ?>

                                    </td>
                                    <td class="px-6 py-3 text-gray-300">
                                        <?php echo e($product->sku); ?>

                                    </td>
                                    <td class="px-6 py-3">
                                        <?php echo e($product->category->name ?? 'Uncategorized'); ?>

                                    </td>
                                    <td class="px-6 py-3">
                                        ₱<?php echo e(number_format($product->cost_price, 2)); ?>

                                    </td>
                                    <td class="px-6 py-3">
                                        ₱<?php echo e(number_format($product->sell_price, 2)); ?>

                                    </td>
                                    <td class="px-6 py-3">
                                        <?php echo e($product->quantity); ?>

                                    </td>
                                    <?php if(auth()->user()->role === 'admin'): ?>
                                        <td class="px-6 py-3 text-right space-x-2">
                                            <a href="<?php echo e(route('products.edit', $product)); ?>"
                                               class="inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-lg bg-blue-500/80 hover:bg-blue-500 text-white shadow-sm">
                                                Edit
                                            </a>
                                            <a href="<?php echo e(route('stock.in.create', $product)); ?>"
                                               class="inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-lg bg-emerald-500/80 hover:bg-emerald-500 text-white shadow-sm">
                                                Stock In
                                            </a>
                                            <a href="<?php echo e(route('stock.out.create', $product)); ?>"
                                               class="inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-lg bg-amber-500/80 hover:bg-amber-500 text-white shadow-sm">
                                                Stock Out
                                            </a>
                                            <form action="<?php echo e(route('products.destroy', $product)); ?>" method="POST" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit"
                                                    onclick="return confirm('Delete this product?')"
                                                    class="inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-500/80 hover:bg-red-500 text-white shadow-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7" class="px-6 py-6 text-center text-gray-400">
                                        No products found. Start by adding a new product.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-800">
                    <?php echo e($products->links()); ?>

                </div>
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
<?php /**PATH C:\Users\Renz\Documents\it107finalproject\DraftInventorySystem\resources\views/products/index.blade.php ENDPATH**/ ?>