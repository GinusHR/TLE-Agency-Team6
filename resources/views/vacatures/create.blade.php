@vite(['resources/css/app.css', 'resources/js/app.js'])

<form action="{{ route('vacatures.store') }}" method="POST" class="bg-cream p-8-plus rounded-lg shadow-custom-light">
    @csrf
    <h1 class="text-2.5xl font-bold text-moss-dark mb-6">Nieuwe vacature</h1>

    <!-- Grid Layout for Two-Column Fields -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Positie Titel -->
        <div>
            <label for="function" class="block text-moss-dark font-medium mb-1">Positie Titel *</label>
            <input type="text" id="function" name="function"
                   class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                   placeholder="Voer de Titel van de positie in" required>
        </div>

        <!-- Full- of Parttime -->
        <div>
            <label for="time_id" class="block text-moss-dark font-medium mb-1">Full- of Parttime *</label>
            <select id="time_id" name="time_id"
                    class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none" required>
                <option value="" disabled selected>Kies een Tijdsduur</option>
                <option value="0">Parttime</option>
                <option value="1">Fulltime</option>
            </select>
        </div>

        <!-- Uren -->
        <div>
            <label for="workhours" class="block text-moss-dark font-medium mb-1">Uren *</label>
            <input type="number" id="workhours" name="workhours"
                   class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                   placeholder="Voer de uren per week in" required>
        </div>

        <!-- Maandloon -->
        <div>
            <label for="salary" class="block text-moss-dark font-medium mb-1">Maandloon *</label>
            <input type="number" id="salary" name="salary"
                   class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                   placeholder="Voer maandloon in" required>
        </div>

        <!-- Minimaal Opleidingsniveau -->
        <div>
            <label for="education" class="block text-moss-dark font-medium mb-1">Minimaal Opleidingsniveau *</label>
            <select id="education" name="education"
                    class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none" required>
                <option value="" disabled selected>Kies een Opleidingsniveau</option>
                <option value="NVT">N.V.T.</option>
                <option value="Highschool">Middelbareschool</option>
                <option value="MBO">MBO</option>
                <option value="HBO">HBO</option>
                <option value="University">Universitair</option>
            </select>
        </div>

        <!-- Op Locatie of Op Afstand -->
        <div>
            <label for="place" class="block text-moss-dark font-medium mb-1">Op Locatie of Op Afstand *</label>
            <select id="place" name="place"
                    class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none" required>
                <option value="" disabled selected>Kies een Locatie</option>
                <option value="1">Op Locatie</option>
                <option value="2">Hybride</option>
                <option value="3">Op Afstand</option>
            </select>
        </div>

        <!-- Locatie van het Werk -->
        <div>
            <label for="location" class="block text-moss-dark font-medium mb-1">Locatie van het Werk</label>
            <input type="text" id="location" name="location"
                   class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                   placeholder="Rotterdam, Utrecht...">
        </div>

        <!-- Dagen -->
        <div>
            <label class="block text-moss-dark font-medium mb-1">Dagen</label>
            <div class="flex flex-wrap gap-2">
                @foreach(['Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za', 'Zo'] as $day)
                    <div class="flex items-center">
                        <input type="checkbox" id="{{ strtolower($day) }}" name="days[]" value="{{ $day }}"
                               class="peer hidden">
                        <label for="{{ strtolower($day) }}"
                               class="flex items-center justify-center w-28 h-14 bg-unchecked-gray text-white font-bold rounded-lg cursor-pointer peer-checked:bg-moss-light peer-checked:text-black">
                            {{ $day }}
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
            <label for="description" class="block text-moss-dark font-medium mb-1">Algemene Omschrijving *</label>
            <textarea id="description" name="description"
                      class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                      placeholder="Voer een omschrijving in" rows="4" required></textarea>
        </div>

        <!-- Bedrijf ID -->
        <div class="mb-4">
            <label for="company_id" class="block text-moss-dark font-medium mb-1">Bedrijf ID *</label>
            <input type="number" id="company_id" name="company_id"
                   class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                   placeholder="Voer het bedrijf ID in" required>
        </div>

        <!-- Extra Informatie Nodig -->
        <div class="mb-4">
            <label for="secondary_info_needed" class="block text-moss-dark font-medium mb-1">Extra informatie nodig? *</label>
            <select id="secondary_info_needed" name="secondary_info_needed"
                    class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none" required>
                <option value="" disabled selected>Kies een optie</option>
                <option value="0">Nee</option>
                <option value="1">Ja</option>
            </select>
        </div>

        <!-- Status -->
        <div class="mb-6">
            <label for="status" class="block text-moss-dark font-medium mb-1">Status *</label>
            <select id="status" name="status"
                    class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none" required>
                <option value="" disabled selected>Kies een Status</option>
                <option value="0">Inactief</option>
                <option value="1">Actief</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-violet-light text-white font-medium rounded-lg shadow-custom-dark hover:bg-violet-dark focus:ring-2 focus:ring-violet-dark py-3">
            Vacature previewen
        </button>
    </div>
</form>
