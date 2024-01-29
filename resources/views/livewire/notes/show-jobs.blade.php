<?php

use Livewire\Volt\Component;
use App\Models\Post;
use WireUi\Traits\Actions;

new class extends Component {
    use Actions;
    
    public $postToDelete;

    public $showModal = false;

    public function openModal($postId)
    {
        $this->postToDelete = Post::find($postId);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function delete($postId)
    {
        $post = Post::where('id', $postId)->first();
        $this->authorize('delete', $post);
        $post->delete();
       

         $this->notification()->error(
            $title = 'Post deleted',
            $description = 'Your post was deleted'
        ); 
    }

    public function with(): array
    {
        return [
            'jobs' => Post::all(),
        ];
    }
}; ?>



<div>




    <style>
        .custom-shadow {
            box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
        }

        .custom-shadow:hover {
            box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;

        }

        @media (max-width: 1060px) {

            .responsive {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 700px) {
            .responsive {
                grid-template-columns: repeat(1, minmax(0, 1fr));
            }
        }
    </style>
    <div class='flex flex-col gap-6'>


        @if ($jobs->isEmpty())
            <div class="text-center dark:text-gray-300">
                <p class="text-xl font-bold ">No jobs posted yet</p>
                <x-button class='mt-4' href="{{ route('notes.post-create') }}" primary icon="shopping-cart">Create a job
                    advertisement</x-button>
            </div>
        @else
            @foreach ($jobs as $job)
                <div class='shadow-2xl shadow-black'>
                    <x-card title='{{ $job->title }}'
                        class='relative flex flex-col justify-between w-full dark:text-gray-300 dark:bg-gray-800 hover:bg-gray-600 '
                        wire:key='{{ $job->id }}'>
                        <div class='flex justify-start '>
                            <div class='w-full sm:w-80'>
                                <div class='mb-8 w-50 h-50'>
                                    <img class='object-cover w-full h-full rounded-md max-h-80 sm:max-h-56'
                                        src="{{ asset('storage/' . $job->image) }}" />
                                </div>
                            </div>
                        </div>
                        <x-slot name="footer">
                            <div class='flex items-center justify-between w-full gap-4'>
                                <a class="w-full" href="{{ $job->apply_link }}" target='_blank'>
                                    <x-button label="Apply" class='w-full sm:w-3/4 lg:w-1/4' primary />
                                </a>
                                @can('delete', $job)
                                    <div class='flex items-center justify-center gap-2'>
                                        {{--  href="{{ route('notes.edit', $note) }}" --}}
                                        <x-button.circle icon="pencil-alt" href="{{ route('notes.edit-post', $job) }}"
                                            wire:navigate />
                                        <x-button.circle icon="trash" flat negative outline
                                            wire:click="openModal('{{ $job->id }}')"></x-button.circle>
                                    </div>
                                @else
                                    <p>

                                    </p>
                                @endcan

                            </div>
                        </x-slot>
                        <div class='flex flex-col w-full'>

                            <div class='flex items-center w-full gap-2'>
                                <p class='mb-5 break-words md:text-base '> {{ $job->author }}</p>
                                <p class='mb-5 text-gray-500 break-words '> posted on
                                    {{ $job->created_at->format('Y-m-d') }}
                                </p>
                            </div>
                            <p class='w-full text-sm break-words sm:text-base'> {{ $job->description }} </p>
                        </div>

                    </x-card>
                </div>


                <div>


                    @if ($showModal)
                        <x-modal wire:model="showModal" class="" title="Simple Modal">
                            <div
                                class='flex flex-col h-auto gap-2 p-12 bg-gray-900 dark:text-gray-300 w-96 rounded-xl '>
                                <p class='mb-4 sm:text-base'>Are you sure that you want to delete the post? After
                                    deleting,
                                    you will not be able to recover your coins.</p>
                                <x-button primary icon='arrow-left' wire:click="closeModal">Back</x-button>
                                <x-button flat negative outline icon='trash'
                                    wire:click="delete('{{ $postToDelete->id }}')">Delete</x-button>
                            </div>
                        </x-modal>
                    @endif
                </div>
            @endforeach
    </div>
    @endif
</div>

{{-- {{ $job->title }} {{ $job->author }} src="{{ asset('storage/' . $job->image) }} {{ $job->description }}" --}}
