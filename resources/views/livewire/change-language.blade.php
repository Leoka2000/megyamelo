<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div class='dark:text-gray-300'>

  <x-dropdown>
        <x-slot name="trigger">
            <button class='flex gap-2'> <x-flag-country-hu class="w-5 h-5" /><x-flag-country-us class="w-5 h-5" /></button>
        </x-slot>

        <x-dropdown.item class='flex gap-2'  spinner href="{{ route('locale', 'hu') }}"> <x-flag-country-hu class="w-6 h-6" /> Hungarian</x-dropdown.item>
        <x-dropdown.item class='flex gap-2'  spinner href="{{ route('locale', 'en') }}" > <x-flag-country-us class="w-6 h-6" /> English</x-dropdown.item>

    </x-dropdown>

</div>
