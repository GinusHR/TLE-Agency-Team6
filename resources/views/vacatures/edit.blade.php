<h1>Bewerk Vacature voor de positie: {{ $vacature->function }}</h1>

<form action="{{route('vacatures.update', $vacature->id) }}" method="POST">
    @csrf
@method('PUT')

    <div>
        <label for="function">Positie Titel</label>
        <input type="text" id="function" name="function" placeholder="Voer de Titel van de positie in" value="{{ old('function', $vacature->function) }}" required>
    </div><br>

    <div>
        <label for="time_id">Full- of Parttime</label>
        <select id="time_id" name="time_id" required>
            <option value="" disabled>Kies een Tijdsduur</option>
            <option value="0" {{ old('time_id', $vacature->time_id) == 0 ? 'selected' : '' }}>Parttime</option>
            <option value="1" {{ old('time_id', $vacature->time_id) == 1 ? 'selected' : '' }}>Fulltime</option>
        </select>
    </div><br>

    <div>
        <label for="workhours">Uren</label>
        <input type="number" id="workhours" name="workhours" placeholder="Voer de uren per week in" value="{{ old('workhours', $vacature->workhours) }}" required>
    </div><br>

    <div>
        <label for="salary">Maandloon</label>
        <input type="number" id="salary" name="salary" placeholder="Voer maandloon in" value="{{ old('salary', $vacature->salary) }}" required>
    </div><br>

    <div>
        <label for="education">Minimaal Opleidingsniveau</label>
        <select id="education" name="education" required>
            <option value="" disabled>Kies een Opleidingsniveau</option>
            <option value="NVT" {{ old('education', $vacature->education) == 'NVT' ? 'selected' : '' }}>N.V.T.</option>
            <option value="Highschool" {{ old('education', $vacature->education) == 'Highschool' ? 'selected' : '' }}>Middelbareschool</option>
            <option value="MBO" {{ old('education', $vacature->education) == 'MBO' ? 'selected' : '' }}>MBO</option>
            <option value="HBO" {{ old('education', $vacature->education) == 'HBO' ? 'selected' : '' }}>HBO</option>
            <option value="University" {{ old('education', $vacature->education) == 'University' ? 'selected' : '' }}>Universitair</option>
        </select>
    </div><br>

    <div>
        <label for="days">Dagen</label>
        <div class="days-selection">
            @php
                // Decode the JSON string into an array
                $selectedDays = is_string($vacature->days) ? json_decode($vacature->days, true) : [];
            @endphp

            @foreach(['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag'] as $day)
                <div class="day-box">
                    <input type="checkbox" id="{{ strtolower($day) }}" name="days[]" value="{{ $day }}" {{ in_array($day, old('days', $selectedDays)) ? 'checked' : '' }}>
                    <label for="{{ strtolower($day) }}">{{ $day }}</label>
                </div>
            @endforeach
        </div>
    </div><br>

    <div>
        <label for="place">Op Locatie of Op Afstand</label>
        <select id="place" name="place" required>
            <option value="" disabled>Kies een Locatie</option>
            <option value="1" {{ old('place', $vacature->place) == 1 ? 'selected' : '' }}>Op Locatie</option>
            <option value="2" {{ old('place', $vacature->place) == 2 ? 'selected' : '' }}>Hybride</option>
            <option value="3" {{ old('place', $vacature->place) == 3 ? 'selected' : '' }}>Op Afstand</option>
        </select>
    </div><br>

    <div>
        <label for="location">Locatie van het werk</label>
        <input type="text" id="location" name="location" placeholder="Rotterdam, Utrecht..." value="{{ old('location', $vacature->location) }}">
    </div><br>

    <div>
        <label for="description">Algemene Omschrijving</label>
        <input type="text" id="description" name="description" placeholder="Voer een omschrijving in" value="{{ old('description', $vacature->description) }}" required>
    </div><br>

    <div>
        <label for="company_id">Bedrijf ID</label>
        <input type="number" id="company_id" name="company_id" placeholder="Voer het bedrijf ID in" value="{{ old('company_id', $vacature->company_id) }}" required>
    </div><br>

    <div>
        <label for="secondary_info_needed">Extra informatie nodig?</label>
        <select id="secondary_info_needed" name="secondary_info_needed" required>
            <option value="" disabled>Kies een optie</option>
            <option value="0" {{ old('secondary_info_needed', $vacature->secondary_info_needed) == 0 ? 'selected' : '' }}>Nee</option>
            <option value="1" {{ old('secondary_info_needed', $vacature->secondary_info_needed) == 1 ? 'selected' : '' }}>Ja</option>
        </select>
    </div><br>

    <div>
        <label for="status">Status</label>
        <select id="status" name="status" required>
            <option value="" disabled>Kies een Status</option>
            <option value="0" {{ old('status', $vacature->status) == 0 ? 'selected' : '' }}>Inactief</option>
            <option value="1" {{ old('status', $vacature->status) == 1 ? 'selected' : '' }}>Actief</option>
        </select>
    </div><br>

    <button type="submit">Vacature bijwerken</button>

</form>
