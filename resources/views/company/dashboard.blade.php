<x-layout>
    <h1 class="mb-5">Welkom op het Dashboard, {{ Auth::guard('company')->user()->name }}</h1>
    @if (session('success'))
        <p class="flex justify-center" style="color: green;">{{ session('success') }}</p>
    @endif
    <div class="flex flex-col justify-center items-center mx-auto max-w-md text-center p-6 bg-moss-light rounded-lg">
        <p class="mb-4 text-gray-700">Hier kun je je bedrijfsinformatie beheren en andere acties uitvoeren.</p>
        <a href="{{ route('vacatures.create') }}" id="create-vacature-link"
            class="bg-yellow text-black py-2 px-4 rounded-md hover:bg-violet-light hover:text-white">Maak een vacature
            aan</a>
        <ul class="mt-2 space-y-2">
            <li>
                <a href="{{ route('company.profile') }}"
                    class="block bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Profiel beheren</a>
            </li>
            <li>
                <form id="logout-form" action="{{ route('company.logout') }}" method="POST"
                    onsubmit="return confirm('Weet je zeker dat je wilt uitloggen?');" class="flex justify-center">
                    @csrf
                    <button type="submit"
                        class="block bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">Uitloggen</button>
                </form>
            </li>
        </ul>
    </div>

    <ul>
        @foreach ($vacatures as $vacature)
            <div class="pt-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-moss-light overflow-hidden shadow-sm sm:rounded-lg">
                        <h2 class="text-gray-600 text-2xl font-bold mr-4 p-4 pb-0">
                            @if ($vacature->status)
                                Open:
                            @else
                                Gesloten:
                            @endif
                            {{ $vacature->function }}
                            @if (isset($vacature->location))
                                - {{ $vacature->location }}
                            @endif
                        </h2>
                        <div class="p-6 text-gray-900 flex justify-between content-center">
                            <div>
                                <div class="flex items-start"> <!-- New wrapper to align button properly -->
                                    @if ($vacature->applications->where('accepted', 1)->count() > 0)
                                        <button id="toggleVacatureInvitations{{ $vacature->id }}Table"
                                            class="flex items-center text-gray-600 hover:text-gray-900 mr-4">
                                            <!-- Added margin-right -->
                                            <span id="toggleVacatureInvitations{{ $vacature->id }}Icon"
                                                class="mr-2">▲</span>
                                    @endif
                                    <span>
                                        Aantal aangenomen via vacature:
                                        {{ $vacature->applications->where('accepted', 1)->count() }}
                                    </span>
                                    @if ($vacature->applications->where('accepted', 1)->count() > 0)
                                        </button>
                                    @endif
                                </div>
                                <div class="flex items-start"> <!-- New wrapper to align button properly -->
                                    @if ($vacature->applications->where('accepted', 0)->count() > 0)
                                        <button id="toggleVacature{{ $vacature->id }}Table"
                                            class="flex items-center text-gray-600 hover:text-gray-900 mr-4">
                                            <!-- Added margin-right -->
                                            <span id="toggleVacature{{ $vacature->id }}Icon" class="mr-2">▲</span>
                                    @endif
                                    <span>
                                        Aantal applicanten:
                                        {{ $vacature->applications->where('accepted', 0)->count() }}
                                    </span>
                                    @if ($vacature->applications->where('accepted', 0)->count() > 0)
                                        </button>
                                    @endif
                                </div>
                            </div>
                            @if ($vacature->applications->where('accepted', 0)->count() > 0)
                                <div class="max-w-sm p-3 border border-gray-300 rounded-md bg-gray-50 shadow-sm">
                                    <span class="block text-sm font-semibold text-center mb-3">Mensen uitnodigen om te
                                        komen
                                        werken</span>
                                    <form action="{{ route('company.acceptApplicants', $vacature->id) }}"
                                        method="POST" class="space-y-3">
                                        @csrf
                                        <div class="flex flex-wrap items-center space-x-2">
                                            <select name="acceptApplicants" id="acceptApplicants"
                                                class="flex-1 border border-gray-300 rounded-md text-sm">
                                                <option value="">Aantal mensen</option>
                                                @php
                                                    $counter = 0;
                                                @endphp
                                                @foreach ($vacature->applications->where('accepted', 0) as $application)
                                                    @php
                                                        $counter++;
                                                    @endphp
                                                    <option value="{{ $counter }}">{{ $counter }}</option>
                                                @endforeach
                                            </select>
                                            <div
                                                class="flex flex-wrap items-center space-y-2 sm:space-y-0 sm:space-x-4">
                                                <label for="workday" class="text-xs font-medium whitespace-nowrap">
                                                    Datum en tijd: (niet nodig)
                                                </label>
                                                <input type="datetime-local" id="workday" name="workday"
                                                    class="p-2 border border-gray-300 rounded-md text-sm w-full sm:w-auto"
                                                    min="{{ now()->addDays(2)->format('Y-m-d\TH:i') }}">
                                                @error('workday')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        const datetimeInput = document.getElementById('workday');

                                                        // Event listener voor keydown om te voorkomen dat tekst wordt ingevoerd
                                                        datetimeInput.addEventListener('keydown', function(event) {
                                                            event.preventDefault();
                                                        });

                                                        // Evenement om de tekstinvoer te blokkeren wanneer er tekst wordt geplakt
                                                        datetimeInput.addEventListener('paste', function(event) {
                                                            event.preventDefault();
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="w-full bg-yellow text-black py-2 px-4 rounded-md hover:bg-violet-light hover:text-white">
                                            Verzend uitnodiging
                                        </button>
                                    </form>
                                </div>
                            @endif
                            <div class="flex flex-wrap gap-2">
                                <div>
                                    <div class="mt-2">
                                        <form action="{{ route('vacatures.show', $vacature->id) }}" method="GET"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit"
                                                class="px-4 py-2 w-full rounded-lg font-semibold transition-colors duration-300 bg-violet-light hover:bg-violet-dark text-white">Details
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mt-2">
                                        <form action="{{ route('vacatures.edit', $vacature->id) }}" method="GET"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit"
                                                class="px-4 py-2 w-full rounded-lg font-semibold transition-colors duration-300 bg-moss-medium hover:bg-moss-dark text-white">Bewerken
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div>
                                    <div class="mt-2">
                                        <form action="{{ route('vacatures.destroy', $vacature->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-4 py-2 w-full rounded-lg font-semibold transition-colors duration-300 bg-red-500 hover:bg-red-600 text-white"
                                                onclick="return confirm('Weet je zeker dat je deze vacature wilt verwijderen?');">
                                                Verwijderen
                                            </button>
                                        </form>
                                    </div>
                                    <div class="mt-2">
                                        <form action="{{ route('company.toggleVisibility', $vacature->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="px-4 py-2 w-full rounded-lg font-semibold transition-colors duration-300 {{ $vacature->status ? 'bg-yellow hover:bg-amber-400 text-black' : 'bg-violet-light hover:bg-violet-dark text-white' }}">
                                                {{ $vacature->status ? 'Sluiten' : 'Openen' }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($vacature->applications->where('accepted', 1)->count() > 0)
                            <div class="overflow-x-auto" id="vacatureInvitations{{ $vacature->id }}Table"
                                style="display: none;">
                                <div class="bg-moss-light p-4">
                                    <table class="min-w-full bg-white w-auto mx-auto sm:rounded-lg">
                                        <thead>
                                            <tr class="border-b">
                                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                                                    #</th>
                                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                                                    Gesolliciteerd op</th>
                                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                                                    Uitnodiging verzonden op</th>
                                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                                                    Uitnodiging geaccepteerd/gewijzigd op</th>
                                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                                                    Dag</th>
                                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                                                    Tijd</th>
                                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                                                    Status</th>
                                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                                                    Acties</th>
                                            </tr>
                                        <tbody>
                                            @php
                                                $counter = 0;
                                            @endphp
                                            @foreach ($vacature->applications->where('accepted', 1) as $application)
                                                @php
                                                    $counter++;
                                                @endphp
                                                <tr class="border-b">
                                                    <td class="px-4 py-2">{{ $counter }}</td>
                                                    <td class="px-4 py-2">{{ $application->created_at }}</td>
                                                    <td class="px-4 py-2"> {{ $application->invitation->created_at }}
                                                    </td>
                                                    <td class="px-4 py-2">
                                                        @if (
                                                            $application->invitation->created_at->format('Y-m-d H:i:s') !==
                                                                $application->invitation->updated_at->format('Y-m-d H:i:s'))
                                                            {{ $application->invitation->updated_at }}
                                                        @else
                                                            Nog niet gereageerd
                                                        @endif

                                                    </td>
                                                    <td class="px-4 py-2"> {{ $application->invitation->day }} </td>
                                                    <td class="px-4 py-2"> {{ $application->invitation->time }} </td>
                                                    <td class="px-4 py-2
                                                        @if ($application->invitation->declined === 0) text-green-500">
                                                            Geaccepteerd
                                                        @elseif ($application->invitation->declined === 1)
                                                        text-red-500">
                                                            Geweigerd
                                                        @elseif ($application->invitation->declined === 2)
                                                        text-amber-500">
                                                        Nieuwe datum
                                                        @else
                                                        text-gray-500">
                                                        Wachtend @endif
                                                    </td>
                                                    <td class="px-4
                                                        py-2 h-full">
                                                        @if ($application->invitation->declined === 1)
                                                            <form
                                                                action="{{ route('company.removeApplicantFromList', $application->invitation->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 font-semibold">Uit
                                                                    lijst verwijderen</button>

                                                            </form>
                                                        @elseif ($application->invitation->declined === 2)
                                                            Nieuwe datum:
                                                            <div
                                                                class="flex items-center justify-center space-x-4 h-full">
                                                                <form
                                                                    action="{{ route('company.acceptNewDate', $application->invitation->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 font-semibold"
                                                                        onclick="return confirm('De applicant verwacht dat hij op die datum moet komen.');">Accepteren</button>
                                                                </form>
                                                                <form
                                                                    action="{{ route('company.chooseNewDate', $application->invitation->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="bg-amber-500 text-white px-4 py-2 rounded-lg hover:bg-amber-600 font-semibold"
                                                                        onclick="return confirm('De applicant zal een nieuwe datum moeten uitkiezen, weet je het zeker?');">Weigeren</button>
                                                                </form>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const toggleButton = document.getElementById('toggleVacatureInvitations{{ $vacature->id }}Table');
                                    const table = document.getElementById('vacatureInvitations{{ $vacature->id }}Table');
                                    const icon = document.getElementById('toggleVacatureInvitations{{ $vacature->id }}Icon');

                                    if (toggleButton && table && icon) {
                                        toggleButton.addEventListener('click', function() {
                                            if (table.style.display === 'none' || table.style.display === '') {
                                                table.style.display = 'block';
                                                icon.textContent = '▼'; // Verander naar neerwaartse pijl
                                            } else {
                                                table.style.display = 'none';
                                                icon.textContent = '▲'; // Verander naar opwaartse pijl
                                            }
                                        });
                                    } else {
                                        console.error('Toggle-elementen niet gevonden.');
                                    }
                                });
                            </script>
                        @endif
                        @if ($vacature->applications->where('accepted', 0)->count() > 0)
                            <div class="overflow-x-auto" id="vacature{{ $vacature->id }}Table"
                                style="display: none;">
                                <div class="bg-moss-light p-4">
                                    <table class="min-w-full bg-white w-auto mx-auto sm:rounded-lg">
                                        <thead>
                                            <tr class="border-b">
                                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                                                    #</th>
                                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                                                    Gesolliciteerd op</th>
                                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                                                    Eisen waar niet aan voldaan zijn</th>
                                                @if ($vacature->secondary_info_needed)
                                                    <th
                                                        class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                                                        Extra informatie</th>
                                                @endif
                                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                                                    Acties</th>
                                            </tr>
                                        <tbody>
                                            @php
                                                $counter = 0;
                                            @endphp
                                            @foreach ($vacature->applications->where('accepted', 0) as $application)
                                                @php
                                                    $counter++;
                                                @endphp
                                                <tr class="border-b">
                                                    <td class="px-4 py-2">{{ $counter }}</td>
                                                    <td class="px-4 py-2">{{ $application->created_at }}</td>
                                                    <td class="px-4 py-2">
                                                        @foreach ($application->demands as $demand)
                                                            {{ $demand->name }}
                                                        @endforeach
                                                    </td>
                                                    @if ($vacature->secondary_info_needed)
                                                        <td class="px-4 py-2">{{ $application->secondary_info }}</td>
                                                    @endif
                                                    <td class="px-4 py-2 h-full">
                                                        <div class="flex items-center justify-center space-x-4 h-full">
                                                            @if (count($application->demands) > 0)
                                                                <form
                                                                    action="{{ route('company.rejectApplicant', $application->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 font-semibold"
                                                                        onclick="return confirm('Weet je zeker dat je deze applicant wilt afwijzen?');">Afwijzen</button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const toggleButton = document.getElementById('toggleVacature{{ $vacature->id }}Table');
                                    const table = document.getElementById('vacature{{ $vacature->id }}Table');
                                    const icon = document.getElementById('toggleVacature{{ $vacature->id }}Icon');

                                    if (toggleButton && table && icon) {
                                        toggleButton.addEventListener('click', function() {
                                            if (table.style.display === 'none' || table.style.display === '') {
                                                table.style.display = 'block';
                                                icon.textContent = '▼';
                                            } else {
                                                table.style.display = 'none';
                                                icon.textContent = '▲';
                                            }
                                        });
                                    } else {
                                        console.error('Toggle-elementen niet gevonden.');
                                    }
                                });
                            </script>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </ul>
    <div class="mb-20">

    </div>
</x-layout>
