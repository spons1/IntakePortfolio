<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Artist List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <a href="{{ route('artist-create') }}"
                   class="block w-full px-4 py-2 bg-sky-500 hover:bg-blue-700 text-white text-center rounded-lg shadow">
                    + Create Artist
                </a>
                <div class="space-y-4">
                    @foreach ($artists as $artist)
                        <div class="listitem flex items-center justify-between p-4 bg-gray-700 rounded-lg shadow">
                            <a href="{{ route('artist-show', $artist->id) }}" class="flex items-center space-x-4">
                                <img src="{{ asset('storage/' . $artist->image_path) }}"
                                    alt="{{ $artist->name }}"
                                    class="w-16 h-16 rounded-full object-cover">
                                <div>
                                    <h4 class="text-lg font-semibold text-white">{{ $artist->name }}</h4>
                                </div>
                            </a>

                            @auth
                                @if(auth()->user()->is_admin)
                                    <form action="{{ route('artist-delete', $artist->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this artist?');">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button class="text-xs px-3 py-2 ml-4">Delete</x-danger-button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

