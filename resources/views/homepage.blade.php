@vite(['resources/js/app.js', 'resources/css/app.css'])

<x-layout title="Homepage">

    <div class="bg-moss-light">
    <!-- De header met gecentreerde tekst -->
    <h1>Welkom bij open hiring!</h1>


        <!-- De container voor de afbeelding en de tekst -->
    <div class="flex justify-between items-center p-[5%]">
        <!-- De afbeelding instellen op 25% breedte en vierkant houden -->
        <img src="{{ asset('images/homepage-image-1.jpg') }}" alt="homepage afbeelding" class="w-[30vw] h-auto rounded-[4vw]">


        <div class="text-xl text-[#2E342A] w-1/2 flex flex-col items-center">
            <h2 class="text-3xl m-[2vw] font-bold">Werk voor wie wil werken</h2>
            <p class="w-[35vw] text-left">
                Met Open Hiring heeft iedereen een eerlijke kans op een baan. Wie wil én kan werken, kan zó aan de slag. Zonder sollicitatiegesprek, zonder brief, zonder vragen. Met één druk op de knop. Open Hiring draait namelijk niet om diploma’s, maar om mensen. Niet om praatjes, maar om aanpakken.
            </p>
            <!-- Knop in het midden -->
            <a href="/vacatures" class="button-small mt-4">
                Bekijk vacatures
            </a>
        </div>
        </div>




    </div>


    <div class="flex flex-col justify-center items-center">
        <h1 class="mb-[2vw]">Zo werkt het</h1>

        <img src="{{ asset('images/homepage-image-2.jpg') }}" alt="zo werkt het afbeelding" class="w-[45vw] h-auto mb-[2vw] rounded-[4vw]">

    </div>
    <div class="ml-[27.5vw] mb-[2vw] flex flex-col gap-[0.5vw]">
        <p>* Direct reageren. Zonder sollicitatiegesprek, vragen of (voor)oordelen. Een eerlijke kans.</p>
        <p>* Jij bepaalt of je het kunt.</p>
        <p>* Snel aan de slag. Met een normaal contract, vanaf dag 1 betaald.</p>
    </div>

    <div class="flex flex-col justify-center items-center gap-[2vw] w-[45vw] ml-[27.5vw]" >
    <h1>Iedereen kan meedoen!</h1>
    <p>Iedereen een eerlijke kans op een baan. Daar draait het om bij Open Hiring. Het gaat er niet om of iemand een diploma, vlotte babbel of bakken ervaring heeft, maar of iemand wíl en kan werken. Bedrijven die mensen zoeken via Open Hiring houden dus geen sollicitatiegesprekken. Zo hebben vooroordelen geen kans. Werkzoekenden bepalen zelf of ze geschikt zijn voor een baan. Zo maken we de arbeidsmarkt eerlijk. En krijgen we mensen snel (weer) aan het werk.</p>
        <img src="{{ asset('images/homepage-image-3.jpg') }}" alt="zo werkt het afbeelding" class="w-[30vw] h-auto mb-[2vw] rounded-[4vw]">
    </div>
</x-layout>
