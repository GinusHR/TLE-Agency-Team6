<body>
<h1>Welkom op het Dashboard, {{ Auth::guard('company')->user()->name }}</h1>
<p>Hier kun je je bedrijfsinformatie beheren en andere acties uitvoeren.</p>

<ul>
    @foreach($vacatures as $vacature)
        <li>
            <p>{{$vacature->function}}</p>
            <p>{{$vacature->location}}</p>
            <button><a href="{{route('vacatures.edit', $vacature->id)}}">Pas aan</a></button>
        </li>
    @endforeach
</ul>

<ul>
    <li><a href="{{ route('company.profile') }}">Profiel beheren</a></li>
    <li><a href="{{ route('company.logout') }}">Uitloggen</a></li>
</ul>
</body>
