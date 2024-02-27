<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyMail;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Session; 

new class extends Component {
    use Actions;
    
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

   $this->closeModal();
     // Flash success message to be retrieved on the next request
        Session::flash('success', [
            'icon' => 'success',
            'title' => 'Message sent!',
            'description' => 'We will reply soon with instructions on partnering with us',
        ]);

        // Redirect to the dashboard route
       redirect()->route('dashboard')->with('success', 'Message sent! We will reply soon with instructions on partnering with us.');
    }
}; ?>

<div class='inline-block dark:text-gray-300 '>
    <x-button wire:click='openModal' icon='mail' primary spinner
        class='w-full text-indigo-500 cursor-pointer '>{{ __('show-notes.show-notes-7.4') }}</x-button>

    @if ($showModal)
        <x-modal wire:model="showModal" title="Simple Modal">


            <div
                class='flex flex-col items-center justify-center gap-2 p-5 mb-2 bg-gray-100 rounded-md dark:bg-gray-900 md:p-12 dark:text-gray-300 '>

                <p class='mb-5 text-lg font-bold text-left md:text-xl w-72 dark:text-gray-300'>
                  {{__('job.contact-job.1')}}
                </p>

                <form accept-charset="UTF-8" class='flex flex-col w-full gap-2 text-left' wire:submit.prevent="submit">
                    <x-wui-errors class="mb-4" />
                    <!-- Correct order of form inputs -->
                    <label for="companyName">{{__('job.contact-job.2')}}</label>
                    <x-wui-input type="text" id="companyName" wire:model.defer="companyName" />
                    <label for="companyEmail">{{__('job.contact-job.3')}}</label>
                    <x-wui-input type="text" id="companyEmail" wire:model.defer="companyEmail" />

                    <label for="companyMessage">{{__('job.contact-job.4')}}</label>
                    <x-wui-textarea type="text" id="companyMessage" wire:model.defer="companyMessage" />

                    <x-button icon='mail' class='mt-5' spinner primary type="submit">{{__('job.contact-job.5')}}</x-button>
                    <x-button class='' icon='x-circle' spinner outline red wire:click='closeModal'>{{__('job.contact-job.6')}}</x-button>
                </form>

            </div>
        </x-modal>
    @endif
</div>
