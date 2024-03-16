<x-guest-layout>
<main class='p-3'>
    <x-card title="Your referral code is: {{ $referral }} ">
        <p>Dear {{ $name }}, Thank you for participating in our referral program. Please make sure that the person
            subscribing to the platform uses your referral code <strong>( {{ $referral }}) <strong> at the time of creating a profile in order for you to
            receive your mentorship.
            <br />
            We hope we can grow together with this!
        </p>

        <br />
        <br />

        Sincerely,
        <br />
        Megy a Meló
    </x-card>
    </main>
</x-guest-layout>
