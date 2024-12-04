@vite(['resources/js/app.js', 'resources/css/app.css'])

<x-layout title="Homepage">
    <!-- De header met gecentreerde tekst -->
    <h1 class="text-4xl font-bold text-[#2E342A] text-center mt-[3%]">Welkom bij open hiring!</h1>

    <!-- De container voor de afbeelding en de tekst -->
    <div class="flex justify-between items-center p-[5%]">
        <!-- De afbeelding instellen op 25% breedte en vierkant houden -->
        <img src="{{ asset('images/homepageImage.jpg') }}" alt="homepage afbeelding" class="w-[30vw] h-auto rounded-[4vw]">


        <div class="text-xl text-[#2E342A] w-1/2 flex flex-col items-center">
            <h2 class="text-3xl m-[2vw] font-bold">Werk voor wie wil werken</h2>
            <p class="w-[35vw] text-left">
                Met Open Hiring heeft iedereen een eerlijke kans op een baan. Wie wil én kan werken, kan zó aan de slag. Zonder sollicitatiegesprek, zonder brief, zonder vragen. Met één druk op de knop. Open Hiring draait namelijk niet om diploma’s, maar om mensen. Niet om praatjes, maar om aanpakken.
            </p>
            <!-- Knop in het midden -->
            <a href="/vacatures" class="button-small mt-4">
                Naar Vacatures
            </a>
        </div>




    </div>
</x-layout>
