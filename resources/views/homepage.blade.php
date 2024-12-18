<x-layout title="Homepage" class="max-w-full">

    <div class="bg-moss-light">
        <!-- De header met gecentreerde tekst -->
        <h1 class="mt-[5vw]  md:mt-0 pt-[5vw] text-3xl md:text-5xl">Welkom bij Open Hiring!</h1>

        @if (session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        @endif

        <!-- De container voor de afbeelding en de tekst -->
        <div class="flex flex-col md:flex-row justify-between items-center p-[5%] max-w-full">
            <!-- De afbeelding instellen op 25% breedte en vierkant houden -->
            <img src="{{ asset('images/homepage-image-1.jpg') }}" alt="homepage afbeelding"
                class="w-[60vw] md:w-[30vw] md:mb-0 h-auto rounded-[4vw]">

            <div class="text-xl text-[#2E342A] flex flex-col items-center">
                <h2 class=" text-2xl md:text-3xl m-[5vw] md:m-[2vw] md:w-auto md:text-left font-bold">Werk voor wie wil
                    werken</h2>
                <p class="w-[90vw] md:w-[35vw] text-center md:text-left text-[1rem] md:text-lg">
                    Met Open Hiring heeft iedereen een eerlijke kans op een baan. Wie wil én kan werken, kan zó aan de
                    slag. Zonder sollicitatiegesprek, zonder brief, zonder vragen. Met één druk op de knop. Open Hiring
                    draait namelijk niet om diploma’s, maar om mensen. Niet om praatjes, maar om aanpakken.
                </p>
                <!-- Knop in het midden -->
                <a href="/vacatures" class="button-small mt-4" id="vacaturesButtonHome">
                    Bekijk vacatures
                </a>
            </div>
        </div>
    </div>

    <div class="flex flex-col justify-center items-center max-w-full">
        <h1 class="m-[5vw] md:mb-[2vw]">Zo werkt het</h1>

        <img src="{{ asset('images/homepage-image-2.jpg') }}" alt="zo werkt het afbeelding"
            class="w-[60vw] md:w-[45vw] h-auto mb-[10vw] md:mb-[2vw] rounded-[4vw]">
    </div>

    <div class="ml-[5vw] mr-[5vw] mb-[5vw] md:ml-[27.5vw] md:mr-0 md:mb-[2vw] flex flex-col gap-[0.5vw] max-w-full">
        <p>* Direct reageren. Zonder sollicitatiegesprek, vragen of (voor)oordelen. Een eerlijke kans.</p>
        <p>* Jij bepaalt of je het kunt.</p>
        <p>* Snel aan de slag. Met een normaal contract, vanaf dag 1 betaald.</p>
    </div>

    <div
        class="flex flex-col justify-center items-center gap-[2vw] w-[90vw] ml-[5vw] md:ml-[27.5vw] md:w-[45vw] max-w-full">
        <h1 class="mb-[5vw] md:mb-0">Iedereen kan meedoen!</h1>
        <p class="text-center md:text-left">
            Iedereen verdient een eerlijke kans op een baan. Daar draait het om bij Open Hiring. Het gaat er niet om of
            iemand
            een diploma, vlotte babbel of bakken ervaring heeft, maar of iemand wíl en kan werken. Bedrijven die mensen
            zoeken via Open Hiring houden dus geen sollicitatiegesprekken. Zo hebben vooroordelen geen kans.
            Werkzoekenden bepalen zelf of ze geschikt zijn voor een baan. Zo maken we de arbeidsmarkt eerlijk en
            krijgen we mensen snel aan het werk.
        </p>
        <img src="{{ asset('images/homepage-image-3.jpg') }}" alt="zo werkt het afbeelding"
            class="w-[60vw] md:w-[30vw] h-auto mb-[10vw] md:mb-[2vw] md:mt-0 rounded-[4vw]">
    </div>
</x-layout>
