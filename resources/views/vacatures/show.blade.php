<x-app-layout>
    <style>
        /* Algemeen */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .vacature-container {
            background-color: #fff;
            max-width: 1000px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 8px;
            border: 1px solid #ddd;
            position: relative;
        }

        /* Header sectie */
        .header h1 {
            font-size: 28px;
            color: #4a4a4a;
            margin-bottom: 10px;
            font-weight: bold;
            text-align: center;
        }

        h2 {
            font-size: 22px;
            color: #6c757d;
            margin-bottom: 10px;
        }

        /* Algemeen info */
        .vacature-details h3 {
            font-size: 18px;
            color: #4a4a4a;
            margin-top: 20px;
        }

        .description {
            margin-top: 20px;
        }

        .general-info p,
        .description p {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }

        .general-info ul {
            list-style: disc;
            margin-left: 20px;
        }

        /* Stijlen voor knoppen */
        .apply-button {
            display: inline-block;
            background-color: #e20074;
            /* Roze */
            color: #fff;
            font-size: 16px;
            border-radius: 50px;
            padding: 12px 25px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            border: none;
            position: absolute;
            bottom: 20px;
            right: 20px;
        }

        .apply-button:hover {
            background-color: #d1006e;
        }

        .applied-button.color-gray {
            display: inline-block;
            background-color: #b0b0b0;
            color: #fff;
            cursor: not-allowed;
            font-size: 16px;
            border-radius: 50px;
            padding: 12px 25px;
            text-align: center;
            text-decoration: none;
            border: none;
            position: absolute;
            bottom: 20px;
            right: 20px;
        }


        /* Groene achtergrond sectie */
        .header {
            background-color: #d4e7b1;
            /* Groene achtergrond */
            padding: 20px;
            border-radius: 8px;
            color: #333;
        }

        /* Stijl voor de modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            overflow: auto;
            padding-top: 60px;
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }


        /* Responsief ontwerp voor telefoon */
        @media (max-width: 768px) {
            .vacature-container {
                padding: 15px;
            }

            .header {
                padding: 15px;
            }

            .vacature-details {
                display: flex;
                flex-direction: column;
            }

            .vacature-details .general-info {
                display: flex;
                flex-direction: column;
                margin-right: 0;
            }

            .vacature-details .description {
                display: flex;
                flex-direction: column;
                margin-top: 20px;
            }

            .apply-button {
                width: 80%;
                position: fixed;
                bottom: 20px;
                left: 10%;
                right: 10%;
            }
        }
    </style>

    <div class="vacature-container">
        <div class="header">
            <h1>{{ $vacature->company->name }} - {{ $vacature->function }}</h1>
        </div>

        <div class="vacature-details">
            <div class="general-info">
                <h2>Algemene informatie</h2>
                <p><strong>Locatie:</strong> {{ $vacature->location }}</p>
                <p><strong>Salaris:</strong> €{{ $vacature->salary }} per maand</p>
                <p><strong>Werkuren:</strong> {{ $vacature->workhours }} uur per week</p>
                <p><strong>Contract:</strong> {{ $vacature->time_id === 0 ? 'Parttime' : 'Fulltime' }}</p>
                <p><strong>Eisen:</strong></p>
                <ul>
                    @foreach ($vacature->demands as $demand)
                        <li>{{ $demand->name }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="description">
                <h2>Beschrijving</h2>
                <p>{{ $vacature->description }}</p>
                <p><strong>Werkdagen:</strong>
                    @php
                        $daysArray = json_decode($vacature->days, true); // Decode JSON into an associative array
                    @endphp
                    @if (is_null($daysArray) || empty($daysArray))
                        Geen dagen beschikbaar
                    @else
                        {{ implode(', ', $daysArray) }} <!-- Join the array into a string -->
                    @endif
                </p>
                <div>
                    <!-- Wachtrij & Succesrating -->
                    <p><strong>Wachtlijst:</strong> {{ $vacature->waiting_list ?? 'N/A' }}</p>
                    <p><strong>Succesrating:</strong> {{ $vacature->success_rating ?? 'N/A' }}</p>
                </div>
                <div class="ratings">
                    <h3>Beoordelingen</h3>
                    <div class="placeholder"></div>
                    <div class="placeholder"></div>
                </div>
            </div>
        </div>

        <!-- Solliciteer knop -->
        @auth
            @php
                // Load applications relationship or directly query the database
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
            <div class="applied-button color-gray">Je hebt al gesolliciteerd</div>
        @else
            <button class="apply-button" id="solliciteerBtn">Solliciteer</button>
        @endif



        <!-- Modal -->
        <div id="solliciteerModal" class="modal">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <h2>Solliciteer voor de Vacature</h2>

                <form id="sollicitatieForm" action="{{ route('applications.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @auth
                        <div>De vacature wordt automatisch op je account opgeslagen.</div>
                        <input type="hidden" name="user_id" value="true">
                    @else
                        <label for="email">E-mailadres:</label>
                        <input type="email" id="email" name="email" required><br>
                    @endauth
                    <br>
                    <label for="demands[]">Kies de eisen die je hebt:</label><br>
                    @foreach ($vacature->demands as $demand)
                        <input type="hidden" name="demands[{{ $demand->id }}]" value="false">
                        <input type="checkbox" id="demand_{{ $demand->id }}" name="demands[{{ $demand->id }}]"
                            value="true">
                        <label for="demand_{{ $demand->id }}">{{ $demand->name }}</label><br>
                    @endforeach
                    <br>

                    @if ($vacature->secondary_info_needed)
                        <label for="secondaryInfo">Vul hier jouw extra kwaliteiten in die niet bij de vereisten
                            staan.</label>
                        <input type="text" name="secondaryInfo" id="secondaryInfo"><br>
                    @endif

                    <input type="hidden" name="vacature_id" value="{{ $vacature->id }}">
                    <input type="hidden" name="vacature_company" value="{{ $vacature->company->name }}">
                    <input type="hidden" name="vacature_function" value="{{ $vacature->function }}">

                    <button type="submit">Verstuur Sollicitatie</button>
                </form>
            </div>
        </div>

        @if (session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        @endif

        <script>
            // Verkrijg de modal en de sollicitatieknop
            let modal = document.getElementById("solliciteerModal");
            let sollicitieerBtn = document.getElementById("solliciteerBtn");
            let closeBtn = document.getElementsByClassName("close-btn")[0];

            // Wanneer de gebruiker op de sollicitatieknop klikt, toon de modal
            solliciteerBtn.onclick = function() {
                modal.style.display = "block";
            }

            // Wanneer de gebruiker op de sluitknop klikt, sluit de modal
            closeBtn.onclick = function() {
                modal.style.display = "none";
            }

            // Wanneer de gebruiker ergens buiten de modal klikt, sluit de modal
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    </div>
</x-app-layout>
