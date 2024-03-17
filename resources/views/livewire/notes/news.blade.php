<?php

use Livewire\Volt\Component;

new class extends Component {
    public $showModal = false;

    public function mount()
    {
        $this->openModal();
    }

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
    @if ($showModal)
        <x-modal wire:model.defer="showModal" title="Simple Modal">
            <x-card>
                <div class='relative'>
                 <x-button.circle class='absolute -left-6 -top-7' flat xl icon='x-circle' label="Cancel"
                        x-on:click="close" />
                    <a class='flex items-center justify-center gap-1 mb-4'
                        href='https://hajdupress.hu/cikk/new-english-language-job-searching-platform-for-university-students'
                        target='_blank'>
                        <h1 class="text-xl text-indigo-500 border-b-2 cursor-pointer border-b-indigo-600 md:text-4xl ">
                            WE ARE ON THE NEWS!!</h1>
                        <x-button.circle icon="eye" primary> </x-button.circle>
                    </a>
                    <div class='p-1 border-2 border-gray-400 rounded-md w-3xl dark:border-gray-500 '>
                        <a class='cursor-pointer'
                            href='https://hajdupress.hu/cikk/new-english-language-job-searching-platform-for-university-students'
                            target="_blank">
                            <img rounded-md src="{{ asset('newsimage.jpeg') }}">
                        </a>
                    </div>
                </div>
            </x-card>

        </x-modal>
    @endif
</div>
