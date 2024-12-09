<body>
    <h1>Welkom op het Dashboard, {{ Auth::guard('company')->user()->name }}</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <p>Hier kun je je bedrijfsinformatie beheren en andere acties uitvoeren.</p>

    <ul>
        @foreach ($vacatures as $vacature)
            <li>
                <p>
                    @if ($vacature->status)
                        Open:
                    @else
                        Closed:
                    @endif{{ $vacature->function }} - {{ $vacature->location }}
                </p>
                <p>Aantal applicanten: {{ $vacature->applications->where('accepted', 0)->count() }}</p>
                <p>Aantal aangenomen via vacature: {{ $vacature->applications->where('accepted', 1)->count() }}</p>
                <div class=" flex space-x-2 mt-4">
                    <button class="bg-violet-light text-white py-1 px-3 rounded-md hover:bg-violet-dark">
                        <a href="{{ route('vacatures.show', $vacature->id) }}">Detail</a>
                    </button>
                    <button class="bg-yellow text-black py-1 px-3 rounded-md hover:bg-violet-light">
                        <a href="{{ route('vacatures.edit', $vacature->id) }}">Edit</a>
                    </button>
                    <form action="{{ route('vacatures.destroy', $vacature->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600"
                            onclick="return confirm('Weet je zeker dat je deze vacature wilt verwijderen?');">Delete</button>
                    </form>
                    <form action="{{ route('company.toggleVisibility', $vacature->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 rounded-lg font-semibold transition-colors duration-300
                            {{ $vacature->status ? 'bg-amber-500 hover:bg-amber-600 text-white' : 'bg-purple-500 hover:bg-purple-600 text-white' }}">
                            {{ $vacature->status ? 'Close' : 'Open' }}
                        </button>
                    </form>
                </div>
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
