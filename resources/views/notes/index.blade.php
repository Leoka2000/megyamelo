<x-app-layout>
    <x-slot name="header">
        <h2 class="text-base font-semibold leading-tight text-gray-800 sm:text-xl dark:text-gray-300">
            {{ __('Job seekers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="px-2 mx-auto max-w-7xl ">
            <div class="flex flex-col items-center justify-center text-gray-900 sm:p-6">
             
                <livewire:notes.show-notes lazy />
            </div>
        </div>
    </div>
</x-app-layout>