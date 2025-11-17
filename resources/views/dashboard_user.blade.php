<x-app-layout>
    <x-slot name="header">
        <div class="text-lg font-semibold text-slate-800">
            Inventory Overview
        </div>
    </x-slot>

    <div class="px-6 py-6 space-y-6">

        {{-- Top summary cards (read-only) --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <div class="text-xs text-slate-500 uppercase tracking-wide mb-1">Products</div>
                <div class="text-3xl font-bold text-slate-800">{{ $productCount }}</div>
                <div class="text-[12px] mt-1 text-slate-400">Items available in the system</div>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <div class="text-xs text-slate-500 uppercase tracking-wide mb-1">Categories</div>
                <div class="text-3xl font-bold text-slate-800">{{ $categoryCount }}</div>
                <div class="text-[12px] mt-1 text-slate-400">Groups organizing products</div>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <div class="text-xs text-slate-500 uppercase tracking-wide mb-1">Total Qty in Stock</div>
                <div class="text-3xl font-bold text-emerald-600">{{ $totalQuantity }}</div>
                <div class="text-[12px] mt-1 text-slate-400">All units currently in stock</div>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <div class="text-xs text-slate-500 uppercase tracking-wide mb-1">Low Stock Items</div>
                <div class="text-3xl font-bold text-red-600">{{ $lowStockCount }}</div>
                <div class="text-[12px] mt-1 text-slate-400">Items close to running out</div>
            </div>
        </div>

        {{-- Middle section --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm lg:col-span-2">
                <h2 class="text-sm font-semibold text-slate-800 uppercase tracking-wide mb-3">
                    Inventory Details
                </h2>

                <p class="text-sm text-slate-600 mb-4">
                    This page gives a quick overview of the current inventory. You can browse
                    products and categories, and review stock levels. Editing, adding, or removing
                    data is reserved for administrators.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-1 gap-3 text-sm">
                    <a href="{{ route('products.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-200 px-4 py-2 hover:bg-slate-50 text-slate-700">
                        📦 View Products
                    </a>
                </div>


            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
                <h2 class="text-sm font-semibold text-slate-800 uppercase tracking-wide mb-3">
                    Your Access
                </h2>
                <p class="text-sm text-slate-700">
                    Logged in as <span class="font-semibold">{{ Auth::user()->name }}</span>.
                </p>
                <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                    You can view inventory data such as product lists, categories, and stock history.
                    Only admin accounts can create, edit, or delete records or adjust inventory levels.
                    If you need changes made, please contact an admin.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
