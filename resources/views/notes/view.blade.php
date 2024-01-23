<x-guest-layout>
    <div class='pt-5 px-4  flex flex-col justify-center items-center'>
        <header class='flex items-center w-full justify-between'>
            <div class='mt-6'>
                <x-button icon="arrow-left" class="mb-8" href="{{ route('dashboard') }}">Back</x-button>
            </div>
            <div class='flex justify-center'>
                <a wire:click='goToIndex'>
                    <div class='flex items-center justify-center w-40 opacity-80 h-auto mt-2'>
                        <img class='object-cover w-full h-full rounded-md' src="{{ asset('logo.png') }}" alt="sheesh"
                            title="sheesh" />
                    </div>
                </a>
            </div>
        </header>
        <main class='flex md:flex-row flex-col justify-center gap-6 pt-12 pb-32'>
            <div
                class='dark:text-gray-300 flex gap-4 md:max-w-96  w-full rounded-2xl items-start flex-col dark:bg-gray-950'>
                <div class='px-6 w-full sm:w-3/4 md:w-full pb-6'>

                    <div class='flex flex-col gap-2 mb-4'>
                       <div class='flex justify-center items-center'>
                             <div class='sm:w-80 h-full sm:h-80 w-full'>
                                <div class='flex justify-center items-center w-full h-full p-2 py-8'>
                                    <img src="{{ asset('storage/' . $note->photo) }}" alt="profile pic" title="bruuvynsons"
                                        class='object-cover w-full h-full img rounded-xl' />
                                </div>
                            </div>
                        </div>
                        <h1 class='md:text-3xl text-2xl'>{{ $note->name }}</h1>
                        <p class='md:text-lg text-base'>{{ $note->area }}</p>
                    </div>
                    <div class='flex lg:flex-row flex-col lg:items-center lg:justify-items-start w-full gap-2'>
                        <x-button href="{{ $note->linkedin }}" target="_blank" outline primary
                            icon="link">Linkedin</x-button.circle>
                            <x-button download="Download-CV" href="{{ asset('storage/' . $note->cv) }}" primary
                                icon="document">CV</x-button>
                    </div>

                </div>
            </div>
            <div class='dark:text-gray-300 flex flex-col rounded-2xl dark:bg-gray-950 w-full md:w-8/12'>
                <div class='flex flex-col items-start gap-4 p-6 '>
                    <div>
                        <a class='flex items-center 2xl:text-3xl  gap-3 justify-center lg:text-xl text-base'
                            href='#'>
                            <x-button icon="mail" href="{{('mailto:'.$note->email) }}" /> Contact me
                        </a>
                    </div>
                    <div class='lg:text-xl 2xl:text-3xl text-base'><strong>My degree:</strong> Economics and Business
                    </div>
                    <div class='lg:text-xl 2xl:text-3xl  text-base'><strong>About me:</strong> Economics and
                        BusinessEconomics and
                        BusinessEconomics and BusinessEconomics and BusinessEconomics and BusinessEconomics and
                        BusinessEconomics and BusinessEconomics and BusinessEconomics and BusinessEconomics and
                        BusinessEconomics and BusinessEconomics and BusinessEconomics and BusinessEconomics and
                        BusinessEconomics and BusinessEconomics and BusinessEconomics and Business</div>
                </div>

            </div>
        </main>
    </div>
</x-guest-layout>


{{-- <h3 class="mr-2 text-sm">Sent from {{ $user->name }}</h3> --}}
{{-- <livewire:heartreact :note="$note" /> --}}
