<x-app-layout>
    <x-slot name="header">
        <h2 class="text-base font-semibold leading-tight text-gray-800 sm:text-xl dark:text-gray-200">
            {{ $note->name }}
        </h2>
    </x-slot>
    <div class='flex flex-col items-center justify-center px-4 pt-10'>
        <div class="flex justify-start w-full">
             <x-button icon="arrow-left" class="mt-12" href="{{ route('dashboard') }}">
                {{ __('create-note.create-1') }}</x-button>
        </div>
        <main class='flex flex-col justify-center gap-6 pt-12 pb-32 md:flex-row'>
       
            <div
                class='flex flex-col items-start w-full gap-4 bg-white shadow-md dark:shadow-lg dark:text-gray-300 md:max-w-96 rounded-2xl dark:bg-gray-900'>
                <div class='w-full px-6 pb-6 sm:w-3/4 md:w-full'>
                    <div class='flex flex-col gap-2 mb-4'>
                        <div class='flex items-center justify-center'>
                            <div class='w-full h-full sm:w-80 sm:h-80'>
                                <div class='flex items-center justify-center w-full h-full p-2 py-8'>
                                    <img src="{{ asset('storage/' . $note->photo) }}" alt="profile pic"
                                        title="profile pic" class='object-cover w-full h-full img rounded-xl' />
                                </div>
                            </div>
                        </div>
                        <h1 class='text-2xl md:text-3xl'>{{ $note->name }}</h1>
                        <p class='text-base md:text-lg'>{{ $note->area }}</p>
                    </div>
                    <div class='flex flex-col w-full gap-2 lg:flex-row lg:items-center lg:justify-items-start'>
                        @if ($note->linkedin)
                            <x-button href="{{ $note->linkedin }}" target="_blank" outline primary
                                icon="link">LinkedIn</x-button>
                        @endif
                        @if ($note->cv === 'default_value')
                            <p></p>
                        @else
                            <x-button download="CV {{ $note->name }}" href="{{ asset('storage/' . $note->cv) }}"
                                primary icon="document">{{ __('show-notes.show-notes-7.1') }}</x-button>
                        @endif
                    </div>

                </div>
            </div>
            <div
                class='flex flex-col w-full bg-white shadow-md dark:text-gray-300 dark:shadow-lg rounded-2xl dark:bg-gray-900 md:w-8/12'>
                <div class='flex flex-col items-start gap-4 p-6 '>
                    <div>
                        <a class='flex flex-row items-center justify-center gap-3 text-base 2xl:text-3xl lg:text-xl'
                            href="{{ 'mailto:' . $note->email }}">
                            <x-button icon="mail" />
                            <p class='text-base'>{{ __('show-notes.show-notes-7.4') }}</p>
                        </a>
                    </div>
                    <div class='text-base lg:text-xl 2xl:text-3xl'>
                        <strong>{{ __('show-notes.show-notes-7.2') }}</strong> {{ $note->degree }}
                    </div>
                    <div class='text-base lg:text-xl 2xl:text-3xl'>
                        <strong>{{ __('show-notes.show-notes-7.3') }}</strong> {{ $note->description }}
                    </div>
                    @if ($note->other_links)
                        <div class='w-full text-base lg:text-xl 2xl:text-3xl'>
                            <x-button href="{{ $note->other_links }}" target="_blank" outline primary
                                icon="link">Portfolio</x-button>
                        </div>
                    @endif
                </div>


            </div>
        </main>
    </div>
</x-app-layout>


{{-- <h3 class="mr-2 text-sm">Sent from {{ $user->name }}</h3> --}}
{{-- <livewire:heartreact :note="$note" /> --}}
