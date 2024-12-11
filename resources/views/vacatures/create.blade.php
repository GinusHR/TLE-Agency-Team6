@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="bg-cream min-h-screen flex items-center justify-center">
    <form action="{{ route('vacatures.store') }}" method="POST" class="bg-cream p-8-plus rounded-lg shadow-custom-light mx-auto max-w-5xl">
        @csrf
        <h1 class="text-2.5xl font-bold text-moss-dark mb-6">Nieuwe vacature</h1>

        <!-- Grid Layout for Two-Column Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Positie Titel -->
            <div>
                <label for="function" class="block text-moss-dark font-bold text-xl mb-1">Positie Titel <span class="text-red-500">*</span></label>
                <input type="text" id="function" name="function"
                       class="w-full p-4 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none placeholder-black"
                       placeholder="Voer de Titel van de positie in" required>
            </div>

            <!-- Full- of Parttime -->
            <div>
                <label for="time_id" class="block text-moss-dark font-bold text-xl mb-1">Full- of Parttime <span class="text-red-500">*</span></label>
                <select id="time_id" name="time_id"
                        class="w-full p-4 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none" required>
                    <option value="" disabled selected>Kies een Tijdsduur</option>
                    <option value="0">Parttime</option>
                    <option value="1">Fulltime</option>
                </select>
            </div>

            <!-- Uren -->
            <div>
                <label for="workhours" class="block text-moss-dark font-bold text-xl mb-1">Uren <span class="text-red-500">*</span></label>
                <input type="number" id="workhours" name="workhours"
                       class="w-full p-4 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none placeholder-black"
                       placeholder="Voer de uren per week in" required>
            </div>

            <!-- Maandloon -->
            <div>
                <label for="salary" class="block text-moss-dark font-bold text-xl mb-1">Maandloon <span class="text-red-500">*</span></label>
                <input type="number" id="salary" name="salary"
                       class="w-full p-4 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none placeholder-black"
                       placeholder="Voer maandloon in" required>
            </div>

            <!-- Minimaal Opleidingsniveau -->
            <div>
                <label for="education" class="block text-moss-dark font-bold text-xl mb-1">Minimaal Opleidingsniveau <span class="text-red-500">*</span></label>
                <select id="education" name="education"
                        class="w-full p-4 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none" required>
                    <option value="" disabled selected>Kies een Opleidingsniveau</option>
                    <option value="1">N.V.T.</option>
                    <option value="2">Middelbareschool</option>
                    <option value="3">MBO</option>
                    <option value="4">HBO</option>
                    <option value="5">Universitair</option>
                </select>
            </div>

            <!-- Op Locatie of Op Afstand -->
            <div>
                <label for="place" class="block text-moss-dark font-bold text-xl mb-1">Op Locatie of Op Afstand <span class="text-red-500">*</span></label>
                <select id="place" name="place"
                        class="w-full p-4 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none" required>
                    <option value="" disabled selected>Kies een Locatie</option>
                    <option value="1">Op Locatie</option>
                    <option value="2">Hybride</option>
                    <option value="3">Op Afstand</option>
                </select>
            </div>

            <!-- Locatie van het Werk -->
            <div>
                <label for="location" class="block text-moss-dark font-bold text-xl mb-1">Locatie van het Werk</label>
                <input type="text" id="location" name="location"
                       class="w-full p-4 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none placeholder-black"
                       placeholder="Rotterdam, Utrecht...">
            </div>

            <!-- Dagen -->
            <div>
                <label class="block text-moss-dark font-bold text-xl mb-1">Dagen</label>
                <div class="grid grid-cols-7 gap-2 w-full"> <!-- Use grid for responsive behavior -->
                    @foreach(['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag'] as $day)
                        <div class="flex items-center justify-center"> <!-- Center the buttons -->
                            <input type="checkbox" id="{{ strtolower($day) }}" name="days[]" value="{{ $day }}"
                                   class="peer hidden">
                            <label for="{{ strtolower($day) }}"
                                   class="h-14 w-20 bg-moss-light text-moss-dark font-bold rounded-lg cursor-pointer flex items-center justify-center
                       peer-checked:bg-violet-light peer-checked:text-white">
                                {{ substr($day, 0, 2) }} <!-- Display only the first two letters -->
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Single Column Layout for Remaining Fields -->
        <div class="mt-6">
            <!-- Algemene Omschrijving -->
            <div class="mb-4">
                <label for="description" class="block text-moss-dark font-bold text-xl mb-1">Algemene Omschrijving <span class="text-red-500">*</span></label>
                <textarea id="description" name="description"
                          class="w-full p-4 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none placeholder-black"
                          placeholder="Voer een omschrijving in" rows="4" required></textarea>
            </div>

            <!-- Bedrijf ID -->
            <div class="mb-4">
                <label for="company_id" class="block text-moss-dark font-bold text-xl mb-1">Bedrijf ID <span class="text-red-500">*</span></label>
                <input type="number" id="company_id" name="company_id"
                       class="w-full p-4 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none placeholder-black"
                       placeholder="Voer het bedrijf ID in" required>
            </div>

            <!-- Extra Informatie Nodig (Hidden) -->
            <input type="hidden" id="secondary_info_needed" name="secondary_info_needed" value="0"> <!-- Preset to 0 -->

            <!-- Status (Hidden) -->
            <input type="hidden" id="status" name="status" value="0"> <!-- Preset to 0 -->

            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-violet-light text-white font-bold rounded-lg shadow-custom-dark hover:bg-violet-dark focus:ring-2 focus:ring-violet-dark py-3 px-8">
                    Vacature previewen
                </button>
            </div>
        </div>
    </form>
</div>
