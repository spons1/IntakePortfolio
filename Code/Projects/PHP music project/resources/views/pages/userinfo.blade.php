<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h3>
                <hr>
                @if (auth()->user()->is_admin || auth()->id() == $user->id)
                    <form method="POST" action="{{ route('update-description', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <textarea name="description" rows="4" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $user->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        <x-primary-button class="mt-4">Update Description</x-primary-button>
                    </form>
                @else
                    <p class="text-gray-900 dark:text-white">{{ $user->description ?? 'No description yet :(' }}</p>
                @endif
            </div>
            <a href="{{ route('dashboard') }}">
                <x-primary-button class="mt-4">Return to Dashboard</x-primary-button>
            </a>
        </div>
    </div>
</x-app-layout>
