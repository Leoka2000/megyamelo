<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <x-card class='' title='Emily Natsumi: HR Consultant | Data Specialist | Scrum Master | Project Coordinator'>

        <x-slot name="action">
            <a class='hidden pl-3 sm:block' target="_blank" href="https://www.linkedin.com/in/emilykusano/"> <x-avatar
                    size="w-20 h-20" class='border-none pointer' src="{{ asset('natsumi.jpeg') }}" /></a>
        </x-slot>
        <div class='flex flex-col-reverse gap-5 mb-3 sm:flex-row sm:justify-start'>
            <div class='flex flex-col justify-start'>

                <h1 class='font-bold text-indigo-600'>
                    About me :
                </h1>
                <p class="text-xs md:text-sm"> Business Administration specialist and degree in Human Resources
                    Management.
                    Certified Scrum
                    Master by Scrum Alliance and Green Belt Certification in Lean Six Sigma. I am a strategic and
                    innovative HR professional who translates business vision into HR initiatives that improve
                    performance, profitability and growth. <br /> <br />


                    As a seasoned professional with more than 7 years of experience in the HR area with a background
                    in talent and learning, development and engagement, individual development plan and recognition, 360
                    feedback, design and facilitating trainings and applying continuous improvement processes. <br />
                    <br />

                    Moreover inside HR Ops I've been working with compensation and benefits, recruitment, calculation
                    of merit and bonus, internal communications and labour relations. <br /> <br />

                    Lead strategic projects, tools and policies, know-how of design thinking and people analytics.
                    Trainer of NVC (Non Violent Communication) and I also have experience as DISC analyst and multi area
                    professional and 1st contact of support managers on people-related matters. <br /> <br />

                    International experience: Global HR team in Germany for 1 year, plus exchange program for ESL in
                    Canada for 6 months. Currently working as junior project coordinator in Budapest, capital of
                    Hungary. <br /> <br />

                    Applications: SalesForce SAP, RM Labore (TOTVS), Microsoft Dynamics (Navision), Zoho People,
                    Workday HCM, Senior Rubi/Ronda, Monday and Jira. MS Office proficient user with advanced excel (VBA,
                    Macro). <br /> <br />

                    Languages: Portuguese (native), English (fluent), Japanese (intermediate) and German (beginner).
                </p>
            </div>
            <div>
                <a class='block sm:hidden' target="_blank" href="https://www.linkedin.com/in/emilykusano/"> <x-avatar
                        size="w-20 h-20" class='border-none pointer' src="{{ asset('natsumi.jpeg') }}" /></a>
                <h1 class='font-bold text-indigo-600'>
                    How I will help you:
                </h1>

                <p class='mb-3 text-xs sm:text-sm'>I have a background in HR management and an MBA in business
                    management from USP,
                    plus 7 years of
                    experience in large multinational companies, family businesses, and startups. My mentorship with you
                    will include:
                </p>
                <ul class='flex flex-col w-full gap-2 '>
                    <li class='flex items-center w-full gap-3 text-xs sm:text-sm'>
                        <x-badge.circle primary icon="check" />CV review
                    </li>
                    <li class='flex items-center gap-3 text-xs sm:text-sm'>
                        <x-badge.circle primary icon="check" xl />Interview simulation
                    </li>
                    <li class='flex items-center gap-3 text-xs sm:text-sm'>
                        <x-badge.circle primary icon="check" xl />LinkedIn review
                    </li>
                    <li class='flex items-center gap-2 text-xs sm:text-sm'>
                        <a class='pr-1'><x-badge.circle primary icon="check" xl /></a>Support in migration and
                        national or international career planning (Europe, focusing on Germany and Hungary)
                    </li>
                    <li class='flex items-center gap-2 text-xs sm:text-sm'>
                        <a class='pr-1'><x-badge.circle primary icon="check" xl /></a>Productivity tools: 5W2H, some
                        knowledge of green belt Lean Six Sigma, Pomodoro technique, etc.
                    </li>
                    <li class='flex items-center gap-2 text-xs sm:text-sm'>
                        <a class='pr-1'><x-badge.circle primary icon="check" xl /></a>Mentorship of 8 hours.
                    </li>
                </ul>
                <div class='flex gap-2 mt-4'>
                    <x-button class='h-10'  href="https://www.linkedin.com/in/emilykusano/" target='_blank' outline >
                    LinkedIn <img class='w-6'  src="{{ asset('linkedin.png') }}" />

                    </x-button>

                     <x-button  href="https://www.instagram.com/emilynat.rh/" target='_blank' outline class='h-10'>
                       Instagram <img class='w-5'  src="{{ asset('insta.png') }}" />
                    </x-button>
                
                </div>
            </div>

        </div>



        <x-slot name="footer">
            <div class='flex gap-1'>
       
            <x-button icon="arrow-left" href="{{ route('notes.create') }}"> {{__('create-note.create-1')}}</x-button>
            </div>
        </x-slot>




    </x-card>
</div>
