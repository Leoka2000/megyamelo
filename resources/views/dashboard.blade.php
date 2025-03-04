<x-app-layout >
    <x-slot name="header">
        <h2 class="text-base font-semibold leading-tight text-gray-800 sm:text-xl dark:text-gray-200">
            {{ __('create-note.create-02') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success">
            <x-modal wire:model="showModal" class="" title="Simple Modal">
                <div
                    class='flex flex-col h-auto gap-2 p-12 bg-white dark:bg-gray-900 dark:text-gray-300 w-96 rounded-md '>
                    <x-badge positive class='h-10 mb-2' lg icon="check" />
                    <p class='mb-1 font-bold sm:text-base'>Message sent!</p>
                    <p class='sm:text-base'>We will reply soon with instructions on partnering with us</p>
                </div>
            </x-modal>
        </div>
    @endif

    <div class="py-20 sm:py-12 relative overflow-hidden isolate" >
    <div class="hidden sm:absolute sm:-top-10 sm:right-1/2 sm:-z-10 sm:mr-10 sm:block sm:transform-gpu sm:blur-3xl" aria-hidden="true">
                    <div class="aspect-[1097/845] w-[68.5625rem] bg-gradient-to-tr from-[#ff4694] to-[#776fff] opacity-20" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
                </div>
                <div class="absolute -top-52 left-1/2 -z-10 -translate-x-1/2 transform-gpu blur-3xl sm:top-[-28rem] sm:ml-16 sm:translate-x-0 sm:transform-gpu" aria-hidden="true">
                    <div class="aspect-[1097/845] w-[68.5625rem] bg-gradient-to-tr from-[#ff4694] to-[#776fff] opacity-20" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
                </div>
        <div class="px-4 mx-auto max-w-7xl lg:px-8">
            <main
                class="flex flex-col items-center justify-center gap-4 mt-4 mb-4 sm:justify-start sm:flex-row dark:text-gray-300">
                <div
                    class='flex flex-col justify-between w-full px-6 py-10 bg-white border shadow-md h-96 dark:border-gray-900 dark:shadow-black dark:bg-gray-900 rounded-md lg:w-96'>
                    <span>
                        <svg width="140" height="140" viewBox="0 0 140 140" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_4014_33527)">
                                <circle cx="70" cy="70" r="69" fill="#f3f4f6" stroke="#0C0C0C"
                                    stroke-width="2" />
                                <circle cx="70.0001" cy="60.7476" r="31.8537" stroke="#7F6AFF"
                                    stroke-width="1.49398" />
                                <rect x="61.9763" y="96.5801" width="16.0478" height="15.2729" fill="#0C0C0C" />
                                <circle cx="70.0001" cy="60.7479" r="26.6474" fill="#7F6AFF" stroke="lightgray"
                                    stroke-width="1.55545" />
                            </g>
                            <defs>
                                <clipPath id="clip0_4014_33527">
                                    <rect width="140" height="140" fill="white" />
                                </clipPath>
                            </defs>
                        </svg></span>

                    <div class='my-3'>
                        <h1 class='text-lg'>{{ __('welcome.landing-4') }} </h1>

                    </div>
                    <x-button href="{{ route('notes.create') }}" class='w-full h-12' primary
                        icon="user">{{ __('welcome.landing-5') }} </x-button>
                </div>
                <div
                    class='flex flex-col justify-between w-full h-auto px-6 py-10 bg-white border shadow-md sm:h-96 dark:border-gray-900 dark:shadow-black dark:bg-gray-900 rounded-md lg:w-96'>
                    <span><svg width="140" height="140" viewBox="0 0 140 140" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_4014_33508)">
                                <circle cx="70" cy="70" r="69" fill="#f3f4f6" stroke="#0C0C0C"
                                    stroke-width="2" />
                                <rect x="42.7419" y="40.4346" width="57.9224" height="57.9224" stroke="#7F6AFF" />
                                <path
                                    d="M94.4146 62.5949C103.778 62.5949 111.369 55.004 111.369 45.6402C111.369 36.2764 103.778 28.6855 94.4146 28.6855C85.0508 28.6855 77.46 36.2764 77.46 45.6402C77.46 55.004 85.0508 62.5949 94.4146 62.5949Z"
                                    fill="#0C0C0C" />
                                <path
                                    d="M70 82.9412C72.233 78.3681 75.7056 74.514 80.0221 71.8181C84.3386 69.1222 89.3255 67.6929 94.4147 67.6929C99.5039 67.6929 104.491 69.1222 108.807 71.8181C113.124 74.514 116.596 78.3681 118.829 82.9412"
                                    fill="#0C0C0C" />
                                <path
                                    d="M45.5853 84.3258C54.9491 84.3258 62.54 76.735 62.54 67.3712C62.54 58.0074 54.9491 50.4165 45.5853 50.4165C36.2215 50.4165 28.6306 58.0074 28.6306 67.3712C28.6306 76.735 36.2215 84.3258 45.5853 84.3258Z"
                                    fill="#7F6AFF" stroke="#7F6AFF" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M21.1707 104.672C23.4037 100.099 26.8762 96.245 31.1928 93.5491C35.5093 90.8532 40.4962 89.4238 45.5854 89.4238C50.6746 89.4238 55.6615 90.8532 59.978 93.5491C64.2945 96.245 67.7671 100.099 70.0001 104.672"
                                    fill="#7F6AFF" stroke="#7F6AFF" stroke-width="2" stroke-linecap="square"
                                    stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_4014_33508">
                                    <rect width="140" height="140" fill="lightgray" />
                                </clipPath>
                            </defs>
                        </svg></span>
                    <div class='my-3'>
                        <h1 class='text-lg'>{{ __('welcome.landing-2') }}
                        </h1>
                    </div>
                    <div class='flex flex-col gap-2'>
                        <x-button  class='w-full h-12' href="{{ route('notes.post-create') }}" primary
                            icon="shopping-cart">{{ __('welcome.landing-3') }} </x-button>

                        <x-button  class='w-full h-12' href="{{ route('notes.index') }}" primary icon="search">
                            {{ __('welcome.landing-3.1') }} </x-button>
                    </div>
                </div>

            </main>
            <div
                class="overflow-hidden bg-white border rounded-md shadow-md dark:border-gray-900 dark:shadow-black dark:bg-gray-900">
                <div class="p-4 bg-white  sm:p-6 dark:bg-gray-900">
                    <div class="flex items-center">
                        <div>
                            <p class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-300">
                                {{ __('dashboardz.dashboardz-01') }}</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <div class="inline-block text-sm leading-9 text-gray-900 dark:text-gray-400">
                            {{ __('dashboardz.dashboardz-02') }} <br />
                            <strong class='dark:text-gray-300 text-gray-950'>
                                {{ __('dashboardz.dashboardz-03') }}</strong>
                            {{ __('dashboardz.dashboardz-04') }} <a href="{{ route('notes.create') }}"
                                class='text-indigo-500 hover:border-b hover:border-b-indigo-500'>
                                {{ __('dashboardz.dashboardz-05') }}</a>
                            {{ __('dashboardz.dashboardz-06') }}
                            <a href="{{ route('notes.jobs') }}"
                                class='text-indigo-500 hover:border-b hover:border-b-indigo-500'>
                                {{ __('dashboardz.dashboardz-07') }}</a>
                            <br />
                            <strong class='dark:text-gray-300 text-gray-950'> {{ __('dashboardz.dashboardz-1') }}
                            </strong>
                            {{ __('dashboardz.dashboardz-2') }} <a href="{{ route('notes.post-create') }}"
                                class='inline-block text-indigo-500 hover:border-b hover:border-b-indigo-500'>{{ __('dashboardz.dashboardz-3') }}</a>
                            {{ __('dashboardz.dashboardz-4') }} {{ __('dashboardz.dashboardz-5') }}
                            <livewire:company-access.request-access />
                            {{ __('dashboardz.dashboardz-7') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
