@vite(['resources/js/app.js', 'resources/css/app.css'])

<x-layout>
    <div class="bg-cream min-h-screen text-moss-dark">
        <div class="bg-white max-w-4xl mx-auto mt-10 p-8 rounded-lg border border-gray-300 relative">
            <!-- Header Section -->
            <div class="bg-moss-light p-5 rounded-md text-moss-dark">
                <h1 class="text-center text-2xl font-bold mb-4" style="font-family: Arial, sans-serif;">
                    {{ $vacature->company->name }} - {{ $vacature->function }}
                </h1>
            </div>

            <!-- General Info Section -->
            <div class="mt-6">
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-700 mb-3">Algemene informatie</h2>
                    <p class="mb-3"><strong>Locatie:</strong> {{ $vacature->location }}</p>
                    <p class="mb-3"><strong>Salaris:</strong> €{{ $vacature->salary }} per maand</p>
                    <p class="mb-3"><strong>Werkuren:</strong> {{ $vacature->workhours }} uur per week</p>
                    <p class="mb-3"><strong>Contract:</strong> {{ $vacature->time_id === 0 ? 'Parttime' : 'Fulltime' }}</p>
                    <p class="mb-3"><strong>Opleidings Niveau:</strong> {{ $vacature->education }}</p>
                    <p class="mb-3"><strong>Eisen:</strong></p>
                    <ul class="list-disc ml-6 mb-3">
                        @foreach ($vacature->demands as $demand)
                            <li>{{ $demand->name }}</li>
                        @endforeach
                    </ul>
                </div>

                <!-- Description Section -->
                <div class="mt-6">
                    <h2 class="text-lg font-semibold text-gray-700 mb-3">Beschrijving</h2>
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
                    <div class="mb-3">
                        <p><strong>Wachtlijst:</strong> {{ $vacature->waiting_list ?? 'N/A' }}</p>
                        <p><strong>Succesrating:</strong> {{ $vacature->success_rating ?? 'N/A' }}</p>
                    </div>
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-700 mb-3">Beoordelingen</h3>
                        <!-- Beoordelingen content can be dynamically added here -->
                    </div>
                </div>
            </div>

            <!-- Apply Button -->
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
                <div class="bg-gray-400 text-white text-center font-semibold rounded-full py-3 px-6 absolute bottom-5 right-5 cursor-not-allowed">
                    Je hebt al gesolliciteerd
                </div>
            @else
                <button id="solliciteerBtn" class="bg-violet-light text-white font-medium text-center rounded-full py-3 px-6 hover:bg-violet-dark absolute bottom-5 right-5">
                    Solliciteer
                </button>
            @endif

            <!-- Modal -->
            <div id="solliciteerModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-4/5 max-w-lg">
                    <span class="text-gray-500 font-bold text-2xl cursor-pointer float-right" id="closeBtn">&times;</span>
                    <h2 class="text-xl font-semibold mb-4">Solliciteer voor de Vacature</h2>
                    <form id="sollicitatieForm" action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @auth
                            <div>De vacature wordt automatisch op je account opgeslagen.</div>
                            <input type="hidden" name="user_id" value="true">
                        @else
                            <label for="email" class="block mb-2">E-mailadres:</label>
                            <input type="email" id="email" name="email" required class="block w-full mb-4 border-gray-300 rounded-lg">
                        @endauth
                        <label for="demands[]" class="block mb-2">Kies de eisen die je hebt:</label>
                        @foreach ($vacature->demands as $demand)
                            <input type="hidden" name="demands[{{ $demand->id }}]" value="false">
                            <div class="flex items-center mb-2">
                                <input type="checkbox" id="demand_{{ $demand->id }}" name="demands[{{ $demand->id }}]" value="true" class="mr-2">
                                <label for="demand_{{ $demand->id }}">{{ $demand->name }}</label>
                            </div>
                        @endforeach
                        <button type="submit" class="bg-moss-medium text-white py-2 px-4 rounded-lg hover:bg-moss-dark">
                            Verstuur Sollicitatie
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById("solliciteerModal");
        const sollicitieerBtn = document.getElementById("solliciteerBtn");
        const closeBtn = document.getElementById("closeBtn");

        sollicitieerBtn.onclick = () => modal.classList.remove("hidden");
        closeBtn.onclick = () => modal.classList.add("hidden");
        window.onclick = (event) => {
            if (event.target === modal) modal.classList.add("hidden");
        };
    </script>
</x-layout>
