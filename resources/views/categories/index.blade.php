<x-app-layout>
    <x-slot name="header">
        Categories
    </x-slot>

    <div class="px-6 py-6 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-slate-800">Categories</h1>

            <a href="{{ route('categories.create') }}"
               class="inline-flex items-center px-5 py-2.5 rounded-xl bg-indigo-500 text-white text-sm font-semibold shadow-sm hover:bg-indigo-600 transition">
                <span class="mr-1 text-lg leading-none">＋</span>
                Add Category
            </a>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Name</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Description</th>
                        <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($categories as $category)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-3 text-slate-800">
                                {{ $category->name }}
                            </td>
                            <td class="px-5 py-3 text-slate-500">
                                {{ $category->description ?: '—' }}
                            </td>
                            <td class="px-5 py-3 text-right">
                                <div class="inline-flex gap-2">
                                    <a href="{{ route('categories.edit', $category) }}"
                                       class="text-xs px-3 py-1.5 rounded-full bg-slate-50 text-slate-700 hover:bg-slate-100">
                                        Edit
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                          onsubmit="return confirm('Delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-xs px-3 py-1.5 rounded-full bg-red-50 text-red-600 hover:bg-red-100">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-5 py-6 text-center text-slate-400 text-sm">
                                No categories yet. Click <strong>“Add Category”</strong> to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
