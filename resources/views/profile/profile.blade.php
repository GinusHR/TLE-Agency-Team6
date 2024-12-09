<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Mijn profiel') }}
            </h2>
            <div class="flex gap-4">
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        {{ __('Uitloggen') }}
                    </button>
                </form>
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    {{ __('Wijzig profiel') }}
                </a>
            </div>
        </div>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ __('Mijn sollicitaties') }}</h3>
                @if (optional($user->applications)->isEmpty())
                    <p class="text-gray-600 dark:text-gray-400">{{ __("Je hebt nog niet gesolliciteerd") }}</p>
                @else
                    <ul class="list-disc pl-5">
                        @foreach ($user->applications as $application)
                            <li class="flex justify-between items-center py-2">
                                <p class="text-gray-800 dark:text-gray-200">
                                    {{ $application->vacature->function ?? 'Onbekende functie' }} bij {{ $application->vacature->company->name ?? 'Onbekend bedrijf' }}
                                </p>
                                <div class="flex items-center space-x-4">
                                <span class="text-sm text-gray-500">
                                        Gesolliciteerd op: {{ $application->created_at ? $application->created_at->format('d-m-Y') : 'Onbekende datum' }}
                                </span>
                                    <button class="inline-block px-6 py-3 bg-violet-light text-white rounded-lg text-sm hover:bg-violet-dark">
                                        <a href="{{ route('vacatures.show', $application->vacature_id) }}" class="no-underline">Zie vacature</a>
                                    </button>
                                </div>
                            </li>

                        @endforeach
                    </ul>
                @endif

            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ __('Mijn beoordelingen') }}</h3>
                @if ($user->reviews && $user->reviews->isEmpty())
                    <p class="text-gray-600 dark:text-gray-400">{{ __("Je hebt nog niks beoordeeld") }}</p>
                @else
                    <ul class="list-disc pl-5">
                        @foreach (($user->reviews ?? collect()) as $review)
                            <li>
                                <p class="text-gray-800 dark:text-gray-200">
                                    {{ $review->content ?? 'Geen inhoud' }}
                                    <span class="text-sm text-gray-500">- {{ $review->created_at ? $review->created_at->format('d-m-Y') : 'Onbekende datum' }}</span>
                                </p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
