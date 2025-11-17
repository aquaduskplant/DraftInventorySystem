<x-guest-layout>
    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl shadow-2xl px-8 py-10 backdrop-blur">
        
        {{-- Logo / title --}}
        <div class="flex items-center gap-3 mb-6">
            <div class="h-10 w-10 rounded-xl bg-red-500 flex items-center justify-center shadow-md">
                <span class="text-white text-sm font-bold">INV</span>
            </div>
            <div>
                <h1 class="text-lg font-semibold text-white">Inventory System</h1>
                <p class="text-xs text-slate-400 mt-1">Sign in to manage products and stock.</p>
            </div>
        </div>

        {{-- Session Status --}}
        @if (session('status'))
            <div class="mb-4 rounded-lg bg-emerald-500/10 border border-emerald-500/60 text-emerald-100 px-4 py-2 text-xs">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-xs font-semibold text-slate-300 mb-1">
                    Email
                </label>
                <input id="email"
       type="email"
       name="email"
       value="{{ old('email') }}"
       required
       autofocus
       autocomplete="email"
       class="block w-full rounded-lg border border-slate-700 bg-slate-900/70 text-sm text-slate-100 px-3 py-2.5 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />

                @error('email')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
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

                @error('password')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember & Forgot --}}
            <div class="flex items-center justify-between text-xs text-slate-400">
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox"
                           name="remember"
                           data-lpignore="true"
                           class="rounded border-slate-600 bg-slate-900 text-indigo-500 focus:ring-indigo-500" />
                    <span>Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-indigo-300 hover:text-indigo-200">
                        Forgot your password?
                    </a>
                @endif
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button type="submit"
                        class="w-full inline-flex justify-center items-center px-4 py-2.5 rounded-lg bg-indigo-500 hover:bg-indigo-600 text-sm font-semibold text-white shadow-md transition">
                    Log In
                </button>
            </div>
        </form>

        {{-- Register link --}}
        @if (Route::has('register'))
            <p class="mt-6 text-xs text-center text-slate-400">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-indigo-300 hover:text-indigo-200 font-semibold">
                    Register
                </a>
            </p>
        @endif
    </div>
</x-guest-layout>
