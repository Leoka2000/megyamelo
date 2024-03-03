<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Post;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

new #[Layout('layouts.app')] class extends Component {
    use WithFileUploads;
    use Actions;
    public Post $post;
    public $companyAuthor;
    public $companyTitle;
    public $companyDescription;
    public $companyImage;
    public $companyLink;
    public $companyEmail;

    public $companyModality;
    public $companyPayment;
    public $companyContactEmail;
    public $companyAccept;
    public $companyHours;

    public function mount(Post $post)
    {
        $this->authorize('update', $post);
        $this->fill($post);
        $this->companyAuthor = $post->author;
        $this->companyTitle = $post->title;
        $this->companyDescription = $post->description;
        $this->companyLink = $post->apply_link;
        $this->companyEmail = $post->apply_email;

        $this->companyContactEmail = $post->contact_email;
        $this->companyModality = $post->modality;
        $this->companyPayment = $post->payment;

        $this->companyHours = $post->hours;
    }

    public function savePost()
    {
        $validated = $this->validate([
            'companyAuthor' => ['string', 'min:2'],
            'companyTitle' => ['string', 'min:2'],
            'companyDescription' => ['string', 'min:5'],

            'companyModality' => ['required', 'string'],
            'companyPayment' => ['required', 'string'],
            'companyContactEmail' => ['required', 'email'],

            'companyHours' => ['required', 'numeric'],
        ]);

        // Validate
        // Validate
        // Validate

        if ($this->companyImage) {
            $validated = $this->validate([
                'companyImage' => 'file|mimes:png,jpg,pdf|max:102400',
            ]);
        }
        if ($this->companyLink) {
            $validated = $this->validate([
                'companyLink' => ['url'],
            ]);
        }
        if ($this->companyEmail) {
            $validated = $this->validate([
                'companyEmail' => ['required', 'email'],
            ]);
        }
        // UPDATE
        // UPDATE
        // UPDATE

        if ($this->companyImage) {
            $this->post->update([
                'image' => $this->companyImage->store('company', 'public'),
            ]);
        }

        $this->post->update([
            'author' => $this->companyAuthor,
            'title' => $this->companyTitle,
            'description' => $this->companyDescription,
            'apply_link' => $this->companyLink,
            'apply_email' => $this->companyEmail,

            'modality' => $this->companyModality,
            'payment' => $this->companyPayment,
            'contact_email' => $this->companyContactEmail,
            'hours' => $this->companyHours,
        ]);

        $this->dialog()->show([
            'icon' => 'success',
            'title' => 'Post saved!',
        ]);
    }

    public function modalities()
    {
        return ['Remote', 'On-site', 'Hybrid'];
    }

    public function payment()
    {
        return ['No payment', 'Payment included', 'Less than 1,850Ft / Hour', '1900Ft - 2100Ft / Hour', '2100Ft - 2300Ft / Hour', '2300Ft - 2500Ft / Hour', '2500Ft - 2700Ft / Hour', 'More than 2700Ft / Hour'];
    }
}; ?>

<div class='px-4 py-24 md:px-44 xl:px-96'>
    <x-slot name="header">
        <h2 class="text-base font-semibold leading-tight text-gray-800 sm:text-xl dark:text-gray-200">
            {{ __('job.post-job.8.1') }}
        </h2>
    </x-slot>

    <x-button wire:navigate icon="arrow-left" class="mb-8"
        href="{{ route('notes.jobs') }}">{{ __('job.delete-job.2') }}</x-button>
    <x-card title="{{ __('job.post-edit.1') }}">
        <x-wui-errors class="mb-4" />

        <div class="flex flex-col gap-6">
            <x-wui-input icon='user' label="{{ __('job.post-job.2') }}" placeholder="Company ABC Kft"
                wire:model.defer="companyAuthor" />

            <x-wui-input label="{{ __('job.post-job.new-post-job.1') }}" icon='mail' placeholder="példa@gmail.com"
                wire:model.defer="companyContactEmail" />


            <x-wui-input class='h-52' right-icon="plus"  icon='camera' class='w-full text-gray-400' label="{{ __('job.post-job.7') }}"
                type='file' type="file" id="Profile Pic" wire:model="companyImage" />


            <p class='pb-2 font-medium border-b border-gray-300 dark:border-none'>{{ __('job.post-job.3') }}</p>
            <x-wui-input icon='tag' label="{{ __('job.post-job.4') }}" placeholder="Software Engineer Part Time"
                wire:model.defer="companyTitle" />
            <div class="col-span-1 sm:col-span-2">
                <x-wui-textarea label="{{ __('job.post-job.5') }}"
                    placeholder="We are hiring for a accounts payable intern at the Budapest office this summer, your roles will be ... you are expected to..."
                    wire:model.defer="companyDescription" />
            </div>
            <div class='col-span-1'>
                <x-wui-select icon='identification' class='z-20' placeholder="Remote"
                    label="{{ __('job.post-job.new-post-job.2') }}" wire:model.defer="companyModality"
                    :options="$this->modalities()" />
            </div>

            <div class='col-span-1'> <x-wui-input label="{{ __('job.post-job.new-post-job.3') }}" icon='clock'
                    placeholder="25" wire:model.defer="companyHours" /></div>

            <x-wui-select icon='currency-dollar' class='z-20' placeholder="Payment Included"
                label="{{ __('job.post-job.new-post-job.4') }}" wire:model.defer="companyPayment" :options="$this->payment()" />

            <div class='col-span-1'> <x-wui-input label="{{ __('job.post-job.6') }}" icon='link'
                    placeholder="https://example.com/apply" wire:model.defer="companyLink" />
            </div>
            <div class='col-span-1'> <x-wui-input label=" {{ __('job.post-job.6.1') }}" icon='mail'
                    placeholder="azenvallalkozasom@gmail.com" wire:model.defer="companyEmail" />
            </div>




        </div>

        <x-slot name="footer">
            <div class="flex items-center justify-end gap-x-3">

                <x-button icon='bookmark' rounded wire:click="savePost" class='w-full h-12 sm:w-48' label="{{ __('job.post-job.8.1') }}" spinner="save"
                    primary />

            </div>
        </x-slot>
    </x-card>
</div>
