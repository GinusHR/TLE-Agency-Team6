@vite(['resources/js/app.js', 'resources/css/app.css'])

<x-layout>
    <div class="flex items-center justify-center min-h-screen mt-[-10rem]">
        <div class="w-full max-w-sm p-6 bg-moss-light shadow-lg rounded-lg">
            <h1 class="text-2xl font-bold text-center mb-6">Bedrijfs Login</h1>
            @if (session('success'))
                <p class="text-base font-semibold mb-4">{{ session('success') }}</p>
            @endif
            <form class="flex-col justify-center" method="POST" action="{{ route('company.login') }}">
                @csrf
                <div class="mb-4">
                    <label  class="block text-gray-700 mb-2" for="login_code">Inlogcode</label>
                    <input
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-violet-light"
                        type="text" id="login_code" name="login_code" required>
                </div>
                <div class="mb-6">
                    <label  for="password">Wachtwoord</label>
                    <input
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-violet-light"
                        type="password" id="password" name="password" required>
                </div>
                <button class="w-full px-4 py-2 bg-violet-light text-white rounded-lg hover:bg-violet-dark"
                        type="submit">Log in</button>
            </form>
        </div>

    </div>

</x-layout>


