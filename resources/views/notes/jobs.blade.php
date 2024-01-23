<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jobs') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-52">
            <div class="p-6 text-gray-900 ">
                 <x-button wire:navigate icon="arrow-left" class="mb-8" href="{{ route('dashboard') }}">Back</x-button>
                <livewire:notes.show-jobs lazy />
            </div>
        </div>
    </div>
</x-app-layout>