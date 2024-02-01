<div
    class="fixed z-20 flex items-center justify-between w-full h-20 pr-2 border-b border-gray-700 sm:top-0 sm:right-0 text-end bg-slate-900">
    <a href="{{ route('dashboard') }}" wire:navigate>
        <div class='flex items-center justify-center mt-2 w-36'>
            <img class='object-cover w-full h-full rounded-md' src="{{ asset('logo-top.png') }}" alt="logo"
                title="logo" />
        </div>
    </a>
    @auth

        <x-button primary icon='arrow-right' href="{{ url('dashboard') }}" 
           sm class="font-semibold text-gray-300 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            wire:navigate>Dashboard</x-button>
    @else
        <div class='flex'>
            <x-button primary icon='arrow-right' href="{{ route('login') }}"
              sm  class="font-semibold text-gray-300 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                wire:navigate>Log in</x-button>

            @if (Route::has('register'))
                <x-button outline icon='clipboard' primary href="{{ route('register') }}" 
                    sm class="font-semibold text-gray-300 ms-4 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    wire:navigate>Register</x-button>
            @endif
        </div>
    @endauth
</div>
