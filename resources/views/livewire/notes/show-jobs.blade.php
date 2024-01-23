<?php

use Livewire\Volt\Component;
use App\Models\Post;

new class extends Component {
    public function with(): array
    {
        return [
            'jobs' => Post::all(),
        ];
    }
}; ?>

<div>
    <div class=' flex flex-col gap-6'>
        @foreach ($jobs as $job)
            <div class='relative flex flex-col dark:text-gray-300 w-full justify-between bg-white border border-gray-700 w-full dark:bg-gray-800 hover:bg-gray-600 custom-shadow rounded-xl '
                wire:key='{{ $job->id }}'>
                <div>
                    <div class='flex gap-2'>
                        <div>
                             <div class='w-80 h-80'>
                                <div class='flex justify-center items-center w-full w-full h-full p-3'>
                                    <img src="{{ asset('storage/' . $job->image) }}" alt="profile pic" title="bruuvynsons"
                                        class='object-cover w-full h-full img rounded-xl' />
                                </div>
                            </div>
                        </div>
                        <div class='flex flex-col text-start items-start justify-start p-4'>
                            <div class='lg:flex flex-row justify-center items-center gap-3'>
                                <p class='text-sm'> {{ $job->author }}</p>
                                <p class='text-slate-500 text-sm'> 3 hours go was published</p>
                            </div>
                            <div class='lg:flex flex-row justify-center items-center gap-3 mb-3'>
                                <h1 class='lg:text-2xl font-bold'>{{ $job->title }}</h1>
                            </div>
                            <div class='lg:flex flex-row justify-center items-center gap-3'>
                                <h1>{{ $job->description }}</h1>
                            </div>
                            <div class='lg:flex flex-row justify-center items-center gap-3'>
                                <h1>link</h1>
                            </div>
                            <div class='lg:flex flex-row justify-start items-start w-full gap-3 mt-6'>
                                <x-button class='lg:w-80' primary label='Apply' />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
