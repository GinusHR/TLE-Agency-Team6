@vite(['resources/js/app.js', 'resources/css/app.css'])

<x-layout>
    <div class="bg-cream min-h-screen text-moss-dark">
        <div class="bg-white max-w-4xl mx-auto mt-10 p-8 rounded-lg border border-gray-300">
            <h1 class="text-2.5xl font-bold text-center mb-6">Voorbeeld van Vacature</h1>

            <div class="space-y-4">
                <div>
                    <h2 class="font-medium">Positie Titel:</h2>
                    <p>{{ $vacature->function }}</p>
                </div>

                <div>
                    <h2 class="font-medium">Full- of Parttime:</h2>
                    <p>{{ $vacature->time_id == 0 ? 'Parttime' : 'Fulltime' }}</p>
                </div>

                <div>
                    <h2 class="font-medium">Uren per Week:</h2>
                    <p>{{ $vacature->workhours }}</p>
                </div>

                <div>
                    <h2 class="font-medium">Maandloon:</h2>
                    <p>&euro; {{ number_format($vacature->salary, 2, ',', '.') }}</p>
                </div>

                <div>
                    <h2 class="font-medium">Minimaal Opleidingsniveau:</h2>
                    <p>{{ $vacature->education }}</p>
                </div>

                <div>
                    <h2 class="font-medium">Locatie Type:</h2>
                    <p>
                        @if($vacature->place == 1)
                            Op Locatie
                        @elseif($vacature->place == 2)
                            Hybride
                        @else
                            Op Afstand
                        @endif
                    </p>
                </div>

                <div>
                    <h2 class="font-medium">Locatie:</h2>
                    <p>{{ $vacature->location }}</p>
                </div>

                <div>
                    <h2 class="font-medium">Beschikbare Dagen:</h2>
                    <p>
                        @php
                            $days = json_decode($vacature->days, true);
                        @endphp
                        {{ is_array($days) ? implode(', ', $days) : 'Niet beschikbaar' }}
                    </p>
                </div>


                <div>
                    <h2 class="font-medium">Algemene Omschrijving:</h2>
                    <p>{{ $vacature->description }}</p>
                </div>

                <div>
                    <h2 class="font-medium">Bedrijf ID:</h2>
                    <p>{{ $vacature->company_id }}</p>
                </div>
            </div>
            <div>
                <!-- Edit Form -->
                <form action="{{ route('vacatures.update', $vacature->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="1">
                    <input type="hidden" name="redirect_to_edit" value="1"> <!-- Indicates edit action -->
                    <button type="submit"
                            class="bg-moss-light text-white font-medium px-6 py-2 rounded-lg shadow hover:bg-moss-medium">
                        Bewerken
                    </button>
                </form>

                <!-- Publish Form -->
                <form action="{{ route('vacatures.publish', $vacature->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="bg-violet-light text-white font-medium px-6 py-2 rounded-lg shadow hover:bg-violet-dark">
                        Publiceren
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-layout>
