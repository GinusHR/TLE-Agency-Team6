<h1>Vacatures index</h1>

<form action="{{ route('vacatures.filter') }}" method="post">
    @csrf
    @method('PATCH')
    <div>
        <label for="search">Zoeken</label>
        <input type="text" name="search" id="search" value="{{ $previousSearch->search }}">
    </div>
    <div>
        <label for="uren">Uren</label>
        <select name="uren" id="uren">
            <option value="" disabled selected>Kies aantal uur</option>
            <option value="0">0-10</option>
            <option value="10">10-20</option>
            <option value="20">20-30</option>
            <option value="30">30-40</option>
            <option value="40">40+</option>
        </select>
    </div>
    <div>
        <label for="salaris">Salaris</label>
        <select name="salaris" id="salaris">
            <option value="" disabled selected>Kies een salaris</option>
            <option value="1">0-500 </option>
            <option value="2">500-1000 </option>
            <option value="3">1100-1500 </option>
            <option value="4">1600-2000 </option>
            <option value="5">2100-2500 </option>
            <option value="6">2600-3000</option>
            <option value="7">3100+</option>
        </select>
    </div>

    <div>
        <label for="sort">Sorteren</label>
        <select name="sort" id="sort">
            <option value="newest" {{ $previousSearch->sort === 'newest' ? 'selected' : '' }}>Meest recent</option>
            <option value="oldest" {{ $previousSearch->sort === 'oldest' ? 'selected' : '' }}>Minst recent</option>
            <option value="highest" {{ $previousSearch->sort === 'highest' ? 'selected' : '' }}>Salaris Hoogst-Minst
            </option>
            <option value="lowest" {{ $previousSearch->sort === 'lowest' ? 'selected' : '' }}>Salaris Minst-Hoogst
            </option>
        </select>
    </div>
    <div>
        <label for="demands">Eisen</label>
        <select name="demands[]" id="demands" multiple>
            <option disabled selected>Mogelijke eisen</option>
            @foreach ($demands as $demand)
                <option value="{{ $demand->name }}">{{ $demand->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit">Zoeken</button>
</form>

<a href="{{ route('vacatures.create') }}" id="create-vacature-link">Maak een vacature aan</a>

<h2>Vacatures</h2>
@if ($vacatures->isEmpty())
    <p>Geen vacatures gevonden</p>
@else
    <ul>
        @foreach ($vacatures as $vacature)
            <li>
                <h3>{{ $vacature->function }}</h3>
                <p>Bedrijf: {{ $vacature->company->name }}</p>
                <p>Functie: {{ $vacature->function }}</p>
                <p>Maand Salaris: {{ $vacature->salary }}</p>
                <p>Locatie: {{ $vacature->location }}</p>
                <p>Tijdsduur: {{ $vacature->time_id ? 'Fulltime' : 'Parttime' }}</p>
                <p>Omschrijving: {{ Str::limit($vacature->description, 100) }}</p>
                <p>Dagen:
                    @php
                        $daysArray = json_decode($vacature->days, true); // Decode JSON into an associative array
                    @endphp
                    @if (is_null($daysArray) || empty($daysArray))
                        Geen dagen beschikbaar
                    @else
                        {{ implode(', ', $daysArray) }} <!-- Join the array into a string -->
                    @endif
                </p>
                <img src="{{ $vacature->image }}" alt="Bedrijfs foto">
            </li>
            <button><a href="{{ route('vacatures.show', $vacature->id) }}">Detail</a></button>
            <button><a href="{{ route('vacatures.edit', $vacature->id) }}">Edit</a> </button>
        @endforeach
    </ul>
@endif
