<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Inventory System') }}</title>


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-100 text-slate-900">
        <div class="min-h-screen flex">

            {{-- LEFT SIDEBAR --}}
            <aside class="w-64 bg-[#0f172a] text-slate-100 flex flex-col shadow-xl">
    @php
        $user = auth()->user();
        $isAdmin = $user && $user->role === 'admin';
    @endphp

    {{-- Logo --}}
    <div class="h-16 flex items-center px-6 border-b border-slate-800">
        <div class="flex items-center gap-3">
            <div class="h-9 w-9 rounded-xl bg-red-500 flex items-center justify-center shadow-md">
                <span class="text-white text-sm font-bold">INV</span>
            </div>
            <div class="leading-tight">
                <div class="font-semibold text-white text-[15px]">Inventory</div>
                <div class="text-slate-400 text-[11px] -mt-1">Management System</div>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 py-4 px-3 space-y-1 text-sm">
        @if($isAdmin)
            {{-- ADMIN: all links enabled --}}
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-all
                     {{ request()->routeIs('dashboard') ? 'bg-red-500/90 text-white shadow-md' : 'text-slate-200 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">📊</span>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('products.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-all
                     {{ request()->routeIs('products.*') ? 'bg-slate-800 text-white' : 'text-slate-200 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">📦</span>
                <span>Inventory</span>
            </a>

            <a href="{{ route('categories.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-all
                     {{ request()->routeIs('categories.*') ? 'bg-slate-800 text-white' : 'text-slate-200 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">🗂</span>
                <span>Categories</span>
            </a>

            <a href="{{ route('stock.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-all
                     {{ request()->routeIs('stock.*') ? 'bg-slate-800 text-white' : 'text-slate-200 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">📈</span>
                <span>Stock History</span>
            </a>

            <div class="pt-4 text-[11px] uppercase tracking-wide text-slate-500 px-3">
                Other
            </div>

            <button class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-slate-400 bg-slate-800/50 cursor-default">
                <span class="text-lg">📑</span> Reports
            </button>
            <button class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-slate-400 bg-slate-800/50 cursor-default">
                <span class="text-lg">📄</span> Documents
            </button>

        @else
            {{-- USER: ONLY Inventory is a link; everything else is plain text --}}

            {{-- Dashboard label (not clickable) --}}
            <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-slate-500 bg-slate-800/40">
                <span class="text-lg opacity-70">📊</span>
                <span>Dashboard</span>
            </div>

            {{-- Inventory: the ONLY working link --}}
            <a href="{{ route('products.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-all
                     {{ request()->routeIs('products.*') ? 'bg-slate-800 text-white' : 'text-slate-200 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">📦</span>
                <span>Inventory</span>
            </a>

            {{-- Categories label (not clickable) --}}
            <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-slate-500 bg-slate-800/40">
                <span class="text-lg opacity-70">🗂</span>
                <span>Categories</span>
            </div>

            {{-- Stock History label (not clickable) --}}
            <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-slate-500 bg-slate-800/40">
                <span class="text-lg opacity-70">📈</span>
                <span>Stock History</span>
            </div>

            <div class="pt-4 text-[11px] uppercase tracking-wide text-slate-500 px-3">
                Other
            </div>

            {{-- Reports & Documents (already disabled style) --}}
            <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-slate-500 bg-slate-800/40">
                <span class="text-lg opacity-70">📑</span> Reports
            </div>
            <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-slate-500 bg-slate-800/40">
                <span class="text-lg opacity-70">📄</span> Documents
            </div>
        @endif
    </nav>

    {{-- User info bottom --}}
    <div class="border-t border-slate-800 px-4 py-4 text-xs text-slate-400 bg-[#0d1527]">
        <div class="font-semibold text-slate-100">{{ $user->name }}</div>
        <div class="uppercase tracking-wide text-[11px]">
            {{ strtoupper($user->role) }}
        </div>
    </div>
</aside>



            {{-- RIGHT SIDE: TOP BAR + PAGE CONTENT --}}
            <div class="flex-1 flex flex-col">

                {{-- Top bar --}}
                            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 shadow-sm">
                <div class="text-xl font-semibold text-slate-800">
                    {{ $header ?? 'Dashboard' }}
                </div>

                <div class="flex items-center gap-4">
                    <div class="hidden md:flex items-center bg-slate-100 rounded-full px-4 py-1.5 text-xs text-slate-500 w-64 border border-slate-200">
                        <span class="mr-2 opacity-70">🔍</span> Search...
                    </div>

                    {{-- Logout --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-xs font-semibold text-slate-700 border border-slate-300 rounded-full px-4 py-1.5 hover:bg-slate-50 transition">
                            Log Out
                        </button>
                    </form>
                </div>
            </header>


                {{-- Main page content --}}
                <main class="flex-1 bg-slate-50">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
