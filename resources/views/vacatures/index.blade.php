<h1>Vacatures index</h1>

<a href="{{ route('vacatures.create') }}" id="create-vacature-link">Maak een vacature aan</a>

<h2>Vacatures</h2>
@if($vacatures->isEmpty())
    <p>Geen vacatures gevonden</p>
    @else
    <ul>
        @foreach($vacatures as $vacature)
        @if($vacature->is_active == 1)
            <li>
                <a href="{{ route('vacatures.show', $vacature->id) }}"></a>
            </li>
        @endif
        @endforeach
    </ul>
@endif
