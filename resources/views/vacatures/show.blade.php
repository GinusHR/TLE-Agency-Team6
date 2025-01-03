@vite(['resources/js/app.js', 'resources/css/app.css'])

<x-layout>

    <a href="/vacatures" class="text-violet-light hover:text-violet-800 mx-[19.5vw] font-medium mb-2 mt-2 inline-block">
        &larr; Terug naar alle vacatures
    </a>

    <div class="bg-moss-light max-w-4xl mx-auto mt-10 p-8 rounded-lg border border-gray-300 relative mb-[5vw]">
        <div>
            <!-- Header Section -->
            <div class="flex justify-center items-center gap-[1vw] md:gap-[1vw] bg-white p-5 rounded-md text-moss-dark">
                @if ($vacature->company->logo)
                    <img class=" rounded-lg w-[15vw] md:w-[4.5vw]"
                        src="{{ asset('storage/' . $vacature->company->logo) }}" alt="Bedrijfslogo">
                @endif
                <h1 class="text-center text-2xl font-bold mb-4" style="font-family: Arial, sans-serif;">
                    {{ $vacature->company->name }} - {{ $vacature->function }}
                </h1>
            </div>

            <!-- General Info Section -->
            <div class="mt-6">
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-3">Algemene informatie</h2>
                    @if (isset($vacature->location))
                        <p class="mb-3"><strong>Locatie:</strong> {{ $vacature->location }}</p>
                    @else
                        <p class="mb-3"><strong>Locatie:</strong> Op afstand</p>
                    @endif
                    <p class="mb-3"><strong>Salaris:</strong> €{{ $vacature->salary }} per maand</p>
                    <p class="mb-3"><strong>Werkuren:</strong> {{ $vacature->workhours }} uur per week</p>
                    <p class="mb-3"><strong>Contract:</strong>
                        {{ $vacature->time_id === 0 ? 'Parttime' : 'Fulltime' }}</p>
                    <p class="mb-3"><strong>Opleidingsniveau:</strong>
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
                    <p class="mb-3"><strong>Eisen:</strong></p>
                    <ul class="list-disc ml-6 mb-3">
                        @foreach ($vacature->demands as $demand)
                            <li>{{ $demand->name }}</li>
                        @endforeach
                    </ul>
                </div>

                <!-- Description Section -->
                <div class="mt-6">
                    <h2 class="text-lg font-semibold mb-3">Beschrijving</h2>
                    <p class="mb-3">{{ $vacature->description }}</p>
                    <p class="mb-3"><strong>Werkdagen:</strong>
                        @php
                            $daysArray = json_decode($vacature->days, true);
                        @endphp
                        @if (is_null($daysArray) || empty($daysArray))
                            Geen dagen beschikbaar
                        @else
                            {{ implode(', ', $daysArray) }}
                        @endif
                    </p>

                    <!-- Wachtlijst section on its own row with correct spacing -->
                    <div class="mb-3">
                        <p><strong>Wachtlijst:</strong> Er wachten nog {{ $queue }} mensen op deze vacature.</p>
                    </div>

                    <!-- Succesrating Section -->
                    <div class="mb-3">
                        @if ($succesRating > 0)
                            <p class="mb-3"><strong>Succesrating:</strong> Er zijn tot nu toe {{ $succesRating }}
                                mensen aangenomen.</p>
                        @endif
                    </div>

                    <!-- Apply Button Section aligned to the right -->
                    <div class="flex justify-end">
                        @auth
                            @php
                                $hasApplied = \App\Models\Application::where('user_id', Auth::id())
                                    ->where('vacature_id', $vacature->id)
                                    ->exists();
                            @endphp
                        @else
                            @php
                                $hasApplied = false;
                            @endphp
                        @endauth
                        @if ($hasApplied)
                            <div
                                class="bg-gray-400 text-white text-center font-semibold rounded-full py-3 px-6 cursor-not-allowed">
                                Je hebt al gesolliciteerd
                            </div>
                        @else
                            <button id="solliciteerBtn"
                                class="bg-violet-light text-white font-medium text-center rounded-full py-3 px-6 hover:bg-violet-dark">
                                Solliciteer
                            </button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="bg-moss-light max-w-4xl mx-auto mt-10 p-8 rounded-lg border border-gray-300 relative mb-[5vw]">
        <!-- Beoordelingen Section with Rating Button next to the Header -->
        <div>
            <h3 class="text-lg font-semibold mb-3 flex items-center justify-between">
                Beoordelingen
                <!-- Button to Create Rating next to Beoordelingen -->
                @auth
                    @if (!$userHasAcceptedApplication)
                        <!-- Only show button if user has accepted application -->
                    @elseif (\App\Models\Rating::where('user_id', Auth::id())->where('vacature_id', $vacature->id)->exists())
                        <!-- If user already has a rating for this vacature -->
                        <div
                            class="bg-gray-400 text-white text-sm text-center font-semibold rounded-full py-2 px-4 cursor-not-allowed">
                            Je hebt al een beoordeling geplaatst
                        </div>
                    @else
                        <!-- If user hasn't rated yet -->
                        <a href="{{ route('ratings.create', ['vacature' => $vacature->id]) }}"
                            class="bg-violet-light text-white text-sm text-center rounded-full py-2 px-4 hover:bg-violet-dark ml-4">Voeg
                            een beoordeling toe
                        </a>
                    @endif
                @endauth
            </h3>

            <!-- Display Total Number of Ratings -->
            <div class="mb-4">
                <strong>Totaal Aantal Beoordelingen:</strong>
                <span class="font-medium">{{ $totalRatings }} beoordeling{{ $totalRatings != 1 ? 'en' : '' }}</span>
            </div>

            <!-- Display Average Rating -->
            <div class="mb-4">
                <strong>Gemiddelde Beoordeling:</strong>
                <span class="text-yellow-500 font-medium">
                    @if ($averageRating)
                        {{ $averageRating == floor($averageRating) ? intval($averageRating) : number_format($averageRating, 1) }}
                        / 5
                    @else
                        Geen beoordelingen
                    @endif
                </span>
            </div>

            <!-- Display Ratings -->
            @if ($vacature->ratings->isNotEmpty())
                <div class="space-y-4">
                    @foreach ($vacature->ratings as $rating)
                        <div class="p-4 border rounded-lg shadow-md bg-white relative">
                            <!-- Rating Created At -->
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="font-bold">{{ $rating->created_at->format('d-m-Y') }}</span>
                                <span class="text-yellow-500 font-medium">Rating: {{ $rating->rating }}/5</span>
                                <!-- Edit and Delete buttons for the creator of the rating -->
                                @auth
                                    @if (Auth::id() === $rating->user_id)
                                        <!-- Only show buttons if the logged-in user is the creator -->
                                        <div class="absolute top-2 right-2 flex space-x-4">
                                            <!-- Edit Button -->
                                            <form action="{{ route('ratings.edit', ['rating' => $rating->id]) }}"
                                                method="GET">
                                                <button type="submit"
                                                    class="bg-violet-light text-white font-medium text-center rounded-full py-2 px-4 hover:bg-violet-dark">
                                                    Bewerken
                                                </button>
                                            </form>

                                            <!-- Delete Button -->
                                            <form action="{{ route('ratings.destroy', ['rating' => $rating->id]) }}"
                                                method="POST"
                                                onsubmit="return confirm('Weet je zeker dat je deze beoordeling wilt verwijderen?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 text-white font-medium text-center rounded-full py-2 px-4 hover:bg-red-600">
                                                    Verwijderen
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>

                            <!-- Review Text -->
                            <p class="text-gray-700 break-words">{{ $rating->review }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Er zijn nog geen beoordelingen voor deze vacature.</p>
            @endif
        </div>
    </div>

    <div class="bg-moss-light max-w-4xl mx-auto mt-10 p-8 rounded-lg border border-gray-300 relative mb-[5vw]">
        <h2 class="text-lg font-semibold text-gray-700 mb-3">Over {{ $vacature->company->name }} </h2>
        <p>{{ $vacature->company->description }}</p>
        <div class="flex justify-center items-center">
            @if ($vacature->company->image)
                <img class="rounded-lg w-[70vw] md:w-[35vw] m-[6vw] md:m-[2vw]"
                    src="{{ asset('storage/' . $vacature->company->image) }}" alt="Bedrijfsimage">
            @endif
        </div>
        <div class="flex justify-center  md:justify-end gap-[5vw] md:gap-[1.5vw] mt-[2vw]">
            <a href="{{ $vacature->company->homepage_url }}" target="_blank"
                class="bg-violet-light text-white text-sm text-center rounded-full py-3 px-6 hover:bg-violet-dark whitespace-nowrap">Website</a>
            <a href="{{ $vacature->company->about_us_url }}" target="_blank"
                class="bg-violet-light text-white text-sm text-center rounded-full py-3 px-6 hover:bg-violet-dark whitespace-nowrap ">About
                us</a>
            <a href="{{ $vacature->company->contact_url }}" target="_blank"
                class="bg-violet-light text-white text-sm text-center rounded-full py-3 px-6 hover:bg-violet-dark whitespace-nowrap">Contact</a>
        </div>

        <!-- Modal -->
        <div id="solliciteerModal"
             class="{{ $errors->any() ? '' : 'hidden' }} fixed inset-0 bg-black bg-opacity-50 z-20 flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-4/5 max-w-lg">
                <span class="text-gray-500 font-bold text-2xl cursor-pointer float-right" id="closeBtn" tabindex="0">&times;</span>
                <h2 class="text-xl font-semibold mb-4">Solliciteer voor de Vacature</h2>
                @if ($errors->any())
                    <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="sollicitatieForm" action="{{ route('applications.store') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @auth
                        <div>De vacature wordt automatisch op je account opgeslagen.</div>
                        <input type="hidden" name="user_id" value="true">
                    @else
                        <label for="email" class="block mb-2">E-mailadres:</label>
                        <input type="email" id="email" name="email" required
                               class="block w-full mb-4 border-gray-300 rounded-lg">
                    @endauth
                    <input type="hidden" name="vacature_id" value="{{ $vacature->id }}">
                    <input type="hidden" name="vacature_company" value="{{ $vacature->company->name }}">
                    <input type="hidden" name="vacature_function" value="{{ $vacature->function }}">

                    @if ($vacature->demands->count() > 0)
                        <label for="demands[]" class="block mb-2">Selecteer de criteria die op jou van toepassing
                            zijn:</label>
                        @foreach ($vacature->demands as $demand)
                            <input type="hidden" name="demands[{{ $demand->id }}]" value="false">
                            <div class="flex items-center mb-2">
                                <input type="checkbox" id="demand_{{ $demand->id }}"
                                       name="demands[{{ $demand->id }}]" value="true" class="mr-2"
                                       @auth @if (Auth::user()->demands->contains($demand->id)) checked @endif @endauth>
                                <label for="demand_{{ $demand->id }}">{{ $demand->name }}</label>
                            </div>
                        @endforeach
                    @endif

                    <div class="mb-4"></div>

                    <button type="submit"
                            class="bg-violet-light text-white py-2 px-4 rounded-full hover:bg-violet-dark w-full">
                        Verstuur Sollicitatie
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById("solliciteerModal");
        const sollicitieerBtn = document.getElementById("solliciteerBtn");
        const closeBtn = document.getElementById("closeBtn");
        const focusableElements = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
        let firstFocusableElement, lastFocusableElement;

        // Open Modal
        sollicitieerBtn.onclick = () => {
            modal.classList.remove("hidden");
            // Find all focusable elements within the modal
            const focusableContent = modal.querySelectorAll(focusableElements);
            firstFocusableElement = focusableContent[0]; // First focusable element
            lastFocusableElement = focusableContent[focusableContent.length - 1]; // Last focusable element
            firstFocusableElement.focus(); // Set initial focus to the first focusable element
        };

        // Close Modal
        closeBtn.onclick = () => closeModal();

        window.onclick = (event) => {
            if (event.target === modal) closeModal();
        };

        function closeModal() {
            modal.classList.add("hidden");
            sollicitieerBtn.focus(); // Return focus to the button that triggered the modal
        }

        // Trap focus within modal
        modal.addEventListener("keydown", (event) => {
            const isTabPressed = event.key === "Tab" || event.keyCode === 9;
            if (!isTabPressed) return;

            if (event.shiftKey) {
                // Shift + Tab: Focus moves backward
                if (document.activeElement === firstFocusableElement) {
                    event.preventDefault();
                    lastFocusableElement.focus();
                }
            } else {
                // Tab: Focus moves forward
                if (document.activeElement === lastFocusableElement) {
                    event.preventDefault();
                    firstFocusableElement.focus();
                }
            }
        });
    </script>

</x-layout>
