<x-app-layout>
    <x-slot name="header">
        <h2 class="text-sm font-semibold leading-tight text-gray-800 dark:text-gray-300 sm:text-xl">
            {{ __('nav.nav-create-post') }}
        </h2>
    </x-slot>

    <div class="py-20 sm:py-12">
        <div class="mx-auto p-3 max-w-3xl sm:px-6 lg:px-8">

            <livewire:notes.form-post />
        </div>
    </div>
</x-app-layout>