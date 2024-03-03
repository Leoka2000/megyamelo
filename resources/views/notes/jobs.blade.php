<x-app-layout>
    <x-slot name="header">
        <h2 class="text-base font-semibold leading-tight text-gray-800 sm:text-xl dark:text-gray-300">
           {{ __('job.post-job.01') }}
        </h2>
    </x-slot>
    <div class="py-20 sm:py-32">
        <div class="px-3 mx-auto lg:max-w-5xl sm:max-w-3xl sm:px-16 lg:px-52">
            <div class="text-gray-900 sm:p-6 ">
                 <x-button wire:navigate icon="arrow-left" class="mb-8" href="{{ route('dashboard') }}">{{ __('show-notes.show-notes-2') }}</x-button>
                <livewire:notes.show-jobs lazy />
            </div>
        </div>
    </div>
</x-app-layout>