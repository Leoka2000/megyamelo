<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    public function goToIndex(): void
    {
        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center  mt-2 cursor-pointer shrink-0">
                    <a wire:click='goToIndex'>
                        <svg class="w-6 h-6 text-gray-700 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h3a3 3 0 0 0 0-6h-.025a5.56 5.56 0 0 0 .025-.5A5.5 5.5 0 0 0 7.207 9.021C7.137 9.017 7.071 9 7 9a4 4 0 1 0 0 8h2.167M12 19v-9m0 0-2 2m2-2 2 2" />
                        </svg>



                    </a>
                </div>

                <!-- Navigation Links -->

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                        <p class='text-xs lg:text-sm'>
                            {{ __('nav.nav-home') }}
                        </p>
                    </x-nav-link>
                    <x-nav-link :href="route('notes.create')" :active="request()->routeIs('notes.create')" wire:navigate>
                        <p class='text-xs lg:text-sm'>
                            {{ __('nav.nav-subscribe') }}
                        </p>
                    </x-nav-link>
                    <x-nav-link :href="route('notes.index')" :active="request()->routeIs('notes.index')" wire:navigate>
                        <p class='text-xs lg:text-sm'>
                            {{ __('nav.nav-job-seekers') }}
                        </p>
                    </x-nav-link>
                    <x-nav-link :href="route('notes.jobs')" :active="request()->routeIs('notes.jobs')" wire:navigate>
                        <p class='text-xs lg:text-sm'>
                            {{ __('nav.nav-job-list') }}
                        </p>
                    </x-nav-link>
                    <x-nav-link href="{{ route('notes.post-create') }}" :active="request()->routeIs('notes.post-create')">
                        <p class='text-xs lg:text-sm'>
                            {{ __('nav.nav-create-post') }}
                        </p>
                    </x-nav-link>

                </div>

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-live-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-2 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-900 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('profilez.profile1') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('nav.nav-logout') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-live-dropdown>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <x-icon name="cog" class="w-5 h-5 ml-2 dark:text-gray-400 text-gray-500" />
                    </x-slot>
                    <x-dropdown.header label="Language">
                        <x-dropdown.item class='flex gap-2' spinner href="{{ route('locale', 'hu') }}"> <x-flag-country-hu class="w-6 h-6" /> Hungarian</x-dropdown.item>
                        <x-dropdown.item class='flex gap-2' spinner href="{{ route('locale', 'en') }}"> <x-flag-country-us class="w-6 h-6" /> English</x-dropdown.item>
                    </x-dropdown.header>

                    <x-dropdown.header class="" label="Toggle theme">
                        <div class="flex mt-1 justify-start">
                            <div class='flex items-center justify-center gap-1' x-data="window.themeSwitcher()" x-init="switchTheme()"
                                @keydown.window.tab="switchOn = false" class="flex items-center justify-center">
                                <input id="thisId" type="checkbox" name="switch" class="hidden" :checked="switchOn">


                                <label @click="$refs.switchButton.click(); $refs.switchButton.focus()" :id="$id('switch')"
                                    :class="{ 'text-blue-600': switchOn, 'text-gray-500': !switchOn }" class="text-sm select-none">

                                </label>
                                <button x-ref="switchButton" type="button" @click="switchOn = ! switchOn; switchTheme()"
                                    :class="switchOn ? 'bg-indigo-600' : 'bg-neutral-200'"
                                    class="relative inline-flex h-6 py-0.5 ml-4 focus:outline-none rounded-full w-10">
                                    <span :class="switchOn ? 'translate-x-[18px]' : 'translate-x-0.5'"
                                        class="w-5 h-5 duration-200 ease-in-out bg-white rounded-full shadow-md"></span>
                                </button>
                                <x-icon name="moon" class="w-5 h-5 text-gray-400" />

                            </div>
                        </div>
                    </x-dropdown.header>

                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <x-dropdown class="" icon="bars-3" align="right" width="48">
                    <x-dropdown.header label="Language">
                        <x-dropdown.item class='flex gap-2' spinner href="{{ route('locale', 'hu') }}"> <x-flag-country-hu class="w-6 h-6" /> Hungarian</x-dropdown.item>
                        <x-dropdown.item class='flex gap-2' spinner href="{{ route('locale', 'en') }}"> <x-flag-country-us class="w-6 h-6" /> English</x-dropdown.item>
                    </x-dropdown.header>

                    <x-dropdown.header class="mt-3" label="Toggle theme">
                        <div class="flex mt-1 justify-start">
                            <div class='flex items-center justify-center gap-1' x-data="window.themeSwitcher()" x-init="switchTheme()"
                                @keydown.window.tab="switchOn = false" class="flex items-center justify-center">
                                <input id="thisId" type="checkbox" name="switch" class="hidden" :checked="switchOn">

                                <button x-ref="switchButton" type="button" @click="switchOn = ! switchOn; switchTheme()"
                                    :class="switchOn ? 'bg-indigo-600' : 'bg-neutral-200'"
                                    class="relative inline-flex h-6 py-0.5 ml-4 focus:outline-none rounded-full w-10">
                                    <span :class="switchOn ? 'translate-x-[18px]' : 'translate-x-0.5'"
                                        class="w-5 h-5 duration-200 ease-in-out bg-white rounded-full shadow-md"></span>
                                </button>
                                <label @click="$refs.switchButton.click(); $refs.switchButton.focus()" :id="$id('switch')"
                                    :class="{ 'text-blue-600': switchOn, 'text-gray-500': !switchOn }" class="text-sm select-none">

                                </label>
                                <x-icon name="moon" class="w-5 h-5 text-gray-400" />

                            </div>
                        </div>
                    </x-dropdown.header>
                </x-dropdown>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('notes.create')" :active="request()->routeIs('notes.create')" wire:navigate>
                {{ __('Create profile') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('notes.index')" :active="request()->routeIs('notes.index')" wire:navigate>
                {{ __('Job seekers') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('notes.jobs')" :active="request()->routeIs('notes.jobs')" wire:navigate>
                {{ __('Job list') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('notes.post-create')" :active="request()->routeIs('notes.post-create')" wire:navigate>
                {{ __('Create a job advertisement') }}
            </x-responsive-nav-link>




        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800 dark:text-gray-200" x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                    x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>

            </div>

            <div class="mt-3 space-y-1">

                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>


</nav>