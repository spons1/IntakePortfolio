<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="space-y-3">
                        <a href="{{ route('album-list') }}"
                           class="block w-full px-4 py-2 bg-teal-900 hover:bg-blue-700 text-white text-center rounded-lg shadow">
                            List of albums
                        </a>
                        <a href="{{ route('artist-list') }}"
                           class="block w-full px-4 py-2 bg-teal-900 hover:bg-blue-700 text-white text-center rounded-lg shadow">
                            List of artists
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
