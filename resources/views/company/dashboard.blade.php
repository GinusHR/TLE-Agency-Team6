@vite(['resources/js/app.js', 'resources/css/app.css'])

<x-layout>
    <h1>Welkom op het Dashboard, {{ Auth::guard('company')->user()->name }}</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <div
        class="flex flex-col justify-center items-center mx-auto max-w-md text-center p-6 bg-white shadow-lg rounded-lg">
        <p class="mb-4 text-gray-700">Hier kun je je bedrijfsinformatie beheren en andere acties uitvoeren.</p>
        <a href="{{ route('vacatures.create') }}" id="create-vacature-link"
            class="bg-yellow text-black py-2 px-4 rounded-md hover:bg-violet-light hover:text-white">Maak een vacature
            aan</a>
        <ul class="mt-4 space-y-2">
            <li>
                <a href="{{ route('company.profile') }}"
                    class="block bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Profiel beheren</a>
            </li>
            <li>
                <form id="logout-form" action="{{ route('company.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="block bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">Uitloggen</a>
            </li>
        </ul>
    </div>

    <ul>
        @foreach ($vacatures as $vacature)
            <div class="pt-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between content-center">
                            <div>
                                <h2 class="text-gray-600 text-2xl font-bold dark:text-white mr-4">
                                    @if ($vacature->status)
                                        Open:
                                    @else
                                        Closed:
                                    @endif{{ $vacature->function }} -
                                    {{ $vacature->location }}
                                </h2>
                                <p>Aantal aangenomen via vacature:
                                    {{ $vacature->applications->where('accepted', 1)->count() }}</p>
                                <div class="flex items-start"> <!-- New wrapper to align button properly -->
                                    <button id="toggleVacature{{ $vacature->id }}Table"
                                        class="flex items-center text-gray-600 hover:text-gray-900 dark:text-white mr-4">
                                        <!-- Added margin-right -->
                                        <span id="toggleVacature{{ $vacature->id }}Icon" class="mr-2">▼</span>
                                        <span>
                                            Aantal applicanten:
                                            {{ $vacature->applications->where('accepted', 0)->count() }}

                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <span>Mensen uitnodigen om te komen werken</span>
                                <form action="{{ route('company.acceptApplicants', $vacature->id) }}" method="POST">
                                    @csrf
                                    <select name="acceptApplicants" id="acceptApplicants">
                                        <option value="">Aantal mensen</option>
                                        @php
                                            $counter = 0;
                                        @endphp
                                        @foreach ($vacature->applications->where('accepted', 0) as $application)
                                            @php
                                                $counter++;
                                            @endphp
                                            <option value="{{ $counter }}">{{ $counter }} </option>
                                        @endforeach
                                    </select>
                                    <label for="workday">Eerste werkdag:</label>
                                    <input type="date" id="workday" name="workday">
                                    <button>Verzend uitnodiging</button>
                                </form>
                            </div>
                            <div class=" flex space-x-2 mt-4">
                                <button class="bg-violet-light text-white py-1 px-3 rounded-md hover:bg-violet-dark">
                                    <a href="{{ route('vacatures.show', $vacature->id) }}">Detail</a>
                                </button>
                                <button class="bg-yellow text-black py-1 px-3 rounded-md hover:bg-violet-light">
                                    <a href="{{ route('vacatures.edit', $vacature->id) }}">Edit</a>
                                </button>
                                <form action="{{ route('vacatures.destroy', $vacature->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600"
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
                        </div>

                        <div class="overflow-x-auto" id="vacature{{ $vacature->id }}Table" style="display: none;">
                            <table class="min-w-full bg-white dark:bg-gray-800">
                                <thead>
                                    <tr class="border-b dark:border-gray-700">
                                        <th
                                            class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            #</th>
                                        <th
                                            class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            Gesolliciteerd op</th>
                                        <th
                                            class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            Eisen waar niet aan voldaan zijn</th>
                                        @if ($vacature->secondary_info_needed)
                                            <th
                                                class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">
                                                Extra informatie</th>
                                        @endif
                                        <th
                                            class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">
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
                                        <tr class="border-b dark:border-gray-700">
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
        @endforeach
    </ul>
</x-layout>
