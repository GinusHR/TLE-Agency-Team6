@vite(['resources/js/app.js', 'resources/css/app.css'])

<x-layout>
    <div class="bg-cream min-h-screen flex items-center justify-center text-moss-dark">
        <div class="bg-white max-w-4xl w-full rounded-lg shadow-lg p-8 border border-gray-300">
            <!-- Header -->
            <h1 class="text-3xl font-bold text-moss-dark text-center mb-8">
                {{ $vacature->company->name }}
            </h1>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-2 gap-8 items-start">
                <!-- Left Column -->
                <div class="space-y-4">
                    <div>
                        <h2 class="text-xl font-bold">Positie</h2> <!-- Removed * -->
                        <p class="bg-moss-light text-moss-dark rounded-md p-2 h-10 flex items-center">{{ $vacature->function }}</p>
                    </div>

                    <div>
                        <h2 class="text-xl font-bold">Part of Fulltime</h2> <!-- Removed * -->
                        <p class="bg-moss-light text-moss-dark rounded-md p-2 h-10 flex items-center">
                            {{ $vacature->time_id == 0 ? 'Parttime' : 'Fulltime' }}
                        </p>
                    </div>

                    <div>
                        <h2 class="text-xl font-bold">Uren per week</h2> <!-- Removed * -->
                        <p class="bg-moss-light text-moss-dark rounded-md p-2 h-10 flex items-center">{{ $vacature->workhours }}</p>
                    </div>

                    <div>
                        <h2 class="text-xl font-bold">Maand Salaris</h2> <!-- Removed * -->
                        <p class="bg-moss-light text-moss-dark rounded-md p-2 h-10 flex items-center">&euro; {{ number_format($vacature->salary, 2, ',', '.') }}</p>
                    </div>

                    <div>
                        <h2 class="text-xl font-bold">Minimaal Opleidingsniveau</h2> <!-- Removed * -->
                        <p class="bg-moss-light text-moss-dark rounded-md p-2 h-10 flex items-center">
                            @switch($vacature->education)
                                @case(1)
                                    N.V.T.
                                    @break
                                @case(2)
                                    Middelbare School
                                    @break
                                @case(3)
                                    MBO
                                    @break
                                @case(4)
                                    HBO
                                    @break
                                @case(5)
                                    Universitair
                                    @break
                                @default
                                    Onbekend
                            @endswitch
                        </p>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-4">
                    <div>
                        <h2 class="text-xl font-bold">Dagen</h2>
                        <div class="grid grid-cols-7 gap-2">
                            @php
                                $days = json_decode($vacature->days, true);
                                // Mapping of full day names to their abbreviations
                                $dayAbbreviations = [
                                    'Maandag' => 'Ma',
                                    'Dinsdag' => 'Di',
                                    'Woensdag' => 'Wo',
                                    'Donderdag' => 'Do',
                                    'Vrijdag' => 'Vr',
                                    'Zaterdag' => 'Za',
                                    'Zondag' => 'Zo',
                                ];
                            @endphp
                            @foreach($dayAbbreviations as $fullDay => $abbreviation)
                                <span class="h-10 px-3 py-2 rounded-md font-bold text-sm flex items-center justify-center
                {{ is_array($days) && in_array($fullDay, $days) ? 'bg-violet-light text-white' : 'bg-moss-light text-moss-dark' }}">
                {{ $abbreviation }} <!-- Display the abbreviation -->
            </span>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h2 class="text-xl font-bold">Op Locatie of Op Afstand</h2> <!-- Removed * -->
                        <p class="bg-moss-light text-moss-dark rounded-md p-2 h-10 flex items-center">
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
                        <h2 class="text-xl font-bold">Algemene omschrijving</h2> <!-- Removed * -->
                        <p class="bg-moss-light text-moss-dark rounded-md p-4 min-h-[13rem] max-h-[13rem] overflow-auto flex items-start">
                            {{ $vacature->description }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-8 mt-8">
                <!-- Edit Button -->
                <form action="{{ route('vacatures.edit', $vacature->id) }}" method="GET">
                    @csrf
                    <button type="submit"
                            class="bg-violet-light text-white font-medium px-8 py-3 rounded-lg shadow hover:bg-violet-dark">
                        Wijzigen
                    </button>
                </form>

                <!-- Publish Button -->
                <form action="{{ route('vacatures.publish', $vacature->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="bg-violet-light text-white font-medium px-8 py-3 rounded-lg shadow hover:bg-violet-dark">
                        Vacature publiceren
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
