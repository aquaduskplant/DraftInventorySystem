<x-app-layout>
    @php
        $productCount   = \App\Models\Product::count();
        $categoryCount  = \App\Models\Category::count();
        $totalQuantity  = \App\Models\Product::sum('quantity');
        $lowStockCount  = \App\Models\Product::where('quantity', '<', 5)->count(); // simple low-stock rule
    @endphp

    <div class="px-6 py-6 space-y-6">

        {{-- TOP ROW: metric cards similar to "Sales Activity" / "Inventory Summary" --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
                <div class="text-xs text-slate-500 uppercase tracking-wide mb-1">Products</div>
                <div class="text-3xl font-semibold text-slate-800">{{ $productCount }}</div>
                <div class="text-[11px] text-slate-400 mt-1">Total active products</div>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
                <div class="text-xs text-slate-500 uppercase tracking-wide mb-1">Categories</div>
                <div class="text-3xl font-semibold text-slate-800">{{ $categoryCount }}</div>
                <div class="text-[11px] text-slate-400 mt-1">Groups to organize items</div>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
                <div class="text-xs text-slate-500 uppercase tracking-wide mb-1">Total Qty In Stock</div>
                <div class="text-3xl font-semibold text-emerald-500">{{ $totalQuantity }}</div>
                <div class="text-[11px] text-slate-400 mt-1">All units across products</div>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
                <div class="text-xs text-slate-500 uppercase tracking-wide mb-1">Low Stock Items</div>
                <div class="text-3xl font-semibold text-red-500">{{ $lowStockCount }}</div>
                <div class="text-[11px] text-slate-400 mt-1">Quantity &lt; 5</div>
            </div>
        </div>

        {{-- MIDDLE: two big panels like "Sales Activity" + "Inventory Summary" --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            {{-- Product details / quick links --}}
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
                        <div class="text-red-500 font-semibold text-lg">{{ $lowStockCount }}</div>
                    </div>
                    <div>
                        <div class="text-slate-500">All Categories</div>
                        <div class="text-slate-800 font-semibold text-lg">{{ $categoryCount }}</div>
                    </div>
                    <div>
                        <div class="text-slate-500">All Products</div>
                        <div class="text-slate-800 font-semibold text-lg">{{ $productCount }}</div>
                    </div>
                    <div>
                        <div class="text-slate-500">Total Quantity</div>
                        <div class="text-emerald-500 font-semibold text-lg">{{ $totalQuantity }}</div>
                    </div>
                </div>

                <div class="mt-6 border-t border-slate-100 pt-4 grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center justify-center rounded-lg border border-slate-200 px-4 py-2 hover:bg-slate-50 text-slate-700">
                        📦 View Products
                    </a>
                    <a href="{{ route('categories.index') }}"
                       class="inline-flex items-center justify-center rounded-lg border border-slate-200 px-4 py-2 hover:bg-slate-50 text-slate-700">
                        🗂 Manage Categories
                    </a>
                    <a href="{{ route('stock.index') }}"
                       class="inline-flex items-center justify-center rounded-lg border border-slate-200 px-4 py-2 hover:bg-slate-50 text-slate-700">
                        📊 View Stock History
                    </a>
                </div>
            </div>

            {{-- Inventory summary panel --}}
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                <h2 class="text-sm font-semibold text-slate-800 uppercase tracking-wide mb-4">
                    Inventory Summary
                </h2>

                <div class="space-y-3 text-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Quantity in Hand</span>
                        <span class="font-semibold text-slate-800">{{ $totalQuantity }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Low Stock Items</span>
                        <span class="font-semibold text-red-500">{{ $lowStockCount }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Categories</span>
                        <span class="font-semibold text-slate-800">{{ $categoryCount }}</span>
                    </div>
                </div>

                <div class="mt-6 text-xs text-slate-400 leading-relaxed">
                    Keep an eye on low-stock items to avoid running out.
                    Use categories to group similar products and simplify restocking decisions.
                </div>
            </div>
        </div>

        {{-- BOTTOM: small table placeholder --}}
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
                        @foreach(\App\Models\Product::with('category')->latest()->take(5)->get() as $prod)
                            <tr class="border-b border-slate-50">
                                <td class="py-2">{{ $prod->name }}</td>
                                <td class="py-2 text-slate-500">{{ $prod->category->name ?? '—' }}</td>
                                <td class="py-2 text-right">{{ $prod->quantity }}</td>
                            </tr>
                        @endforeach
                        @if($productCount === 0)
                            <tr>
                                <td colspan="3" class="py-4 text-center text-slate-400">
                                    No products yet. Add your first product to see it here.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                <h2 class="text-sm font-semibold text-slate-800 uppercase tracking-wide mb-3">
                    User Info
                </h2>
                <p class="text-sm text-slate-700">
                    Logged in as <span class="font-semibold">{{ Auth::user()->name }}</span>
                    (<span class="uppercase text-xs">{{ Auth::user()->role }}</span>)
                </p>
                <p class="mt-3 text-xs text-slate-400">
                    Only admins can create, edit, or delete products and categories. Regular users can
                    log in to view inventory levels and product details.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
