<?php

use Livewire\Volt\Component;
use App\Models\Post;

new class extends Component {
    public function delete($postId)
    {
        $post = Post::where('id', $postId)->first();
        $this->authorize('delete', $post);
        $post->delete();
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
    <div class='flex flex-col gap-6 custom-shadow '>
        @foreach ($jobs as $job)
            <x-card title='{{ $job->title }}'
                class='relative flex flex-col justify-between w-full dark:text-gray-300 dark:bg-gray-800 hover:bg-gray-600 '
                wire:key='{{ $job->id }}'>
                <div class='flex justify-start '>
                    <div class='w-full sm:w-80'>
                        <div class='mb-8 w-50 h-50'>
                            <img class='object-cover w-full h-full rounded-md sm:max-h-56'
                                src="{{ asset('storage/' . $job->image) }}" />
                        </div>
                    </div>
                </div>
                <x-slot name="footer">
                    <div class='flex items-center justify-between w-full'>
                        <a class="w-full" href="{{ $job->apply_link }}" target='_blank'>
                            <x-button label="Apply" class='w-full lg:w-1/4' primary />
                        </a>
                        <x-button icon="trash" flat negative wire:click="delete('{{ $job->id }}')"
                            label='Delete' />
                    </div>
                </x-slot>
                <div class='flex flex-col w-full'>

                    <div class='flex items-center w-full gap-2'>
                        <p class='mb-5 break-words md:text-base '> {{ $job->author }}</p>
                        <p class='mb-5 text-gray-500 break-words '> two hours ago</p>
                    </div>
                    <p class='w-full break-words'> {{ $job->description }} </p>
                </div>

            </x-card>
        @endforeach
    </div>
</div>

{{-- {{ $job->title }} {{ $job->author }} src="{{ asset('storage/' . $job->image) }} {{ $job->description }}" --}}
