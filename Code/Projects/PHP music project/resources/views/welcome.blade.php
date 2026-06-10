<x-guest-layout>
    <div class="min-h-screen bg-gray-900 text-white flex flex-col justify-between">
        <!-- Top Nav -->
        <div class="p-6 text-right">
            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm hover:underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm hover:underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm hover:underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
        <div class="flex-grow flex flex-col items-center justify-center text-center px-4">
            <h1 class="text-5xl font-extrabold mb-4">Welcome!</h1>
            <p class="text-lg text-gray-300 max-w-xl mb-8">
                Manage albums and their artists.
            </p>
            @guest
                <a href="{{ route('register') }}"
                   class="bg-sky-500 hover:bg-sky-700 text-white font-bold py-2 px-6 rounded-lg shadow">
                    Get Started
                </a>
            @else
                <a href="{{ route('dashboard') }}"
                   class="bg-emerald-500 hover:bg-emerald-700 text-white font-bold py-2 px-6 rounded-lg shadow">
                    Go to Dashboard
                </a>
            @endguest
    </div>
</x-guest-layout>
