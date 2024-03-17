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
        $this->closeModal();
        $this->dialog()->show([
            'icon' => 'success',
            'title' => 'Post successfully deleted!',
        ]);
    }

    public function with(): array
    {
        return [
            'jobs' => Post::all(),
        ];
    }

    public function placeholder()
    {
        return <<<'HTML'
                <div role="status">
            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
        HTML;
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
                <p class="text-xl font-bold "> {{__('job.show-job.1')}} </p>
                <x-button rounded sm class='w-full h-12 mt-4 sm:w-56' href="{{ route('notes.post-create') }}" primary spinner
                    right-icon="shopping-cart">{{__('job.show-job.2')}}</x-button>
            </div>
        @else
            @foreach ($jobs as $job)
                <div class='flex flex-col gap-4'>
                    <x-card title='{{ $job->title }}'
                        class='relative flex flex-col justify-between w-full dark:text-gray-300 dark:bg-gray-800 '
                        wire:key='{{ $job->id }}'>
                        <x-slot name="action">
                            <x-avatar size="w-20 h-20 " class='border-none' rounded src="{{ asset('storage/' . $job->image) }}" />
                        </x-slot>
                        <div class='flex justify-start mb-3'>

                        </div>



                        <x-slot name="footer">
                            <div class='flex flex-col items-center justify-between w-full gap-4 sm:flex-row'>
                                @if ($job->apply_link)
                                    <a class="w-full" href="{{ $job->apply_link }}" target='_blank'>
                                        <x-button label="Apply" right-icon="paper-airplane" class='w-full sm:w-3/4'
                                            primary />
                                    </a>
                                @endif

                                @if ($job->apply_email)
                                    <a class="inline-block w-full text-xs cursor-pointer dark:text-gray-300"
                                        href="{{ 'mailto:' . $job->apply_email }}"> To apply, send an email to
                                        <p
                                            class='inline-block text-xs text-indigo-500 hover:border-b hover:border-b-indigo-500'>
                                            {{ $job->apply_email }}
                                        </p>
                                    </a>
                                @endif


                                <div class='flex items-center justify-center gap-2'>
                                    @can('update', $job)
                                        <x-button.circle outline green icon="pencil-alt"
                                            href="{{ route('notes.edit-post', $job) }}" wire:navigate />
                                    @else
                                        <p></p>
                                    @endcan

                                    @can('delete', $job)
                                        <x-button.circle icon="trash" flat negative outline
                                            wire:click="openModal('{{ $job->id }}')"></x-button.circle>
                                    </div>
                                @else
                                    <p></p>
                                @endcan
                            </div>
                        </x-slot>
                        <div class='flex flex-col w-full'>
                            <div class='flex items-center w-full gap-2'>
                                <p class='mb-5 text-sm break-words '> {{ $job->author }}</p>
                                <p class='mb-5 text-sm text-gray-500 break-words '> posted on
                                    {{ $job->created_at->format('Y-m-d') }}
                                </p>
                            </div>
                            <p class='w-full text-sm break-words sm:text-sm'>{!! nl2br(e($job->description)) !!} </p>
                        </div>

                        <div class='flex flex-col items-center justify-center gap-2 mt-5 mb-2 sm:flex-row lg:gap-4'>
                            @if ($job->payment === 'No payment')
                                <div
                                    class='flex flex-col items-center w-full px-2 py-3 text-xs border border-gray-200 rounded-md dark:border-gray-600 sm:w-40'>
                                    <div class='mb-1'>
                                        <x-badge class='w-6 h-6' icon="x-circle" />
                                    </div>
                                    <h1 class='font-thin text-gray-400 dark:text-gray-500'> {{__('job.show-job.3')}}<h1>
                                            <br />

                                </div>
                            @elseif ($job->payment === 'Payment included')
                                <div
                                    class='flex flex-col items-center w-full px-2 py-3 text-xs border border-gray-200 rounded-md dark:border-gray-600 sm:w-40'>
                                    <div class='mb-1'>
                                        <x-badge class='w-6 h-6' icon="check" />
                                    </div>
                                    <h1 class='font-thin text-gray-400 dark:text-gray-500'> {{__('job.show-job.3')}} <h1>
                                            <br />
                                </div>
                            @else
                                <div
                                    class='flex flex-col items-center w-full px-2 py-3 text-xs border border-gray-200 rounded-md dark:border-gray-600 sm:w-40'>
                                    <div class='mb-1'>
                                        <x-badge class='w-6 h-6' icon="check" />
                                    </div>
                                    <h1 class='font-thin text-gray-400 dark:text-gray-500'> {{__('job.show-job.3')}} <h1>
                                            <p class='font-bold '> {{ $job->payment }} </p>
                                </div>
                            @endif

                            <div
                                class='flex flex-col items-center w-full px-2 py-3 text-xs border border-gray-200 rounded-md dark:border-gray-600 sm:w-40'>
                                <div class='mb-1'>
                                    <x-badge class='w-6 h-6' icon="clock" />
                                </div>
                                <h1 class='font-thin text-gray-400 dark:text-gray-500'> {{__('job.show-job.4')}} <h1>
                                        <p class='font-bold '> {{ $job->hours }} Hours / week </p>
                            </div>
                            <div
                                class='flex flex-col items-center w-full px-2 py-3 text-xs border border-gray-200 rounded-md dark:border-gray-600 sm:w-40'>
                                <div class='mb-1'>
                                    <x-badge class='w-6 h-6' icon="home" />
                                </div>
                                <h1 class='font-thin text-gray-400 dark:text-gray-500'> {{__('job.show-job.5')}} <h1>
                                        <p class='font-bold '> {{ $job->modality }} </p>
                            </div>

                        </div>

                    </x-card>
                </div>

                <div>
                    @if ($showModal)
                        <x-modal wire:model="showModal" title="Simple Modal">
                            <div
                                class='flex flex-col h-auto gap-2 p-6 bg-gray-100 sm:p-12 dark:bg-gray-900 dark:text-gray-300 w-96 rounded-xl '>
                                <p class='mb-4 sm:text-base'>{{ __('job.delete-job.1') }}</p>
                                <x-button outline icon='arrow-left'
                                    wire:click="closeModal">{{ __('job.delete-job.2') }}</x-button>
                                <x-button light negative icon='trash'
                                    wire:click="delete('{{ $postToDelete->id }}')">{{ __('job.delete-job.3') }}</x-button>
                            </div>
                        </x-modal>
                    @endif
                </div>
            @endforeach
    </div>
    @endif
</div>
