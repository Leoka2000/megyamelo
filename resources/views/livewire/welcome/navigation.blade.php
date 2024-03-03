<div
    class="fixed z-20 flex items-center justify-between w-full h-20 pr-2 border-b border-gray-700 sm:top-0 sm:right-0 text-end bg-slate-900">
    <a href="{{ route('dashboard') }}" wire:navigate>
        <div class='flex w-20 mt-6 sm:mt-8 sm:w-36'>
            <img class='object-cover w-full h-full rounded-md opacity-80' src="{{ asset('logo-top.png') }}" alt="logo"
                title="logo" />
        </div>
    </a>
     <div class='absolute sm:right-4 right-2 top-24'>
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button class='flex gap-2'> <x-flag-country-hu class="w-5 h-5 sm:w-6 sm:h-6" /><x-flag-country-us
                                    class="w-5 h-5 sm:w-6 sm:h-6" /></button>
                        </x-slot>
                        <x-dropdown.item class='flex gap-2' spinner href="{{ route('locale', 'hu') }}">
                            <x-flag-country-hu class="w-6 h-6" /> Magyarul</x-dropdown.item>
                        <x-dropdown.item class='flex gap-2' spinner href="{{ route('locale', 'en') }}">
                            <x-flag-country-us class="w-6 h-6" /> English</x-dropdown.item>
                    </x-dropdown>
                </div>
    @auth

        <x-button rounded primary right-icon='arrow-right ' href="{{ url('dashboard') }}" 
           sm class="font-semibold text-gray-300 md:w-52 md:h-10 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            wire:navigate>Dashboard</x-button>
    @else
        <div class='flex'>
            <x-button rounded primary right-icon='arrow-right' href="{{ route('notes.create') }}"
              sm  class="font-semibold text-gray-300 md:w-52 md:h-10 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                wire:navigate> {{__('nav.nav-login')}} </x-button>

            @if (Route::has('register'))
                <x-button rounded outline right-icon='clipboard' primary href="{{ route('register') }}" 
                    sm class="font-semibold text-gray-300 md:h-10 md:w-52 ms-4 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    wire:navigate>{{__('nav.nav-register')}} </x-button>
            @endif
        </div>
    @endauth
</div>
