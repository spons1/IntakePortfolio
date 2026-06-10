<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $album->titel }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <img src="{{ asset('storage/' . $album->cover_path) }}"
                     alt="{{ $album->titel }}"
                     class="w-48 h-48 object-cover rounded-full mb-4">

                <h3 class="text-2xl font-bold text-white">{{ $album->titel }}</h3>
                <p class="text-gray-300">Genre: {{ $album->genre }}</p>
                <p class="text-gray-300">Released: {{ $album->release_datum }}</p>
                <p class="text-gray-300">Artist: <a href="{{ route('artist-show', $album->user_id) }}">{{ $album->artist->name }}</a></p>
                <p class="text-gray-300">Uploaded by: {{ $album->user->name ?? 'Deleted User' }}</p>
                <p class="text-gray-300">Upload date: {{ $album->created_at }}</p>
            </div>
            
            <a href="{{ route('album-list') }}">
                <x-primary-button class="mt-4">Go Back</x-primary-button>
            </a>
        </div>
    <div class="mt-8 bg-gray-700 p-6 rounded-lg max-w-2xl mx-auto">
        <h3 class="text-xl font-semibold text-white mb-4">Reviews</h3>
        @forelse($album->reviews as $review)
            <div class="mb-4 border-b border-gray-600 pb-2">
                <a href="{{ route('user-info', $review->user_id) }}">
                    <h4 class="text-lg font-bold text-white">
                        {{ $review->title }} 
                        <span class="text-gray-400 text-sm">by {{ $review->user->name ?? 'Deleted User' }} - uploaded on {{ $review->created_at }}</span>
                        {{ $review->stars }}/5
                    </h4>
                </a>
                <p class="text-gray-300">{{ $review->message }}</p>
                @if (auth()->user()->is_admin || auth()->id() == $review->user_id)
                    <form method="POST" action="{{ route('album-review-delete', $review->id) }}" onsubmit="return confirm('Delete this review?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 ml-4">Delete</button>
                </form>
                @endif
            </div>
        @empty
            <div class="bg-gray-800 p-4 rounded shadow text-gray-400 text-center">
                No reviews yet.
            </div>
        @endforelse
    </div>
    <div class="mt-8 bg-gray-700 p-6 rounded-lg max-w-2xl mx-auto">
        <h3 class="text-xl font-semibold text-white mb-4">Write a Review</h3>
        <form method="POST" action="{{ route('album-review-store', $album->id) }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-300">Title</label>
                <input type="text" name="title" required class="w-full px-3 py-2 rounded bg-gray-600 text-white">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300">Message</label>
                <textarea name="message" rows="4" required class="w-full px-3 py-2 rounded bg-gray-600 text-white"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300">Rating</label>
                <input type="number" name="stars" min="1" max="5" required class="w-full px-3 py-2 rounded bg-gray-600 text-white">
            </div>
            <x-primary-button>Submit Review</x-primary-button>
        </form>
    </div>
</x-app-layout>
