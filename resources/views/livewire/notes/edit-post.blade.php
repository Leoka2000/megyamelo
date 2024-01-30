<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Post;
use Livewire\WithFileUploads;

new #[Layout('layouts.app')] class extends Component {
    use WithFileUploads;
    public Post $post;
    public $companyAuthor;
    public $companyTitle;
    public $companyDescription;
    public $companyImage;
    public $companyLink;

    public function mount(Post $post)
    {
        $this->authorize('update', $post);
        $this->fill($post);
        $this->companyAuthor = $post->author;
        $this->companyTitle = $post->title;
        $this->companyDescription = $post->description;
        $this->companyLink = $post->apply_link;
    }

    public function savePost()
    {
        $validated = $this->validate([
            'companyAuthor' => ['string', 'min:2'],
            'companyTitle' => ['string', 'min:2'],
            'companyDescription' => ['string', 'min:5'],
            'companyLink' => ['string', 'min:5'],
        ]);

        if ($this->companyImage) {
            $validated = $this->validate([
                'companyImage' => 'file|mimes:png,jpg,pdf|max:102400',
            ]);
        }

        if ($this->companyImage) {
            // If a new image is uploaded, update the image
            $this->post->update([
                'image' => $this->companyImage->store('company', 'public'),
            ]);
        }

        $this->post->update([
            'author' => $this->companyAuthor,
            'title' => $this->companyTitle,
            'description' => $this->companyDescription,
            'apply_link' => $this->companyLink,
        ]);

        $this->dispatch('post-saved');
    }
}; ?>

<div class='py-24 px-96'>
      <x-button wire:navigate icon="arrow-left" class="mb-8" href="{{ route('notes.jobs') }}">Back</x-button>
    <x-card title="Edit your job advertisement">
        <x-wui-errors class="mb-4" />

        <div class="flex flex-col gap-6">
            <x-wui-input label="Your company's name" placeholder="Company ABC Kft" wire:model.defer="companyAuthor" />

            <p class='font-semibold'>Details of your post</p>
            <x-wui-input label="Title" placeholder="Software Engineer Part Time" wire:model.defer="companyTitle" />
            <div class="col-span-1 sm:col-span-2">
                <x-wui-textarea label="Description of your advertisement"
                    placeholder="We are hiring for a accounts payable intern at the Budapest office this summer, your roles will be ... you are expected to..."
                    wire:model.defer="companyDescription" />
            </div>
            <div class='col-span-1'> <x-wui-input label="Link to apply" placeholder="https://example.com/apply"
                    wire:model.defer="companyLink" /></div>
            <div class="col-span-1 sm:col-span-2 sm:grid sm:grid-cols-7 sm:gap-5">
                <div class="col-span-1 sm:col-span-4">
                    <label>
                        You can include a photo in your post</label>
                    <input class='w-full text-gray-400' label="Upload a photo of yourself" type='file' type="file"
                        id="Profile Pic" wire:model="companyImage" />

                </div>

            </div>
        </div>

        <x-slot name="footer">
            <div class="flex items-center justify-end gap-x-3">
                <x-button wire:click="savePost" label="Post" spinner="save" primary />
                <x-action-message on="post-saved" />
            </div>
        </x-slot>
    </x-card>
</div>
