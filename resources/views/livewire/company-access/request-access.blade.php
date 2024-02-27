<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyMail;
use WireUi\Traits\Actions;

new class extends Component {
    use Actions;

    public $showModal = false;
    public $showSuccessModal = false;

    public $companyName;
    public $companyEmail;
    public $companyMessage;

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'companyName' => ['required', 'string', 'min:3'],
            'companyEmail' => ['required', 'email'],
            'companyMessage' => ['required', 'string'],
        ]);

        Mail::to('lreusoliveira@gmail.com')->send(new CompanyMail($validatedData['companyName'], $validatedData['companyEmail'], $validatedData['companyMessage']));

        $this->closeModal();
        $this->dialog()->show([
            'icon' => 'success',
            'title' => 'Message sent!',
            'description' => 'We will reply soon with intructions on partnering with us',
        ]);
    }
}; ?>

<div class='inline-block dark:text-gray-300'>
    <a wire:click='openModal' class='inline-block text-sm text-indigo-500 border-b cursor-pointer border-b-indigo-500'>
        {{ __('dashboardz.dashboardz-6') }}</a>

    @if ($showModal)
        <x-modal wire:model="showModal" title="Simple Modal">


            <div
                class='flex flex-col items-start justify-center p-5 mb-2 bg-gray-100 rounded-md dark:bg-gray-900 md:p-12 dark:text-gray-300 '>

                <p class='mb-2 text-xl font-bold text-left w-72 dark:text-gray-300'>
                    {{ __('job.contact-job.1') }}
                </p>

                <form accept-charset="UTF-8" class='flex flex-col w-full' wire:submit.prevent="submit">
                    <x-wui-errors class="mb-4" />
                    <!-- Correct order of form inputs -->
                    <label for="companyName"> {{ __('job.contact-job.2') }} </label>
                    <x-wui-input type="text" id="companyName" wire:model.defer="companyName" />
                    <label for="companyEmail"> {{ __('job.contact-job.3') }} </label>
                    <x-wui-input type="text" id="companyEmail" wire:model.defer="companyEmail" />

                    <label for="companyMessage">{{ __('job.contact-job.4') }}</label>
                    <x-wui-textarea type="text" id="companyMessage" wire:model.defer="companyMessage" />
                    <div class='flex flex-col gap-2'>
                        <x-button icon='mail' class='mt-5' spinner primary
                            type="submit">{{ __('job.contact-job.5') }}</x-button>
                        <x-button icon='x-circle' class='' spinner outline red
                            wire:click='closeModal'>{{ __('job.contact-job.6') }}</x-button>
                    </div>
                </form>

            </div>
        </x-modal>
    @endif


</div>
