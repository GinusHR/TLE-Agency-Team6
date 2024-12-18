<x-layout>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggles = document.querySelectorAll('[data-toggle-container]');

            toggles.forEach(toggleContainer => {
                toggleContainer.addEventListener('click', () => {
                    const targetId = toggleContainer.dataset.toggle;
                    const target = document.getElementById(targetId);
                    const button = toggleContainer.querySelector('button');

                    // Toggle the + or - symbol
                    if (button.textContent === '+') {
                        button.textContent = '-';
                    } else {
                        button.textContent = '+';
                    }

                    if (!['toggle-companies', 'toggle-employees'].includes(targetId)) {
                        const parentSection = toggleContainer.closest('section');
                        const allPanels = parentSection.querySelectorAll('[id^="toggle-"]');

                        allPanels.forEach(panel => {
                            if (panel !== target && panel.classList.contains('max-h-[500px]')) {
                                panel.classList.remove('max-h-[500px]', 'opacity-100');
                                panel.classList.add('max-h-0', 'opacity-0');
                            }
                        });

                        if (target) {
                            if (target.classList.contains('max-h-0')) {
                                target.classList.remove('max-h-0', 'opacity-0');
                                target.classList.add('max-h-[500px]', 'opacity-100');
                            } else {
                                target.classList.remove('max-h-[500px]', 'opacity-100');
                                target.classList.add('max-h-0', 'opacity-0');
                            }
                        }
                    }

                    if (['toggle-companies', 'toggle-employees'].includes(targetId)) {
                        if (target) {
                            target.classList.toggle('hidden');
                        }
                    }
                });
            });
        });
    </script>

    <main class="container mx-auto px-4 py-10 w-[80vw]">
        <section class="mb-10">
            <h2 class="text-2xl font-bold mb-4">Wat is Open Hiring?</h2>
            <div class="mt-4">
                <p class="leading-relaxed mb-4">
                    Open Hiring betekent dat de deur voor iedereen openstaat. Wij helpen je, ongeacht je achtergrond, om een baan te vinden zonder gedoe. Zet je naam op de lijst en word aangenomen – het proces is snel en eenvoudig. Je hoeft je geen zorgen te maken over vooroordelen, want het hele proces is anoniem. Er is geen account nodig.
                </p>
                <p class="leading-relaxed">
                    Dit principe helpt mensen die moeite hebben om werk te vinden, terwijl het bedrijven een gemakkelijke en kostenefficiënte manier biedt om nieuwe medewerkers aan te trekken.
                </p>
            </div>
        </section>

        <section class="mb-10">
            <h2 class="text-2xl font-bold mb-4">Voordelen van Open Hiring</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="p-6 bg-white shadow rounded">
                    <div class="flex flex-row align-center justify-between" data-toggle-container data-toggle="toggle-employees">
                        <h3 class="text-xl font-bold mb-2">Voor medewerkers</h3>
                        <button class="text-black font-bold text-2xl">+</button>
                    </div>

                    <div id="toggle-employees" class="hidden mt-4">
                        <div class="flex flex-col justify-evenly h-3/4">
                            <div class="flex flex-row justify-start gap-1 align-center">
                                <p class="text-moss-medium align-center flex justify-center">&#10004;</p>
                                <p class="w-full"> Meld je aan via onze website of op locatie.</p>
                            </div>

                            <div class="flex flex-row justify-start gap-1 align-center">
                                <p class="text-moss-medium align-center flex justify-center">&#10004;</p>
                                <p> Account is niet nodig. Alleen een email.</p>
                            </div>

                            <div class="flex flex-row justify-start gap-1 align-center">
                                <p class="text-moss-medium align-center flex justify-center">&#10004;</p>
                                <p> Eenmaal op een lijst hoef je alleen maar te wachten.</p>
                            </div>

                            <div class="flex flex-row justify-start gap-1 align-center">
                                <p class="text-moss-medium align-center flex justify-center">&#10004;</p>
                                <p> Maak je geen zorgen meer over vooroordelen.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-white shadow rounded">
                    <div class="flex flex-row align-center justify-between" data-toggle-container data-toggle="toggle-companies">
                        <h3 class="text-xl font-bold mb-2">Voor bedrijven</h3>
                        <button class="text-black font-bold text-2xl ">+</button>
                    </div>

                    <div id="toggle-companies" class="hidden mt-4">
                        <div class="flex flex-col justify-evenly h-3/4">
                            <div class="flex flex-row justify-start gap-1 align-center">
                                <p class="text-moss-medium align-center flex justify-center">&#10004;</p>
                                <p> Neem eenvoudig nieuwe werknemers aan.</p>
                            </div>

                            <div class="flex flex-row justify-start gap-1 align-center">
                                <p class="text-moss-medium align-center flex justify-center">&#10004;</p>
                                <p> Vergroot je sociale footprint.</p>
                            </div>

                            <div class="flex flex-row justify-start gap-1 align-center">
                                <p class="text-moss-medium align-center flex justify-center">&#10004;</p>
                                <p> Goed alternatief voor dure sollicitatieprocedures.</p>
                            </div>

                            <div class="flex flex-row justify-start gap-1 align-center">
                                <p class="text-moss-medium align-center flex justify-center">&#10004;</p>
                                <p> Maak een inclusieve, open bedrijfscultuur.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="flex flex-col items-center justify-center py-10 gap-4">
            <h2 class="text-2xl font-bold mb-4">Spelregels voor bedrijven</h2>
            <p>Om met Open Hiring te kunnen werken hebben we een paar 'spelregels'</p>

            <div id="rule-1" class="bg-moss-light w-[80vw] md:w-2/4 rounded-lg p-3 shadow" data-toggle="toggle-rule-1">
                <div class="flex flex-row justify-between">
                    <h3 class="font-bold text-xl"> 1. Open deur</h3>
                    <button class="font-bold text-xl">+</button>
                </div>
                <div id="toggle-rule-1" class="max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-in-out">
                    <div>
                        <p class="text-lg">
                            Iedereen kan, via deze website, reageren op een baan. Ongeacht achtergrond en ervaring. De wil om te werken, daar draait het om. Werkgevers zetten de deur dus open voor iedereen en werkzoekenden bepalen zelf of ze geschikt zijn voor de baan.
                        </p>
                    </div>
                </div>
            </div>

            <div id="rule-2" class="bg-moss-light w-[80vw] md:w-2/4 rounded-lg p-3 shadow" data-toggle="toggle-rule-2">
                <div class="flex flex-row justify-between">
                    <h3 class="font-bold text-xl"> 2. Tijdelijke contracten</h3>
                    <button class="font-bold text-xl">+</button>
                </div>
                <div id="toggle-rule-2" class="max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-in-out">
                    <div>
                        <p class="text-lg">
                            Na een proefperiode kan de werknemer een tijdelijk contract krijgen. Dit betekent dat er eerst getest wordt of de werknemer geschikt is voor de functie en of de werknemer het werk echt wil.
                        </p>
                    </div>
                </div>
            </div>

            <div id="rule-3" class="bg-moss-light w-[80vw] md:w-2/4 rounded-lg p-3 shadow" data-toggle="toggle-rule-3">
                <div class="flex flex-row justify-between">
                    <h3 class="font-bold text-xl"> 3. Gegarandeerde werkzekerheid</h3>
                    <button class="font-bold text-xl">+</button>
                </div>
                <div id="toggle-rule-3" class="max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-in-out">
                    <div>
                        <p class="text-lg">
                            Medewerkers krijgen werkzekerheid zodra zij hun tijdelijke contract omzetten naar een vast contract. Werkgevers zorgen voor werkzekerheid en continuïteit in de werkzaamheden.
                        </p>
                    </div>
                </div>
            </div>

            <div id="rule-4" class="bg-moss-light w-[80vw] md:w-2/4 rounded-lg p-3 shadow" data-toggle="toggle-rule-4">
                <div class="flex flex-row justify-between">
                    <h3 class="font-bold text-xl"> 4. Geen sollicitatieprocedure</h3>
                    <button class="font-bold text-xl">+</button>
                </div>
                <div id="toggle-rule-4" class="max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-in-out">
                    <div>
                        <p class="text-lg">
                            Werkzoekenden hoeven geen sollicitatiegesprekken te voeren of uitgebreide CV's in te leveren. Het gaat enkel om de bereidheid om te werken, niet om een sollicitatieprocedure.
                        </p>
                    </div>
                </div>
            </div>

            <div id="rule-5" class="bg-moss-light w-[80vw] md:w-2/4 rounded-lg p-3 shadow" data-toggle="toggle-rule-5">
                <div class="flex flex-row justify-between">
                    <h3 class="font-bold text-xl"> 5. Geen beoordeling op ervaring</h3>
                    <button class="font-bold text-xl">+</button>
                </div>
                <div id="toggle-rule-5" class="max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-in-out">
                    <div>
                        <p class="text-lg">
                            Werkgevers kijken niet naar ervaring, maar naar de wil om te werken. Iedereen heeft gelijke kansen om in aanmerking te komen voor een functie, ongeacht hun ervaring of opleiding.
                        </p>
                    </div>
                </div>
            </div>

            <div id="rule-6" class="bg-moss-light w-[80vw] md:w-2/4 rounded-lg p-3 shadow" data-toggle="toggle-rule-6">
                <div class="flex flex-row justify-between">
                    <h3 class="font-bold text-xl"> 6. Anoniem sollicitatieproces</h3>
                    <button class="font-bold text-xl">+</button>
                </div>
                <div id="toggle-rule-6" class="max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-in-out">
                    <div>
                        <p class="text-lg">
                            Sollicitaties worden anoniem verwerkt. Dit betekent dat werkgevers niet weten wie je bent, wat je achtergrond is of waar je vandaan komt. Alleen je bereidheid om te werken telt.
                        </p>
                    </div>
                </div>
            </div>

            <div id="rule-7" class="bg-moss-light w-[80vw] md:w-2/4 rounded-lg p-3 shadow" data-toggle="toggle-rule-7">
                <div class="flex flex-row justify-between">
                    <h3 class="font-bold text-xl"> 7. Directe aanstelling</h3>
                    <button class="font-bold text-xl">+</button>
                </div>
                <div id="toggle-rule-7" class="max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-in-out">
                    <div>
                        <p class="text-lg">
                            Zodra je op de lijst staat, wordt je direct aangenomen als er een baan beschikbaar is. Dit betekent dat je snel aan de slag kunt gaan zonder lange wachttijden.
                        </p>
                    </div>
                </div>
            </div>

            <div id="rule-8" class="bg-moss-light w-[80vw] md:w-2/4 rounded-lg p-3 shadow" data-toggle="toggle-rule-8">
                <div class="flex flex-row justify-between">
                    <h3 class="font-bold text-xl"> 8. Geen voorkeur voor kandidaten</h3>
                    <button class="font-bold text-xl">+</button>
                </div>
                <div id="toggle-rule-8" class="max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-in-out">
                    <div>
                        <p class="text-lg">
                            Er worden geen voorkeuren gegeven voor kandidaten. Alle werkzoekenden krijgen gelijke kansen en worden op basis van hun wil om te werken aangenomen.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-layout>
