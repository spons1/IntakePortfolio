<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Create Artist</h1>
                    <form action="{{ route('artist-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input name="name" id="name" class="block mt-1 w-full" type="text"/>
                        <x-input-label for="year" :value="__('Year')" />
                        <x-text-input id="year" name="year" type="number" min="1000" max="{{ date('Y') }}" class="block mt-1 w-full" />
                        <x-input-label for="image" :value="__('Image')" class="mt-4" />
                        <input id="image" name="image" type="file" class="block mt-1 w-full text-white dark:text-gray-100" accept="image/*">
                        <x-input-label for="description" :value="__('Description')" class="mt-4" />
                        <textarea id="description" name="description" rows="4" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">{{ old('description') }}</textarea>
                        <x-primary-button class="mt-4">Create</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
