<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyMail;

new class extends Component {
    public $showModal = false;

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

    Mail::to('lreusoliveira@gmail.com')->send(new CompanyMail(
        $validatedData['companyName'],
        $validatedData['companyEmail'],
        $validatedData['companyMessage']
    ));

    $this->showModal = false;
    session()->flash('message', 'Form submitted successfully!');
    }
}; ?>

<div class='inline-block dark:text-gray-300'>
    <a wire:click='openModal'
        class='inline-block text-indigo-500 cursor-pointer hover:border-b hover:border-b-indigo-500'>'link' </a>

    @if ($showModal)
        <x-modal wire:model="showModal" title="Simple Modal">


            <div
                class='flex flex-col items-center justify-center gap-2 p-5 mb-2 bg-gray-900 rounded-md md:p-12 dark:text-gray-300 '>

                <p class='text-xl font-bold text-center w-72 dark:text-gray-300'>
                    Are you a company and would like to parter with me? send me an inquire below.
                </p>

                <form accept-charset="UTF-8" class='flex flex-col w-full gap-2' wire:submit.prevent="submit">
                    <x-wui-errors class="mb-4" />
                    <!-- Correct order of form inputs -->
                    <label for="companyName">Company name:</label>
                    <x-wui-input type="text" id="companyName" wire:model.defer="companyName" />
                    <label for="companyEmail">Company email:</label>
                    <x-wui-input type="text" id="companyEmail" wire:model.defer="companyEmail" />

                    <label for="companyMessage">Do you have anything to share with me?</label>
                    <x-wui-textarea type="text" id="companyMessage" wire:model.defer="companyMessage" />

                    <x-button class='mt-5' spinner primary type="submit">Submit</x-button>
                    <x-button class='' spinner outline red wire:click='closeModal'>Cancel</x-button>
                </form>

            </div>
        </x-modal>
    @endif
</div>
