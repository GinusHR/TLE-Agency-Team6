@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('vacatures.store') }}" method="POST">
    @csrf
    <div>
        <label for="function">Positie Titel</label>
        <input type="text" id="function" name="function" placeholder="Voer de Titel van de positie in" required>
    </div><br>

    <div>
        <label for="time_id">Full- of Parttime</label>
        <select id="time_id" name="time_id" required>
            <option value="" disabled selected>Kies een Tijdsduur</option>
            <option value="0">Parttime</option>
            <option value="1">Fulltime</option>
        </select>
    </div><br>

    <div>
        <label for="workhours">Uren</label>
        <input type="number" id="workhours" name="workhours" placeholder="Voer de uren per week in" required>
    </div><br>

    <div>
        <label for="salary">Maandloon</label>
        <input type="number" id="salary" name="salary" placeholder="Voer maandloon in" required>
    </div><br>

    <div>
        <label for="education">Minimaal Opleidingsniveau</label>
        <select id="education" name="education" required>
            <option value="" disabled selected>Kies een Opleidingsniveau</option>
            <option value="NVT">N.V.T.</option>
            <option value="Highschool">Middelbareschool</option>
            <option value="MBO">MBO</option>
            <option value="HBO">HBO</option>
            <option value="University">Universitair</option>
        </select>
    </div><br>

    <div>
        <label for="days">Dagen</label>
        <div class="days-selection">
            @foreach(['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag'] as $day)
                <div class="day-box">
                    <input type="checkbox" id="{{ strtolower($day) }}" name="days[]" value="{{ strtolower($day) }}">
                    <label for="{{ strtolower($day) }}">{{ $day }}</label>
                </div>
            @endforeach
        </div>
    </div><br>

    <div>
        <label for="place">Op Locatie of Op Afstand</label>
        <select id="place" name="place" required>
            <option value="" disabled selected>Kies een Locatie</option>
            <option value="1">Op Locatie</option>
            <option value="2">Hybride</option>
            <option value="3">Op Afstand</option>
        </select>
    </div><br>

    <div>
        <label for="location">Locatie van het werk</label>
        <input type="text" id="location" name="location" placeholder="Rotterdam, Utrecht...">
    </div><br>

    <div>
        <label for="description">Algemene Omschrijving</label>
        <input type="text" id="description" name="description" placeholder="Voer een omschrijving in" required>
    </div><br>

    <div>
        <label for="company_id">Bedrijf ID</label>
        <input type="number" id="company_id" name="company_id" placeholder="Voer het bedrijf ID in" required>
    </div><br>

    <div>
        <label for="secondary_info_needed">Extra informatie nodig?</label>
        <select id="secondary_info_needed" name="secondary_info_needed" required>
            <option value="" disabled selected>Kies een optie</option>
            <option value="0">Nee</option>
            <option value="1">Ja</option>
        </select>
    </div><br>

    <div>
        <label for="status">Status</label>
        <select id="status" name="status" required>
            <option value="" disabled selected>Kies een Status</option>
            <option value="0">Inactief</option>
            <option value="1">Actief</option>
        </select>
    </div><br>

    <button type="submit">Create Vacature</button>
</form>
