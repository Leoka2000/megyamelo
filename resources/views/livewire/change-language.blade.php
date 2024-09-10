<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div class='dark:text-gray-300'>

    <x-dropdown>
        <x-slot name="trigger">
            <button class='flex gap-2'>
                <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m13 19 3.5-9 3.5 9m-6.125-2h5.25M3 7h7m0 0h2m-2 0c0 1.63-.793 3.926-2.239 5.655M7.5 6.818V5m.261 7.655C6.79 13.82 5.521 14.725 4 15m3.761-2.345L5 10m2.761 2.655L10.2 15" />
                </svg>

            </button>
        </x-slot>

        <x-dropdown.item class='flex gap-2' spinner href="{{ route('locale', 'hu') }}"> <x-flag-country-hu class="w-6 h-6" /> Hungarian</x-dropdown.item>
        <x-dropdown.item class='flex gap-2' spinner href="{{ route('locale', 'en') }}"> <x-flag-country-us class="w-6 h-6" /> English</x-dropdown.item>

    </x-dropdown>

</div>