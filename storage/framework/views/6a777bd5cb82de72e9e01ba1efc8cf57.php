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
    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl shadow-2xl px-8 py-10 backdrop-blur w-full max-w-lg">

        
        <div class="mb-6">
            <h1 class="text-xl font-semibold text-white">Create an Account</h1>
            <p class="text-slate-400 text-sm mt-1">Register to access the inventory system.</p>
        </div>

        <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-5">
            <?php echo csrf_field(); ?>

            
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Name</label>
                <input type="text"
                       name="name"
                       value="<?php echo e(old('name')); ?>"
                       required
                       autocomplete="off"
                       data-lpignore="true"
                       class="w-full px-3 py-2.5 rounded-lg border border-slate-700 bg-slate-900/70 text-slate-100 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Email</label>
                <input type="email"
                       name="email"
                       value="<?php echo e(old('email')); ?>"
                       required
                       autocomplete="off"
                       data-lpignore="true"
                       class="w-full px-3 py-2.5 rounded-lg border border-slate-700 bg-slate-900/70 text-slate-100 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Password</label>
                <input type="password"
                       name="password"
                       required
                       autocomplete="new-password"
                       data-lpignore="true"
                       class="w-full px-3 py-2.5 rounded-lg border border-slate-700 bg-slate-900/70 text-slate-100 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Confirm Password</label>
                <input type="password"
                       name="password_confirmation"
                       required
                       autocomplete="new-password"
                       data-lpignore="true"
                       class="w-full px-3 py-2.5 rounded-lg border border-slate-700 bg-slate-900/70 text-slate-100 text-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            
            <button type="submit"
                    class="w-full mt-3 px-4 py-2.5 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold text-sm rounded-lg shadow-md transition">
                Register
            </button>
        </form>

        
        <p class="mt-6 text-center text-xs text-slate-400">
            Already have an account?
            <a href="<?php echo e(route('login')); ?>" class="text-indigo-300 hover:text-indigo-200 font-semibold">
                Log in
            </a>
        </p>
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
<?php /**PATH C:\Users\Renz\Documents\it107finalproject\DraftInventorySystem\resources\views/auth/register.blade.php ENDPATH**/ ?>