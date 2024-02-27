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

    public function mount(Post $post)
    {
        $this->authorize('update', $post);
        $this->fill($post);
        $this->companyAuthor = $post->author;
        $this->companyTitle = $post->title;
        $this->companyDescription = $post->description;
        $this->companyLink = $post->apply_link;
        $this->companyEmail = $post->apply_email;
    }

    public function savePost()
    {
        $validated = $this->validate([
            'companyAuthor' => ['string', 'min:2'],
            'companyTitle' => ['string', 'min:2'],
            'companyDescription' => ['string', 'min:5'],
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
        ]);

        $this->dialog()->show([
            'icon' => 'success',
            'title' => 'Post saved!',
        ]);
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

            <p class='pb-2 font-medium border-b border-gray-300 dark:border-none'>{{ __('job.post-job.3') }}</p>
            <x-wui-input icon='tag' label="{{ __('job.post-job.4') }}" placeholder="Software Engineer Part Time"
                wire:model.defer="companyTitle" />
            <div class="col-span-1 sm:col-span-2">
                <x-wui-textarea label="{{ __('job.post-job.5') }}"
                    placeholder="We are hiring for a accounts payable intern at the Budapest office this summer, your roles will be ... you are expected to..."
                    wire:model.defer="companyDescription" />
            </div>
            <div class='col-span-1'> <x-wui-input label="{{ __('job.post-job.6') }}" icon='link'
                    placeholder="https://example.com/apply" wire:model.defer="companyLink" />
            </div>
            <div class='col-span-1'> <x-wui-input label=" {{ __('job.post-job.6.1') }}" icon='mail'
                    placeholder="azenvallalkozasom@gmail.com" wire:model.defer="companyEmail" />
            </div>
            <div class='col-span-1'>
                <x-wui-input icon='camera' class='w-full text-gray-400' label="{{ __('job.post-job.7') }}"
                    type='file' type="file" id="Profile Pic" wire:model="companyImage" />
            </div>

        </div>

        <x-slot name="footer">
            <div class="flex items-center justify-end gap-x-3">

                <x-button icon='bookmark' wire:click="savePost" label="{{ __('job.post-job.8.1') }}" spinner="save"
                    primary />

            </div>
        </x-slot>
    </x-card>
</div>
