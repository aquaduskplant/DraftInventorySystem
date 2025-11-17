<x-app-layout>
    <x-slot name="header">
        Stock History
    </x-slot>

    <div class="px-6 py-6 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-slate-800">Stock History</h1>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Date</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Product</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Type</th>
                        <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">Quantity</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Note</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($movements as $move)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-3 text-slate-500">
                                {{ $move->created_at->format('Y-m-d H:i') }}
                            </td>
                            <td class="px-5 py-3 text-slate-800">
                                {{ $move->product->name ?? '—' }}
                            </td>
                            <td class="px-5 py-3">
                                @if($move->type === 'in')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold">
                                        Stock In
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-semibold">
                                        Stock Out
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-right text-slate-800">
                                {{ $move->quantity }}
                            </td>
                            <td class="px-5 py-3 text-slate-500">
                                {{ $move->note ?: '—' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-6 text-center text-slate-400 text-sm">
                                No stock movements recorded yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
