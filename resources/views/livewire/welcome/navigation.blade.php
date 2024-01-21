<div class="z-20 flex items-center justify-between w-full h-20 pr-2 border-b  border-gray-700 sm:fixed sm:top-0 sm:right-0 text-end  bg-slate-900">
 <a href="{{ route('dashboard') }}" wire:navigate>
                        <div class='flex items-center justify-center w-auto mt-2 w-36'>
                            <img class='object-cover w-full h-full rounded-md' src="{{ asset('logo-top.png') }}"
                                alt="sheesh" title="sheesh" />
                        </div>
                    </a>
    @auth
        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" wire:navigate>Dashboard</a>
    @else
    <div>
        <x-button primary href="{{ route('login') }}" class="font-semibold text-gray-300 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" wire:navigate>Log in</x-button>

        @if (Route::has('register'))
            <x-button outline primary href="{{ route('register') }}" class="font-semibold text-gray-300 ms-4 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" wire:navigate>Register</x-button>
        @endif
        </div>
    @endauth
</div>