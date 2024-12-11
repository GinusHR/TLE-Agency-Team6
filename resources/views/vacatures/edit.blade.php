@vite(['resources/css/app.css', 'resources/js/app.js'])

<form action="{{ route('vacatures.update', $vacature->id) }}" method="POST" class="bg-cream p-8-plus rounded-lg shadow-custom-light">
    @csrf
    @method('PUT')
    <h1 class="text-2.5xl font-bold text-moss-dark mb-6">Bewerk Vacature voor de positie: {{ $vacature->function }}</h1>

    <!-- Grid Layout for Two-Column Fields -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="function" class="block text-moss-dark font-medium mb-1">Positie Titel *</label>
            <input type="text" id="function" name="function" value="{{ old('function', $vacature->function) }}"
                   class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                   placeholder="Voer de Titel van de positie in" required>
        </div>

        <div>
            <label for="time_id" class="block text-moss-dark font-medium mb-1">Full- of Parttime *</label>
            <select id="time_id" name="time_id"
                    class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none" required>
                <option value="" disabled>Kies een Tijdsduur</option>
                <option value="0" {{ old('time_id', $vacature->time_id) == 0 ? 'selected' : '' }}>Parttime</option>
                <option value="1" {{ old('time_id', $vacature->time_id) == 1 ? 'selected' : '' }}>Fulltime</option>
            </select>
        </div>

        <div>
            <label for="workhours" class="block text-moss-dark font-medium mb-1">Uren *</label>
            <input type="number" id="workhours" name="workhours" value="{{ old('workhours', $vacature->workhours) }}"
                   class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                   placeholder="Voer de uren per week in" required>
        </div>

        <div>
            <label for="salary" class="block text-moss-dark font-medium mb-1">Maandloon *</label>
            <input type="number" id="salary" name="salary" value="{{ old('salary', $vacature->salary) }}"
                   class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                   placeholder="Voer maandloon in" required>
        </div>

        <div>
            <label for="education" class="block text-moss-dark font-medium mb-1">Minimaal Opleidingsniveau *</label>
            <select id="education" name="education"
                    class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none" required>
                <option value="" disabled>Kies een Opleidingsniveau</option>
                <option value="1" {{ old('education', $vacature->education) == 1 ? 'selected' : '' }}>N.V.T.</option>
                <option value="2" {{ old('education', $vacature->education) == 2 ? 'selected' : '' }}>Middelbareschool</option>
                <option value="3" {{ old('education', $vacature->education) == 3 ? 'selected' : '' }}>MBO</option>
                <option value="4" {{ old('education', $vacature->education) == 4 ? 'selected' : '' }}>HBO</option>
                <option value="5" {{ old('education', $vacature->education) == 5 ? 'selected' : '' }}>Universitair</option>
            </select>
        </div>

        <div>
            <label for="place" class="block text-moss-dark font-medium mb-1">Op Locatie of Op Afstand *</label>
            <select id="place" name="place"
                    class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none" required>
                <option value="" disabled>Kies een Locatie</option>
                <option value="1" {{ old('place', $vacature->place) == 1 ? 'selected' : '' }}>Op Locatie</option>
                <option value="2" {{ old('place', $vacature->place) == 2 ? 'selected' : '' }}>Hybride</option>
                <option value="3" {{ old('place', $vacature->place) == 3 ? 'selected' : '' }}>Op Afstand</option>
            </select>
        </div>

        <div>
            <label for="location" class="block text-moss-dark font-medium mb-1">Locatie van het Werk</label>
            <input type="text" id="location" name="location" value="{{ old('location', $vacature->location) }}"
                   class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                   placeholder="Rotterdam, Utrecht...">
        </div>

        <div>
            <label class="block text-moss-dark font-medium mb-1">Dagen</label>
            <div class="flex flex-wrap gap-2">
                @php
                    // Decode the JSON string into an array
                    $selectedDays = is_string($vacature->days) ? json_decode($vacature->days, true) : [];
                @endphp
                @foreach(['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag'] as $day)
                    <div class="flex items-center">
                        <input type="checkbox" id="{{ strtolower($day) }}" name="days[]" value="{{ $day }}"
                               {{ in_array($day, old('days', $selectedDays)) ? 'checked' : '' }}
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
        <div class="mb-4">
            <label for="description" class="block text-moss-dark font-medium mb-1">Algemene Omschrijving *</label>
            <textarea id="description" name="description"
                      class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                      placeholder="Voer een omschrijving in" rows="4" required>{{ old('description', $vacature->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="company_id" class="block text-moss-dark font-medium mb-1">Bedrijf ID *</label>
            <input type="number" id="company_id" name="company_id" value="{{ old('company_id', $vacature->company_id) }}"
                   class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                   placeholder="Voer het bedrijf ID in" required>
        </div>

        <input type="hidden" id="secondary_info_needed" name="secondary_info_needed" value="0"> <!-- Preset to 0 -->

        <input type="hidden" id="status" name="status" value="1"> <!-- Preset to 0 -->

        <!-- Submit Button -->
        <div class="text-center mt-8">
            <button type="submit" class="w-full bg-violet-light text-white font-medium rounded-lg shadow-custom-dark hover:bg-violet-dark focus:ring-2 focus:ring-violet-dark py-3">
                Opslaan
            </button>
        </div>
    </div>

</form>
