<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl shadow-2xl px-8 py-10 backdrop-blur">
        
        
        <div class="flex items-center gap-3 mb-6">
            <div class="h-10 w-10 rounded-xl bg-red-500 flex items-center justify-center shadow-md">
                <span class="text-white text-sm font-bold">INV</span>
            </div>
            <div>
                <h1 class="text-lg font-semibold text-white">Inventory System</h1>
                <p class="text-xs text-slate-400 mt-1">Sign in to manage products and stock.</p>
            </div>
        </div>

        
        <?php if(session('status')): ?>
            <div class="mb-4 rounded-lg bg-emerald-500/10 border border-emerald-500/60 text-emerald-100 px-4 py-2 text-xs">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-5">
            <?php echo csrf_field(); ?>

            
            <div>
                <label for="email" class="block text-xs font-semibold text-slate-300 mb-1">
                    Email
                </label>
                <input id="email"
       type="email"
       name="email"
       value="<?php echo e(old('email')); ?>"
       required
       autofocus
       autocomplete="email"
       class="block w-full rounded-lg border border-slate-700 bg-slate-900/70 text-sm text-slate-100 px-3 py-2.5 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />

                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-xs text-red-400"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div>
                <label for="password" class="block text-xs font-semibold text-slate-300 mb-1">
                    Password
                </label>
                <input id="password"
       type="password"
       name="password"
       required
       autocomplete="current-password"
       class="block w-full rounded-lg border border-slate-700 bg-slate-900/70 text-sm text-slate-100 px-3 py-2.5 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />

                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-xs text-red-400"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="flex items-center justify-between text-xs text-slate-400">
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox"
                           name="remember"
                           data-lpignore="true"
                           class="rounded border-slate-600 bg-slate-900 text-indigo-500 focus:ring-indigo-500" />
                    <span>Remember me</span>
                </label>

                <?php if(Route::has('password.request')): ?>
                    <a href="<?php echo e(route('password.request')); ?>"
                       class="text-indigo-300 hover:text-indigo-200">
                        Forgot your password?
                    </a>
                <?php endif; ?>
            </div>

            
            <div class="pt-2">
                <button type="submit"
                        class="w-full inline-flex justify-center items-center px-4 py-2.5 rounded-lg bg-indigo-500 hover:bg-indigo-600 text-sm font-semibold text-white shadow-md transition">
                    Log In
                </button>
            </div>
        </form>

        
        <?php if(Route::has('register')): ?>
            <p class="mt-6 text-xs text-center text-slate-400">
                Don’t have an account?
                <a href="<?php echo e(route('register')); ?>" class="text-indigo-300 hover:text-indigo-200 font-semibold">
                    Register
                </a>
            </p>
        <?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Renz\Documents\it107finalprojectDeploy\DraftInventorySystem\resources\views/auth/login.blade.php ENDPATH**/ ?>