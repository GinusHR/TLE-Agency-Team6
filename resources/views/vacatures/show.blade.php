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

        /* Groene achtergrond sectie */
        .header {
            background-color: #d4e7b1;
            /* Groene achtergrond */
            padding: 20px;
            border-radius: 8px;
            color: #333;
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
        <a href="#" class="apply-button">Solliciteer</a>
    </div>
</x-app-layout>
