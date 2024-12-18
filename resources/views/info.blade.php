<x-layout>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggles = document.querySelectorAll('[data-toggle]');
            toggles.forEach(toggle => {
                toggle.addEventListener('click', () => {
                    const targetId = toggle.dataset.toggle;
                    const target = document.getElementById(targetId);


                    if (!['toggle-companies', 'toggle-employees'].includes(targetId)) {
                        const parentSection = toggle.closest('section');
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
                    <div class="flex flex-row align-center justify-between">
                        <h3 class="text-xl font-bold mb-2">Voor medewerkers</h3>
                        <button data-toggle="toggle-employees" class="text-black font-bold text-2xl">&#43;</button>
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
                    <div class="flex flex-row align-center justify-between">
                        <h3 class="text-xl font-bold mb-2">Voor bedrijven</h3>
                        <button data-toggle="toggle-companies" class="text-black font-bold text-2xl ">&#43;</button>
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
            <div class="bg-moss-light w-3/4 md:w-2/4 rounded-lg p-3 shadow">
                <div class="flex flex-row justify-between">
                    <h3 class="font-bold text-xl"> 1. Open deur</h3>
                    <button data-toggle="toggle-rule-1" class="font-bold text-xl">&#43;</button>
                </div>
                <div id="toggle-rule-1" class="max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-in-out">
                    <div>
                        <p class="text-lg">
                            Iedereen kan, via deze website, reageren op een baan. Ongeacht achtergrond en ervaring. De wil om te werken, daar draait het om. Werkgevers zetten de deur dus open voor iedereen en werkzoekenden bepalen zelf of ze geschikt zijn voor de baan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-moss-light w-3/4 md:w-2/4 rounded-lg p-3 shadow">
                <div class="flex flex-row justify-between">
                    <h3 class="font-bold text-xl">2. Geen vragen stellen</h3>
                    <button data-toggle="toggle-rule-2" class="font-bold text-xl">&#43;</button>
                </div>
                <div id="toggle-rule-2"  class="max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-in-out">
                    <div>
                        <p class="text-lg">
                            Open Hiring biedt banen zonder sollicitatiegesprek. Maar het gaat verder: werkgevers stellen sowieso geen vragen aan werkzoekenden. Ook als iemand langskomt voor een informatiemoment gaan werkgevers niet in op zaken zoals achtergrond en het arbeidsverleden van de werkzoekende. Iemands verleden doet er niet toe. Wat iemand nu wil bijdragen, daar draait het om.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-moss-light w-3/4 md:w-2/4 rounded-lg p-3 shadow">
                <div class="flex flex-row justify-between">
                    <h3 class="font-bold text-xl">3. Open armen </h3>
                    <button data-toggle="toggle-rule-3" class="font-bold text-xl">&#43;</button>
                </div>
                <div id="toggle-rule-3"  class="max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-in-out">
                    <div>
                        <p class="text-lg">
                            Het hele bedrijf ontvangt elke nieuwe medewerker met open armen. Niet alleen de werkgever, maar het hele team is zonder oordelen. Zo krijgt een nieuwe collega een eerlijke kans. Het is belangrijk dat een bedrijf alle medewerkers goed informeert over Open Hiring en laat zien wat het is: een nieuwe manier om mensen de kans te geven op een betaalde baan. Op zo’n bedrijf kan iedereen trots zijn.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-moss-light w-3/4 md:w-2/4 rounded-lg p-3 shadow">
                <div class="flex flex-row justify-between">
                    <h3 class="font-bold text-xl">4. De juiste volgorde</h3>
                    <button data-toggle="toggle-rule-4" class="font-bold text-xl">&#43;</button>
                </div>
                <div id="toggle-rule-4"  class="max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-in-out">
                    <div>
                        <p class="text-lg">
                            De volgorde van inschrijving op een baan is heilig. Bij aanmelding zien werkzoekenden meteen op welke plek op de wachtlijst ze staan. Werkgevers nemen als eerste contact op met degene die bovenaan staat en bieden hem/haar de baan aan. Pas als iemand afziet van de baan, niet reageert op een uitnodiging, of als er weer een nieuwe werkplek vrijkomt, benadert een werkgever de volgende werkzoekende op de lijst.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-moss-light w-3/4 md:w-2/4 rounded-lg p-3 shadow">
                <div class="flex flex-row justify-between">
                    <h3 class="font-bold text-xl">5. Een 'gewoon' contract </h3>
                    <button data-toggle="toggle-rule-5" class="font-bold text-xl">&#43;</button>
                </div>
                <div id="toggle-rule-5"  class="max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-in-out">
                    <div>
                        <p class="text-lg">
                            Werkgevers bieden werknemers die via Open Hiring worden aangenomen een contract dat gangbaar is binnen het bedrijf. Werknemers krijgen ook vanaf dag één gewoon betaald. Het doel is om uiteindelijk, bij goed presteren, een vast contract te kunnen bieden. Net als elke andere werknemer dus.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-moss-light w-3/4 md:w-2/4 rounded-lg p-3 shadow">
                <div class="flex flex-row justify-between">
                    <h3 class="font-bold text-xl">6. Iedereen dezelfde behandeling</h3>
                    <button data-toggle="toggle-rule-6" class="font-bold text-xl">&#43;</button>
                </div>
                <div id="toggle-rule-6"  class="max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-in-out">
                    <div>
                        <p class="text-lg">
                            Alle werknemers binnen het bedrijf krijgen een gelijke behandeling. Of je nu via Open Hiring binnenkomt of op een andere manier. Dat betekent dat werknemers allemaal dezelfde kans krijgen om zich te bewijzen, maar zich ook allemaal aan dezelfde regels en afspraken moeten houden. Blijkt een werknemer tijdens het dienstverband niet aan de eisen te voldoen, of past de baan toch niet helemaal? Dan kun je als werkgever ook weer afscheid nemen van iemand, met het idee dat de werknemer ergens anders beter op zijn/haar plek is.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-moss-light w-3/4 md:w-2/4 rounded-lg p-3 shadow">
                <div class="flex flex-row justify-between">
                    <h3 class="font-bold text-xl">7. Aandacht voor iedereen</h3>
                    <button data-toggle="toggle-rule-7" class="font-bold text-xl">&#43;</button>
                </div>
                <div id="toggle-rule-7"  class="max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-in-out">
                    <div>
                        <p class="text-lg p-">
                            De focus ligt op werk. Maar er is ook aandacht voor persoonlijke omstandigheden die het goed presteren op de werkvloer in de weg staan. Iedereen loopt wel eens ergens tegenaan. Ook dan ben je er voor elkaar en zoek je samen naar een oplossing.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-moss-light w-3/4 md:w-2/4 rounded-lg p-3 shadow">
                <div class="flex flex-row justify-between">
                    <h3 class="font-bold text-xl">8. Ontwikkelperspectief</h3>
                    <button data-toggle="toggle-rule-8" class="font-bold text-xl">&#43;</button>
                </div>
                <div id="toggle-rule-8"  class="max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-in-out">
                    <div>
                        <p class="text-lg">
                            Ontwikkeling van medewerkers is belangrijk binnen Open Hiring. Zowel op persoonlijk vlak als binnen het vakgebied. Werkgevers bieden werknemers de ondersteuning die ze nodig hebben én mogelijkheden om door te stromen naar andere functies, binnen het bedrijf of daarbuiten. De werknemer maakt daarin wel zijn of haar eigen keuzes.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>


</x-layout>
