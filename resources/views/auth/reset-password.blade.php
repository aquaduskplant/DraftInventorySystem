<x-guest-layout>
    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl shadow-2xl px-8 py-10 backdrop-blur w-full max-w-lg">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-xl font-semibold text-white">Reset Password</h1>
            <p class="text-slate-400 text-sm mt-1">Enter your new password to regain access.</p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            {{-- Email --}}
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email', $request->email) }}"
                       required
                       autofocus
                       autocomplete="off"
                       data-lpignore="true"
                       class="w-full px-3 py-2.5 rounded-lg border border-slate-700 bg-slate-900/70 text-slate-100 text-sm focus:ring-indigo-500 focus:border-indigo-500" />
                @error('email')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Password</label>
                <input type="password"
                       name="password"
                       required
                       autocomplete="new-password"
                       data-lpignore="true"
                       class="w-full px-3 py-2.5 rounded-lg border border-slate-700 bg-slate-900/70 text-slate-100 text-sm focus:ring-indigo-500 focus:border-indigo-500" />
                @error('password')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Confirm Password</label>
                <input type="password"
                       name="password_confirmation"
                       required
                       autocomplete="new-password"
                       data-lpignore="true"
                       class="w-full px-3 py-2.5 rounded-lg border border-slate-700 bg-slate-900/70 text-slate-100 text-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            {{-- Submit --}}
            <button type="submit"
                    class="w-full mt-3 px-4 py-2.5 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold text-sm rounded-lg shadow-md transition">
                Reset Password
            </button>
        </form>
    </div>
</x-guest-layout>
