<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-lg sm:text-sm" />
            <x-text-input id="email" class="block mt-1 w-full text-lg sm:text-sm" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Wachtwoord')" class="text-lg sm:text-sm" />

            <x-text-input id="password" class="block mt-1 w-full text-lg sm:text-sm"
                          type="password"
                          name="password"
                          required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Bevestig wachtwoord')" class="text-lg sm:text-sm" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full text-lg sm:text-sm"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div>
            <p class="text-lg sm:text-xs mt-4">Bij Open Hiring nemen we jouw privacy serieus. Jouw gegevens worden strikt vertrouwelijk behandeld en nooit gedeeld met derden. Werkgevers hebben geen toegang tot jouw persoonlijke informatie. Je kunt je met een gerust hart registreren.</p>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-lg sm:text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Al geregistreerd?') }}
            </a>

            <x-primary-button class="ms-4 text-lg sm:text-xs">
                {{ __('Registreer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
