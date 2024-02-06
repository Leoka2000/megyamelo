<?php

use Livewire\Volt\Component;
use App\Models\Post;
use App\Models\User;
use Livewire\WithFileUploads;
use Components\Select\Option;
use Components\Select;
use WireUi\View\Components\Input;
use WireUi\Traits\Actions;

new class extends Component {
    use WithFileUploads;
    use Actions;

    public $showModal = false;
    public $showPaymentModal = false;
    public $showPermanentModal = false;

    public $companyAuthor;
    public $companyTitle;
    public $companyDescription;
    public $companyImage;
    public $companyLink;
    public $companyEmail;

    public function mount()
    {
        $currentUser = auth()->user();

        if ($currentUser->role !== 'admin' && $currentUser->role !== 'superadmin') {
            $this->openPermanentModal();
        }
    }
    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function openPermanentModal()
    {
        $this->showPermanentModal = true;
    }

    public function openPaymentModal()
    {
        $this->showPaymentModal = true;
    }

    public function closePaymentModal()
    {
        $this->showPaymentModal = false;
    }

    public function submit()
    {
        if ($this->companyLink) {
            $validated = $this->validate([
                'companyLink' => ['url'],
            ]);
        }

        if ($this->companyLink) {
            $validated = $this->validate([
                'companyEmail' => ['required', 'email'],
            ]);
        }

        $this->closeModal();
        $validated = $this->validate([
            'companyAuthor' => ['required', 'string', 'min:3'],
            'companyTitle' => ['required', 'string', 'min:3'],
            'companyImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'companyDescription' => ['required', 'string', 'min:5'],
        ]);
        // Get the current user
        $user = auth()->user();
        if ($user->coins <= 0) {
            // User has insufficient coins, display modal
            $this->showPaymentModal = true;
        } else {
            // User has enough coins, proceed with post creation
            $this->authorize('create', Post::class);
            $this->showModal = false;

            // Decrease the user's coins by one
            $user->coins -= 1;
            $user->save();

            auth()
                ->user()
                ->posts()
                ->create([
                    'author' => $this->companyAuthor,
                    'title' => $this->companyTitle,
                    'description' => $this->companyDescription,
                    'apply_link' => $this->companyLink,
                    'apply_email' => $this->companyEmail,
                    'image' => $this->companyImage->store('company', 'public'),
                ]);
                
         $this->dialog()->show([
            'icon' => 'success',
            'title' => 'Post created!',
            'description' => 'Your post was successfully created. Now you can view, edit, or delete your post whenever you feel like it.',
        ]);
        }
    }
}; ?>



<div class='shadow-2xl shadow-black'>
    <div class=''>


        @if ($showModal)
            <x-modal wire:model="showModal" class="" title="Simple Modal">
                <div class='flex flex-col h-auto gap-2 p-12 bg-gray-900 dark:text-gray-300 w-96 rounded-xl '>
                    <p class='mb-4 sm:text-base'>Are you sure that you want to spend a coin creating this post?</p>
                    <x-button outlined icon='arrow-left'
                        wire:click="closeModal">{{ __('show-notes.show-notes-2') }}</x-button>
                    <x-button wire:click='submit' primary icon='plus'>Post</x-button>
                </div>
            </x-modal>
        @endif
        @if ($showPermanentModal)
            <x-modal wire:model="showPermanentModal" blur="sm" persistent title="Simple Modal">
                <div
                    class='inline-block h-auto gap-2 p-12 text-lg text-center dark:bg-gray-900 dark:text-gray-400 w-96 rounded-xl'>
                    <strong class='inline-block dark:text-gray-300'> {{ __('job.create-job.1') }}</strong>
                    {{ __('job.create-job.2') }}

                    {{ __('job.create-job.4') }}
                    </p>
                    <div class='flex flex-col gap-2 mt-5'>
                        <livewire:company-access.request-button />
                        <x-button href="{{ route('dashboard') }}" outlined red outline
                            icon='arrow-left'>{{ __('show-notes.show-notes-2') }}</x-button>
                    </div>
                </div>
            </x-modal>
        @endif

        @if ($showPaymentModal)
            <x-modal wire:model="showPaymentModal" class="" title="PAYMENT MODAL">
                <div class='flex flex-col h-auto gap-2 p-12 bg-gray-900 dark:text-gray-300 w-96 rounded-xl '>
                    <p class='mb-4 sm:text-base'>You have no coins left. In order to publish more advertisements, you
                        need to buy more coins</p>
                    <x-button outlined icon='arrow-left'
                        wire:click="closePaymentModal">{{ __('show-notes.show-notes-2') }}</x-button>
                    <x-button href="{{ route('notes.payment.payment-index') }}" green icon='shopping-cart'>Buy
                        coins</x-button>
                </div>
            </x-modal>
        @endif
    </div>

    <x-card title="{{ __('job.post-job.1') }}">
        <x-wui-errors class="mb-4" />
        <div class="flex flex-col gap-6">
            <x-wui-input label="{{ __('job.post-job.2') }}" placeholder="Company ABC Kft"
                wire:model.defer="companyAuthor" />

            <p class='font-semibold'>{{ __('job.post-job.3') }}</p>
            <x-wui-input label="{{ __('job.post-job.4') }}" placeholder="Software Engineer Part Time"
                wire:model.defer="companyTitle" />
            <div class="col-span-1 sm:col-span-2">
                <x-wui-textarea label="{{ __('job.post-job.5') }}"
                    placeholder="We are hiring for a accounts payable intern at the Budapest office this summer, your roles will be ... you are expected to..."
                    wire:model.defer="companyDescription" />
            </div>
            <div class='col-span-1'> <x-wui-input label="{{ __('job.post-job.6') }}"
                    placeholder="https://example.com/apply" wire:model.defer="companyLink" />
            </div>
              <div class='col-span-1'> <x-wui-input label="{{ __('If you dont have a application link to provide, you can specify an email here.') }}"
                    placeholder="azenvallalkozasom@gmail.com" wire:model.defer="companyEmail" /></div>
            <div class="col-span-1 sm:col-span-2 sm:grid sm:grid-cols-7 sm:gap-5">
                <div class="col-span-1 sm:col-span-4">
                    <label>
                        {{ __('job.post-job.7') }}</label>
                    <input class='w-full text-gray-400' label="Upload a photo of yourself" type='file' type="file"
                        id="Profile Pic" wire:model="companyImage" />

                </div>
            </div>
        </div>

        <x-slot name="footer">
            <div class="flex items-center justify-end gap-x-3">
                <x-button wire:click="openModal" label="{{ __('job.post-job.8') }}" spinner primary />
            </div>
        </x-slot>
    </x-card>
</div>
