@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="bg-cream min-h-screen flex items-center justify-center">
    <form action="{{ route('vacatures.update', $vacature->id) }}" method="POST"
        class="bg-cream p-8-plus rounded-lg shadow-custom-light mx-auto max-w-5xl sm:max-w-full">
        @csrf
        @method('PUT')
        <h1 class="text-2.5xl font-bold text-moss-dark mb-6">Bewerk Vacature voor de positie: {{ $vacature->function }}
        </h1>

        <!-- Grid Layout for Two-Column Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- First Column -->
            <div class="flex flex-col">
                <div class="mb-4">
                    <label for="function" class="block text-moss-dark font-bold text-xl mb-1">Positie Titel *</label>
                    <input type="text" id="function" name="function"
                        value="{{ old('function', $vacature->function) }}"
                        class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                        placeholder="Voer de Titel van de positie in" required>
                </div>

                <div class="mb-4">
                    <label for="workhours" class="block text-moss-dark font-bold text-xl mb-1">Uren *</label>
                    <input type="number" id="workhours" name="workhours"
                        value="{{ old('workhours', $vacature->workhours) }}"
                        class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                        placeholder="Voer de uren per week in" required>
                </div>

                <div class="mb-4">
                    <label for="education" class="block text-moss-dark font-bold text-xl mb-1">Minimaal Opleidingsniveau
                        *</label>
                    <select id="education" name="education"
                        class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                        required>
                        <option value="" disabled>Kies een Opleidingsniveau</option>
                        <option value="1" {{ old('education', $vacature->education) == 1 ? 'selected' : '' }}>
                            N.V.T.</option>
                        <option value="2" {{ old('education', $vacature->education) == 2 ? 'selected' : '' }}>
                            Middelbareschool</option>
                        <option value="3" {{ old('education', $vacature->education) == 3 ? 'selected' : '' }}>MBO
                        </option>
                        <option value="4" {{ old('education', $vacature->education) == 4 ? 'selected' : '' }}>HBO
                        </option>
                        <option value="5" {{ old('education', $vacature->education) == 5 ? 'selected' : '' }}>
                            Universitair</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="location" class="block text-moss-dark font-bold text-xl mb-1">Locatie van het
                        Werk</label>
                    <input type="text" id="location" name="location"
                        value="{{ old('location', $vacature->location) }}"
                        class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                        placeholder="Rotterdam, Utrecht...">
                </div>
            </div>

            <!-- Second Column -->
            <div class="flex flex-col">
                <div class="mb-4">
                    <label for="time_id" class="block text-moss-dark font-bold text-xl mb-1">Full- of Parttime
                        *</label>
                    <select id="time_id" name="time_id"
                        class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                        required>
                        <option value="" disabled>Kies een Tijdsduur</option>
                        <option value="0" {{ old('time_id', $vacature->time_id) == 0 ? 'selected' : '' }}>Parttime
                        </option>
                        <option value="1" {{ old('time_id', $vacature->time_id) == 1 ? 'selected' : '' }}>Fulltime
                        </option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="salary" class=" block text-moss-dark font-bold text-xl mb-1">Maandloon *</label>
                    <input type="number" id="salary" name="salary" value="{{ old('salary', $vacature->salary) }}"
                        class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                        placeholder="Voer maandloon in" required>
                </div>

                <div class="mb-4">
                    <label for="place" class="block text-moss-dark font-bold text-xl mb-1">Op Locatie of Op Afstand
                        *</label>
                    <select id="place" name="place"
                        class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                        required>
                        <option value="" disabled>Kies een Locatie</option>
                        <option value="1" {{ old('place', $vacature->place) == 1 ? 'selected' : '' }}>Op Locatie
                        </option>
                        <option value="2" {{ old('place', $vacature->place) == 2 ? 'selected' : '' }}>Hybride
                        </option>
                        <option value="3" {{ old('place', $vacature->place) == 3 ? 'selected' : '' }}>Op Afstand
                        </option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-moss-dark font-bold text-xl mb-1">Dagen</label>
                    <div class="grid grid-cols-7 gap-2 w-full"> <!-- Use grid for responsive behavior -->
                        @php
                            $selectedDays = is_string($vacature->days) ? json_decode($vacature->days, true) : [];
                        @endphp
                        @foreach (['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag'] as $day)
                            <div class="flex items-center justify-center"> <!-- Center the buttons -->
                                <input type="checkbox" id="{{ strtolower($day) }}" name="days[]"
                                       value="{{ $day }}"
                                       {{ in_array($day, old('days', $selectedDays)) ? 'checked' : '' }}
                                       class="peer hidden">
                                <label for="{{ strtolower($day) }}"
                                       tabindex="0"
                                       class="h-14 w-20 bg-moss-light text-moss-dark font-bold rounded-lg cursor-pointer flex items-center justify-center
                    peer-checked:bg-violet-light peer-checked:text-white focus:ring-2 focus:ring-violet-light focus:outline-none">
                                    {{ substr($day, 0, 2) }} <!-- Display only the first two letters -->
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // Attach keyboard interaction for labels
                        document.querySelectorAll('label[tabindex="0"]').forEach(function (label) {
                            label.addEventListener('keydown', function (event) {
                                if (event.key === ' ' || event.key === 'Enter') {
                                    event.preventDefault(); // Prevent default scroll or submit
                                    const input = document.getElementById(label.htmlFor); // Get associated input
                                    if (input) {
                                        input.checked = !input.checked; // Toggle checkbox state
                                        input.dispatchEvent(new Event('change')); // Trigger change event
                                    }
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>

        <!-- Single Column Layout for Remaining Fields -->
        <div class="mt-6">
            <div class="mb-4">
                <label for="description" class="block text-moss-dark font-bold text-xl mb-1">Algemene Omschrijving
                    *</label>
                <textarea id="description" name="description"
                    class="w-full p-3 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none"
                    placeholder="Voer een omschrijving in" rows="4" required>{{ old('description', $vacature->description) }}</textarea>
            </div>
            <div class="flex items-center space-x-2 mb-2">
                <input type="hidden" name="secondary_info_needed" value="0">
                <input type="checkbox" id="secondary_info_needed" name="secondary_info_needed" value="1"
                    class="w-5 h-5 text-violet-light bg-gray-100 border-gray-300 rounded focus:ring-violet-light"
                    @if ($vacature->secondary_info_needed) checked @endif>
                <label for="secondary_info_needed" class="text-moss-dark font-bold text-xl">
                    Moet de werknemer zelf nog extra informatie doorgeven?
                </label>
            </div>


            <!-- Eisenlijst dropdown -->
            <div class="relative">
                <div class="flex items-center space-x-2">
                    <button id="demandsButton"
                        class="text-gray-900 bg-moss-light hover:bg-moss-dark hover:text-white focus:ring-4 focus:outline-none focus:ring-moss-light font-bold text-xl rounded-lg text-sm px-5 py-2.5 inline-flex items-center"
                        type="button">
                        Eisen
                        <svg class="w-2.5 h-2.5 ml-2" aria-hidden="true" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <label class="block text-moss-dark font-bold text-xl mb-1">
                        Moet de werknemer nog aan eventuele eisen voldoen?
                    </label>
                </div>

                <!-- Dropdown -->
                <div id="demands" class="hidden left-0 right-0 bg-moss-light rounded-lg mb-2">
                    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 p-3">
                        @foreach ($demands as $demand)
                            <li>
                                <label for="demand_{{ $demand->id }}"
                                    class="flex items-center space-x-2 p-2 rounded text-sm font-medium text-gray-900 hover:bg-moss-dark hover:text-white cursor-pointer has-[:checked]:bg-violet-light has-[:checked]:text-white">
                                    <input id="demand_{{ $demand->id }}" name="demands[]" type="checkbox"
                                        value="{{ $demand->id }}" @if ($vacature->demands->contains($demand->id)) checked @endif
                                        class="w-4 h-4 text-moss-light bg-gray-100 border-gray-600 rounded focus:ring-moss-light">
                                    <span>{{ $demand->name }}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const button = document.getElementById('demandsButton');
                        const dropdown = document.getElementById('demands');

                        button.addEventListener('click', function() {
                            dropdown.classList.toggle('hidden');
                        });
                    });
                </script>
            </div>

            <input type="hidden" id="company_id" name="company_id"
                value="{{ Auth::guard('company')->user()->id }}">
            <input type="hidden" id="status" name="status" value="{{ old('status', $vacature->status) }}">

            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button type="submit"
                    class="bg-violet-light text-white font-bold rounded-lg shadow-custom-dark hover:bg-violet-dark focus:ring-2 focus:ring-violet-dark py-3 px-8">
                    @if ($vacature->status == 1)
                        Opslaan
                    @else
                        Preview
                    @endif
                </button>
            </div>
        </div>
    </form>
</div>
