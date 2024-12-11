@vite(['resources/js/app.js', 'resources/css/app.css'])
<x-layout>
{{--    <x-slot name="header">--}}
        <div class="flex justify-between items-center px-4 sm:px-6 lg:px-8 mt-2 mb-0">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profiel wijzigen') }}
            </h2>
            <a href="{{ route('profile.show') }}" class="inline-flex items-center px-6 py-3 bg-violet-light border border-transparent rounded-md font-semibold text-xs text-cream uppercase tracking-widest hover:bg-violet-dark focus:bg-violet-dark active:bg-violet-dark focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Terug naar mijn profiel') }}
            </a>
        </div>
{{--    </x-slot>--}}

    <div class="py-12 bg-cream">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-cream shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-cream shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-demands-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-cream shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-cream shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-layout>
