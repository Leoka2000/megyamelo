<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use WireUi\Traits\Actions;

new class extends Component {

    use Actions;
    public $showModal = false;
    public $name;
    public $email;
    public $topic;

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
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email'],
            'topic' => ['required', 'string'],
        ]);

        Mail::to('lreusoliveira@gmail.com')->send(new ContactFormMail($validatedData['name'], $validatedData['email'], $validatedData['topic']));

        $this->showModal = false;

      $this->dialog()->show([
            'icon' => 'success',
            'title' => 'Message sent!',
            'description' => 'Your message was successfully sent',
        ]);
    }
}; ?>

<div>
    <x-button.circle icon='inbox' smc outline wire:click="openModal" />

    @if ($showModal)
        <x-modal wire:model="showModal" class="" title="Simple Modal">


            <div
                class='flex flex-col items-center justify-center gap-2 p-5 mb-2 bg-gray-900 rounded-md md:p-12 dark:text-gray-300 '>

                <p class='w-64 text-xl font-bold text-center dark:text-gray-300'>
                    Contact me.
                </p>

                <form class='flex flex-col w-full gap-2' wire:submit.prevent="submit">
                    <!-- Correct order of form inputs -->
                    <label for="name">Your name:</label>
                    <x-wui-input type="text" id="name" wire:model.defer="name" />
                    <label for="email">Your email:</label>
                    <x-wui-input type="text" id="email" wire:model.defer="email" />

                    <label for="topic">Tell me what is on your mind</label>
                    <x-wui-textarea type="text" id="topic" wire:model.defer="topic" />

                    <x-button class='mt-5' spinner primary type="submit">Submit</x-button>
                    <x-button class='' spinner outline red wire:click='closeModal'>Cancel</x-button>
                </form>

            </div>
        </x-modal>
    @endif
</div>
