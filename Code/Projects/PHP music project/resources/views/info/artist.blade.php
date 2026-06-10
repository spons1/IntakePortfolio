<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $artist->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <img src="{{ asset('storage/' . $artist->image_path) }}"
                     alt="{{ $artist->name }}"
                     class="w-48 h-48 object-cover rounded-full mb-4">

                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $artist->name }}</h3>
                <p class="text-gray-600 dark:text-gray-300">Started in: {{ $artist->starting_year }}</p>
                <p class="mt-4 text-gray-800 dark:text-gray-200">{{ $artist->description }}</p>
            </div>
            <a href="{{ route('artist-list') }}">
                <x-primary-button class="mt-4">Go Back</x-primary-button>
            </a>
        </div>
    </div>
    <div class="mt-8 bg-gray-700 p-6 rounded-lg max-w-2xl mx-auto">
        <h3 class="text-xl font-semibold text-white mb-4">Albums made by this artist</h3>
        @forelse($artist->albums as $album)
            <div class="mb-4 border-b border-gray-600 pb-2">
                <a href="{{ route('album-show', $album->id) }}">
                    <h1 class="text-lg font-bold text-white">{{ $album->titel }}</h1>
                </a>
            </div>
        @empty
            <div class="bg-gray-800 p-4 rounded shadow text-gray-400 text-center">
                No albums by this artist.
            </div>
        @endforelse
    </div>
</x-app-layout>
