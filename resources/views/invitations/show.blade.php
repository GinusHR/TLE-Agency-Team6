@vite(['resources/js/app.js', 'resources/css/app.css'])
<x-layout>
    <div class="flex  justify-center mb-5">
        <div class="bg-moss-light rounded-lg p-6 w-full max-w-md h-1/2">
            <h1 class="text-xl font-bold text-gray-800 mb-4">
                Uitnodiging van {{ $invitation->application->vacature->company->name }}
            </h1>
            <p class="text-gray-600 mb-4">
                {{ $invitation->application->vacature->company->name }} wil graag dat je voor hen komt werken.
            </p>
            @if (!empty($invitation->day))
                <p class="text-gray-600 mb-4">
                    Ze hebben aangegeven dat je op <span class="font-semibold">{{ $invitation->day }}</span> om <span
                        class="font-semibold">{{ $invitation->time }}</span> kan beginnen in
                    <span class="font-semibold">{{ $invitation->application->vacature->location }}</span>.
                </p>
            @else
                <p class="text-gray-600 mb-4">
                    Ze willen dat je zelf een dag en tijd doorgeeft zodat je kan beginnen in
                    <span class="font-semibold">{{ $invitation->application->vacature->location }}</span>.
                </p>
            @endif
            <p class="text-gray-600 mb-6">
                Geef via onderstaande knoppen aan of je wel of niet wilt gaan werken.
            </p>
            <div class="flex space-x-4">
                @if (!empty($invitation->day))
                    <form method="POST"
                        action="{{ route('invitations.acceptInvitation', [$invitation->url_hashed, $invitation->id]) }}">
                        @csrf
                        <button type="submit"
                            class="w-full px-4 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2"
                            onclick="return confirm('Je wordt verwacht om te komen werken. Weet je zeker dat je deze beslissing wilt bevestigen?');">
                            Accepteren
                        </button>
                    </form>
                @endif
                <form method="POST"
                    action="{{ route('invitations.declineInvitation', [$invitation->url_hashed, $invitation->id]) }}">
                    @csrf
                    <button type="submit"
                        class="w-full px-4 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2"
                        onclick="return confirm('Weet je zeker dat je deze baan niet wilt accepteren?');">
                        Weigeren
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="flex justify-center mb-20">
        <div class="bg-moss-light rounded-lg p-6 w-full max-w-md h-1/2">
            <form method="POST"
                action="{{ route('invitations.changeInvitation', [$invitation->url_hashed, $invitation->id]) }}">
                @csrf
                <div class="flex flex-wrap items-center space-y-2 sm:space-y-0 sm:space-x-4">
                    <label for="workday" class="text-gray-600 mb-4 whitespace-nowrap">
                        @if (!empty($invitation->day))
                            Andere datum en tijd kiezen:
                        @else
                            Datum en tijd kiezen:
                        @endif
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
                <button type="submit"
                    class="w-full mt-2 px-4 py-2
                    @if (!empty($invitation->day)) bg-amber-500 hover:bg-amber-600 focus:ring-amber-400 @else bg-green-500 hover:bg-green-600 focus:ring-green-400 @endif
                    text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2"
                    onclick="return confirm('Je wordt verwacht om te komen werken. Weet je zeker dat je deze beslissing wilt bevestigen?');">
                    @if (!empty($invitation->day))
                        Wijzigen
                    @else
                        Datum doorgeven
                    @endif
                </button>
            </form>
        </div>
    </div>
</x-layout>
