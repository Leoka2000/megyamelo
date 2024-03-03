<x-app-layout>
    <x-slot name="header">
        <h2 class="text-base font-semibold leading-tight sm:text-xl dark:text-gray-300">
            {{ __('create-note.create-01') }}
        </h2>
    </x-slot>

    <div class="py-20 sm:py-32">
        <div class="max-w-2xl px-3 mx-auto space-y-4 sm:px-6 lg:px-8">
            <x-button icon="arrow-left" class="mb-8" href="{{ route('dashboard') }}"> {{__('create-note.create-1')}}</x-button>
            <livewire:notes.create-note />
        </div>
    </div>
</x-app-layout>