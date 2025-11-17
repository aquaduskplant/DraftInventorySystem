<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Add Category') }}
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

                <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full rounded-lg bg-gray-800 border border-gray-700 px-3 py-2 text-sm text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                        <textarea name="description" rows="3"
                                  class="w-full rounded-lg bg-gray-800 border border-gray-700 px-3 py-2 text-sm text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4">
                        <a href="{{ route('categories.index') }}"
                           class="text-sm text-gray-400 hover:text-gray-200">
                            Cancel
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-sm font-semibold rounded-lg text-white shadow-md transition">
                            Save Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
