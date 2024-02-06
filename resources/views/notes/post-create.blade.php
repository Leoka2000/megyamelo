<x-app-layout>
    <x-slot name="header">
        <h2 class="text-sm font-semibold leading-tight text-gray-800 dark:text-gray-300 sm:text-xl">
            {{ __('nav.nav-create-post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl px-4 mx-auto space-y-4 sm:px-6 lg:px-8">
            <x-button wire:navigate icon="arrow-left" class="mb-8" href="{{ route('dashboard') }}">{{ __('show-notes.show-notes-2') }}</x-button>
        <livewire:notes.form-post />
        </div>
    </div>
</x-app-layout>