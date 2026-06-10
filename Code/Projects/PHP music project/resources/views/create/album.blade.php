<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Album') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-white">
               <form action="{{ route('album-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-input-label for="titel" :value="__('Title')" />
                    <x-text-input id="titel" name="titel" type="text" class="mt-1 block w-full" required />
                    <x-input-label for="release_datum" :value="__('Release Date')" />
                    <x-text-input id="release_datum" name="release_datum" type="date" class="mt-1 block w-full" required />
                    <x-input-label for="genre" :value="__('Genre')" />
                    <x-text-input id="genre" name="genre" type="text" class="mt-1 block w-full" required />
                    <x-input-label for="artist_id" :value="__('Artist')" />
                    <select name="artist_id" id="artist_id" class="mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-300" required>
                        <option value="" disabled selected>Select Artist</option>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                        @endforeach
                    </select>
                    <x-input-label for="image" :value="__('Cover Image')" />
                    <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full text-white" required />
                    <x-primary-button class="mt-4">
                        Create Album
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
