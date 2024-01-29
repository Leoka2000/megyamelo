<?php

use Livewire\Volt\Component;

new class extends Component {}; ?>

<div>
    <x-app-layout>


        <div class="p-12">
            <div class="flex flex-col items-center max-w-2xl px-4 mx-auto mt-12 space-y-4 dark:text-gray-300 sm:px-6 lg:px-8">
                <h1 class='text-3xl'>
                    Success! You have just received two advertisements to post.
                </h1>
                <x-button lg icon='arrow-left' label='Back to home' href="{{ route('notes.payment.payment-index') }}"/>
            </div>
        </div>
    </x-app-layout>
</div>
