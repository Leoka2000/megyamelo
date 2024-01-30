<x-guest-layout>
    <div class='flex flex-col items-center justify-center px-4 pt-5'>
        <header class='flex items-center justify-between w-full'>
            <div class='mt-6'>
                <x-button icon="arrow-left" class="mb-8" href="{{ route('notes.index') }}">Back</x-button>
            </div>
            <div class='flex justify-center'>
                <a>
                    <div class='flex items-center justify-center w-40 h-auto mt-2 opacity-80'>
                        <img class='object-cover w-full h-full rounded-md' src="{{ asset('logo.png') }}" alt="sheesh"
                            title="sheesh" />
                    </div>
                </a>
            </div>
        </header>
        <main class='flex flex-col justify-center gap-6 pt-12 pb-32 md:flex-row'>
            <div
                class='flex flex-col items-start w-full gap-4 dark:text-gray-300 md:max-w-96 rounded-2xl dark:bg-gray-950'>
                <div class='w-full px-6 pb-6 sm:w-3/4 md:w-full'>

                    <div class='flex flex-col gap-2 mb-4'>
                        <div class='flex items-center justify-center'>
                            <div class='w-full h-full sm:w-80 sm:h-80'>
                                <div class='flex items-center justify-center w-full h-full p-2 py-8'>
                                    <img src="{{ asset('storage/' . $note->photo) }}" alt="profile pic"
                                        title="bruuvynsons" class='object-cover w-full h-full img rounded-xl' />
                                </div>
                            </div>
                        </div>
                        <h1 class='text-2xl md:text-3xl'>{{ $note->name }}</h1>
                        <p class='text-base md:text-lg'>{{ $note->area }}</p>
                    </div>
                    <div class='flex flex-col w-full gap-2 lg:flex-row lg:items-center lg:justify-items-start'>
                        @if ($note->linkedin)
                            <x-button href="{{ $note->linkedin }}" target="_blank" outline primary
                                icon="link">Linkedin</x-button>
                        @endif
                        @if ($note->cv === 'default_value')
                            <p></p>
                        @else
                            <x-button download="Download-CV" href="{{ asset('storage/' . $note->cv) }}" primary
                                icon="document">CV</x-button>
                        @endif
                    </div>

                </div>
            </div>
            <div class='flex flex-col w-full dark:text-gray-300 rounded-2xl dark:bg-gray-950 md:w-8/12'>
                <div class='flex flex-col items-start gap-4 p-6 '>
                    <div>
                        <a class='flex items-center justify-center gap-3 text-base 2xl:text-3xl lg:text-xl'
                            href='#'>
                            <x-button icon="mail" href="{{ 'mailto:' . $note->email }}" /> Contact me
                        </a>
                    </div>
                    <div class='text-base lg:text-xl 2xl:text-3xl'><strong>My degree:</strong> Economics and Business
                    </div>
                    <div class='text-base lg:text-xl 2xl:text-3xl'><strong>About me:</strong> Economics and
                        BusinessEconomics and
                        BusinessEconomics and BusinessEconomics and BusinessEconomics and BusinessEconomics and
                        BusinessEconomics and BusinessEconomics and BusinessEconomics and BusinessEconomics and
                        BusinessEconomics and BusinessEconomics and BusinessEconomics and BusinessEconomics and
                        BusinessEconomics and BusinessEconomics and BusinessEconomics and Business
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
</x-guest-layout>


{{-- <h3 class="mr-2 text-sm">Sent from {{ $user->name }}</h3> --}}
{{-- <livewire:heartreact :note="$note" /> --}}
