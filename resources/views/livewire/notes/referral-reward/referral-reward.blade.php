<x-guest-layout>
    <main class='p-3'>
        <x-card title="Congratulations {{ $name }}! You received your reward!">
            After receiving this email, the next steps will be to wait for our team to reach out to you <br />
            so we can schedule a time for a video chat to explain how everything will work :)
            <br /> <br />

            - The email through which we will contact you will be: <strong> {{ $email }}</strong>
            <br /> 
            - Dont forget not to lose your referral code: <strong> {{ $referral }} </strong>
            <br /> 
            - Your reward type: <strong>{{ $typeReward }} </strong>
            <br />



            <br /> <br />

            Sincerely,
            <br />
            Megy a Meló
        </x-card>
    </main>
</x-guest-layout>
