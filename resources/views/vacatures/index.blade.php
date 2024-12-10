@vite(['resources/js/app.js', 'resources/css/app.css'])

<x-layout>
    <body class="bg-cream">
        <div class="container mx-auto py-12">
            <h1 class="text-4xl font-bold text-center mb-6">Vacatures</h1>
            <div class="flex flex-col md:flex-row md:justify-between">
                <form action="{{ route('vacatures.filter') }}" method="post" class="md:w-1/2 mb-6 md:mb-0">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label for="search" class="block text-sm font-medium text-gray-700">Zoeken</label>
                        <input type="text" name="search" id="search" value="{{ $previousSearch->search }}" class="mt-1 px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 w-full">
                   </div>
                    <div class="mb-4">
                        <label for="uren" class="block text-sm font-medium text-gray-700">Uren</label>
                        <select name="uren" id="uren" class="mt-1 px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 w-full">
                            <option value="" disabled selected>Kies aantal uur</option>
                            <option value="0">0-10</option>
                            <option value="10">10-20</option>
                            <option value="20">20-30</option>
                            <option value="30">30-40</option>
                            <option value="40">40+</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="salaris" class="block text-sm font-medium text-gray-700">Salaris</label>
                        <select name="salaris" id="salaris" class="mt-1 px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 w-full">
                            <option value="" disabled selected>Kies een salaris</option>
                            <option value="1">0-500</option>
                            <option value="2">500-1000</option>
                            <option value="3">1100-1500</option>
                            <option value="4">1600-2000</option>
                            <option value="5">2100-2500</option>
                            <option value="6">2600-3000</option>
                            <option value="7">3100+</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="sort" class="block text-sm font-medium text-gray-700">Sorteren</label>
                        <select name="sort" id="sort" class="mt-1 px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 w-full">
                           <option value="newest" {{ $previousSearch->sort === 'newest' ? 'selected' : '' }}>Meest recent</option>
                            <option value="oldest" {{ $previousSearch->sort === 'oldest' ? 'selected' : '' }}>Minst recent</option>
                            <option value="highest" {{ $previousSearch->sort === 'highest' ? 'selected' : '' }}>Salaris Hoogst-Minst</option>
                            <option value="lowest" {{ $previousSearch->sort === 'lowest' ? 'selected' : '' }}>Salaris Minst-Hoogst</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="demands" class="block text-sm font-medium text-gray-700">Eisen</label>
                        <select name="demands[]" id="demands" multiple class="mt-1 px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 w-full">
                            <option disabled selected>Mogelijke eisen</option>
                            @foreach ($demands as $demand)
                                <option value="{{ $demand->id }}">{{ $demand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-violet-light text-white py-2 rounded-md hover:bg-violet-dark">Zoeken</button>
                </form>
                <a href="{{ route('vacatures.create') }}" id="create-vacature-link" class="mt-6 md:mt-0 md:ml-6 inline-block bg-yellow text-black py-2 px-4 rounded-md hover:bg-violet-light">Maak een vacature aan</a>
            </div>
            <h2 class="text-2xl font-semibold mt-8">Vacatures</h2>
            @if ($vacatures->isEmpty())
                <p class="mt-4">Geen vacatures gevonden</p>
            @else
                <ul class="mt-4 space-y-4">
                    @foreach ($vacatures as $vacature)
                    @if($vacature->status == 1)
                        <li class="border p-4 rounded-md shadow-md bg-moss-light">
                            <h3 class="text-xl font-bold">{{ $vacature->function }}</h3>
                            <p>Bedrijf: {{ $vacature->company->name }}</p>
                            <p>Functie: {{ $vacature->function }}</p>
                            <p>Maand Salaris: &euro; {{ number_format($vacature->salary, 2, ',', '.') }}</p>
                            <p>Locatie: {{ $vacature->location }}</p>
                            <p>Tijdsduur: {{ $vacature->time_id ? 'Fulltime' : 'Parttime' }}</p>
                            <p>Omschrijving: {{ Str::limit($vacature->description, 100) }}</p>
                            <p>Dagen:
                                @php
                                    $daysArray = json_decode($vacature->days, true);
                                @endphp
                                @if (is_null($daysArray) || empty($daysArray))
                                    Geen dagen beschikbaar
                                @else
                                    {{ implode(', ', $daysArray) }}
                                @endif
                            </p>
                            <img src="{{ $vacature->image }}" alt="Bedrijfs foto" class="mt-2 rounded-md">
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
                                    <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600" onclick="return confirm('Weet je zeker dat je deze vacature wilt verwijderen?');">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endif
                    @endforeach
                </ul>
            @endif
        </div>
    </body>
</x-layout>
