<body>
<h1>Welkom op het Dashboard, {{ Auth::guard('company')->user()->name }}</h1>
@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif
<p>Hier kun je je bedrijfsinformatie beheren en andere acties uitvoeren.</p>

<ul>
    @foreach($vacatures as $vacature)
        <li>
            <p>{{$vacature->function}}</p>
            <p>{{$vacature->location}}</p>
            <p>Aantal applicanten: {{$vacature->applications->where('accepted',0)->count()}}</p>
            <button><a href="{{route('vacatures.edit', $vacature->id)}}">Pas aan</a></button>
        </li>
    @endforeach
</ul>

<ul>
    <li><a href="{{ route('company.profile') }}">Profiel beheren</a></li>
    <li>
        <form id="logout-form" action="{{ route('company.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Uitloggen
        </a>
    </li>
</ul>
</body>
