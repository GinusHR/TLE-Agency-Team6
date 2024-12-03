<h1>Vacatures index</h1>

<a href="{{ route('vacatures.create') }}" id="create-vacature-link">Maak een vacature aan</a>

<h2>Vacatures</h2>
@if($vacatures->isEmpty())
    <p>Geen vacatures gevonden</p>
@else
    <ul>
        @foreach($vacatures as $vacature)
            <li>
                <a href="{{ route('vacatures.show', $vacature->id) }}">
                    <h3>{{ $vacature->function }}</h3>
                    <p>Company: {{ $vacature->company_id }}</p>
                    <p>Salary: {{ $vacature->salary }}</p>
                    <p>Location: {{ $vacature->location }}</p>
                    <p>Description: {{ Str::limit($vacature->description, 100) }}</p> <!-- Display a summary of the description -->
                </a>
            </li>
        @endforeach
    </ul>
@endif
