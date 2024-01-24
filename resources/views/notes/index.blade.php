<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="px-2 mx-auto max-w-7xl sm:px-4 lg:px-6">
            <div class="p-6 text-gray-900">
             
                <livewire:notes.show-notes lazy />
            </div>
        </div>
    </div>
</x-app-layout>