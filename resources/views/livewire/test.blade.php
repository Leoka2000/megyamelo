<?php

use Livewire\Volt\Component;

new class extends Component {
    public $showModal = false;

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}; ?>

<div>
    <x-button wire:click="openModal" label="Save" spinner="save" primary />

    @if ($showModal)
        <x-modal wire:model="showModal" class="" title="Simple Modal">
            <div class='flex flex-col h-auto gap-2 p-12 bg-gray-900 dark:text-gray-300 w-96 rounded-xl '>
                <p class='mb-4 sm:text-base'>Are you sure that you want to delete the post? After deleting, you will not be able to recover your coins.</p>
                <x-button positive  icon='arrow-left' wire:click="closeModal">Back</x-button>
                <x-button negative outline icon='trash'>Delete</x-button>
            </div>
        </x-modal>
    @endif
</div>
