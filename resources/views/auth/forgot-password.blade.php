<x-guest-layout>
    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl shadow-2xl px-8 py-10 backdrop-blur w-full max-w-lg">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-xl font-semibold text-white">Forgot Password</h1>
            <p class="text-slate-400 text-sm mt-1">
                Enter your email address and a password reset link will be sent to you.
            </p>
        </div>

        {{-- Status message --}}
        @if (session('status'))
            <div class="mb-4 rounded-lg bg-emerald-500/10 border border-emerald-500/60 text-emerald-100 px-4 py-2 text-xs">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
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
                       autocomplete="off"
                       data-lpignore="true"
                       class="block w-full rounded-lg border border-slate-700 bg-slate-900/70 text-sm text-slate-100 px-3 py-2.5 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                @error('email')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button type="submit"
                        class="w-full inline-flex justify-center items-center px-4 py-2.5 rounded-lg bg-indigo-500 hover:bg-indigo-600 text-sm font-semibold text-white shadow-md transition">
                    Send Password Reset Link
                </button>
            </div>
        </form>

        {{-- Back to login --}}
        <p class="mt-6 text-center text-xs text-slate-400">
            Remembered your password?
            <a href="{{ route('login') }}" class="text-indigo-300 hover:text-indigo-200 font-semibold">
                Back to Login
            </a>
        </p>
    </div>
</x-guest-layout>
