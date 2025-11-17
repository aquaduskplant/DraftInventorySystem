<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Stock Out: ') . $product->name }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900/80 border border-gray-800 shadow-xl rounded-xl p-6">
                @if ($errors->any())
                    <div class="mb-4 rounded-lg bg-red-600/10 border border-red-500/60 text-red-200 px-4 py-3 text-sm">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('stock.out.store', $product) }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Quantity to remove</label>
                        <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1"
                               class="w-full rounded-lg bg-gray-800 border border-gray-700 px-3 py-2 text-sm text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Note (optional)</label>
                        <textarea name="note" rows="3"
                                  class="w-full rounded-lg bg-gray-800 border border-gray-700 px-3 py-2 text-sm text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">{{ old('note') }}</textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4">
                        <a href="{{ route('products.index') }}"
                           class="text-sm text-gray-400 hover:text-gray-200">
                            Cancel
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-sm font-semibold rounded-lg text-white shadow-md transition">
                            Confirm Stock Out
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
