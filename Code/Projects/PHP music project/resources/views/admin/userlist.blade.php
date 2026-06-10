<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="space-y-4">
                    @foreach ($users as $user)
                        <a href="{{ route('user-info', $user->id) }}">
                            <div class="listitem flex items-center justify-between p-4 bg-gray-700 rounded-lg shadow">
                                <div>
                                    <h4 class="text-lg font-semibold text-white">{{ $user->name }}</h4>
                                </div>
                                <form action="{{ route('user-delete', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this artist?');">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button class="text-xs px-3 py-2 ml-4">Delete</x-danger-button>
                                </form>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

