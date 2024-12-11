@vite(['resources/js/app.js', 'resources/css/app.css'])
<x-layout>
    <div class="flex  justify-center min-h-screen">
        <div class="bg-moss-light rounded-lg p-6 w-full max-w-md h-1/2">
            <h1 class="text-xl font-bold text-gray-800 mb-4">
                Uitnodiging van {{ $invitation->application->vacature->company->name }}
            </h1>
            <p class="text-gray-600 mb-4">
                {{ $invitation->application->vacature->company->name }} wil graag dat je voor hen komt werken.
            </p>
            <p class="text-gray-600 mb-4">
                Ze hebben aangegeven dat je op <span class="font-semibold">{{ $invitation->day }}</span> kan beginnen in
                <span class="font-semibold">{{ $invitation->application->vacature->location }}</span>.
            </p>
            <p class="text-gray-600 mb-6">
                Geef via onderstaande knoppen aan of je wel of niet wilt gaan werken.
            </p>
            <div class="flex space-x-4">
                <form method="POST"
                    action="{{ route('invitations.acceptInvitation', [$invitation->url_hashed, $invitation->id]) }}">
                    @csrf
                    <button type="submit"
                        class="w-full px-4 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2"
                        onclick="return confirm('Je wordt verwacht om te komen werken. Weet je zeker dat je deze beslissing wilt bevestigen?');">
                        Accepteren
                    </button>
                </form>
                <form method="POST" action="">
                    @csrf
                    <button type="submit"
                        class="w-full px-4 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2">
                        Weigeren
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
