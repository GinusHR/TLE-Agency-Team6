@vite(['resources/js/app.js', 'resources/css/app.css'])

<x-layout title="Homepage">
    <!-- De header met gecentreerde tekst -->
    <h1 class="text-4xl font-bold text-[#2E342A] text-center mt-[3%]">
        Welkom op de nieuwe homepage!
    </h1>

    <!-- De container voor de afbeelding en de tekst -->
    <div class="flex justify-between items-center p-[5%]">
        <!-- De afbeelding instellen op 25% breedte en vierkant houden -->
        <img src="{{ asset('images/homepageImage.jpg') }}" alt="homepage afbeelding" class="w-[30vw] h-auto">
        <div class="text-xl text-[#2E342A] w-1/2 flex flex-col items-center">
            <h2 class="text-3xl m-[2vw] font-bold">Over open Hiring</h2>
            <p class="w-[35vw]">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi delectus dolores incidunt, laborum laudantium maxime, nihil optio perspiciatis porro quaerat quam quod rem reprehenderit ut vel vitae voluptas! Ad, voluptates? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad aliquam, aliquid autem commodi, consequuntur delectus dolorem doloremque earum error exercitationem id ipsam molestiae quisquam recusandae.
            </p>
            <a  href="/vacatures" class="button-small m-[2vw]">
                Naar Vacatures
            </a>
        </div>



    </div>
</x-layout>
