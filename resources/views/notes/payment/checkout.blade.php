<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight dark:text-gray-300">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl px-4 mx-auto space-y-4 sm:px-6 dark:text-gray-300 lg:px-8">
            <x-button icon="arrow-left" class="mb-8" href="{{ route('notes.payment.payment-index') }}">Back</x-button>
        {{-- <livewire:notes.payment /> --}}
        </div>
    </div>
</x-app-layout>