<x-layout>
    <main class="min-h-full mb-40 md:mb-1">
        <div class="flex justify-between items-center px-4 sm:px-6 lg:px-8 mt-2 mb-0">
            <h2 class="font-semibold text-xl md:text-2xl text-gray-800 leading-tight">
                {{ __('Mijn profiel') }}
            </h2>
            <div class="flex gap-4 flex-nowrap">
                <form method="POST" action="{{ route('logout') }}" class="inline"
                    onsubmit="return confirm('Weet je zeker dat je wilt uitloggen?');">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-3 py-3 md:px-6 md:py-4 bg-violet-light border border-transparent rounded-md font-semibold text-[0.6rem] md:text-xs text-cream uppercase tracking-widest hover:bg-violet-dark focus:bg-violet-dark active:bg-violet-dark focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Uitloggen') }}
                    </button>

                <a href="{{ route('profile.edit') }}"
                   class="inline-flex items-center px-3 py-3 md:px-6 md:py-4 bg-violet-light border border-transparent rounded-md font-semibold text-[0.6rem] md:text-xs text-cream uppercase tracking-widest hover:bg-violet-dark focus:bg-violet-dark active:bg-violet-dark focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Wijzig profiel') }}
                </a>
            </form>
        </div>
    </div>

    <div class="py-12 bg-cream">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-moss-light shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center sm:text-left">{{ __('Mijn sollicitaties') }}</h3>
                @if (optional($user->applications->where('accepted', 0))->isEmpty())

                <div class="flex justify-between">
                        <p class="text-gray-600">{{ __('Je hebt nog niet gesolliciteerd') }}</p>
                        <a href="/vacatures"
                           class="inline-flex items-center text-center px-4 py-2 md:px-6 md:py-3  bg-violet-light border border-transparent rounded-md font-semibold text-[0.6rem] md:text-xs text-cream uppercase tracking-widest hover:bg-violet-dark focus:bg-violet-dark active:bg-violet-dark focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Openstaande vacatures
                        </a>
                    </div>

                @else
                    <ul class="list-none space-y-2">
                        @foreach ($user->applications as $application)
                            @if ($application->accepted === 0)
                                <li class="border rounded-lg p-4 shadow bg-cream flex flex-col sm:flex-row justify-between items-start sm:items-center py-2">
                                    <p class="text-gray-800 text-lg sm:text-xl">
                                        {{ $application->vacature->function ?? 'Onbekende functie' }} bij
                                        {{ $application->vacature->company->name ?? 'Onbekend bedrijf' }}
                                    </p>
                                    <div class="flex items-center space-x-4 mt-2 sm:mt-0">
                                    <span class="text-gray-800 whitespace-nowrap">
                                        Plek in de wachtrij:
                                        <br class="block sm:hidden">
                                        @php
                                            $applications = $application->vacature->applications->where('accepted', 0);
                                            $position = $applications
                                                ->filter(function ($app) use ($application) {
                                                    return $app->id <= $application->id;
                                                })
                                                ->count();
                                        @endphp
                                        {{ $position }} / {{ $applications->count() }}
                                    </span>
                                        <span class="text-sm text-gray-500">
                                        Gesolliciteerd op:
                                        {{ $application->created_at ? $application->created_at->format('d-m-Y') : 'Onbekende datum' }}
                                    </span>
                                        <div class="flex flex-col md:flex-row gap-3">
                                            <button
                                                class="inline-flex items-center px-4 py-2 md:px-6 md:py-3 md:text-xs bg-violet-light border border-transparent rounded-md font-semibold text-[0.6rem] text-cream uppercase tracking-widest hover:bg-violet-dark focus:bg-violet-dark active:bg-violet-dark focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                <a href="{{ route('vacatures.show', $application->vacature_id) }}"
                                                   class="no-underline">Zie vacature</a>
                                            </button>

                                            <form action="{{ route('applications.destroy', $application->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Weet je zeker dat je deze sollicitatie wilt annuleren?')">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center px-4 py-2 md:px-6 md:py-3  bg-violet-light border border-transparent rounded-md font-semibold text-[0.6rem] md:text-xs text-cream uppercase tracking-widest hover:bg-violet-dark focus:bg-violet-dark active:bg-violet-dark focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Sollicitatie annuleren
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif

            </div>


            <div class="p-4 sm:p-8 bg-moss-light shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center sm:text-left">{{ __('Mijn banen') }}</h3>
                @if (optional($invitation)->isEmpty())
                    <div class="flex justify-between">
                        <p class="text-gray-600">{{ __('Je hebt nog geen baan via Open Hiring') }}</p>
                        <a href="/vacatures"
                           class="inline-flex items-center text-center px-4 py-2 md:px-6 md:py-3  bg-violet-light border border-transparent rounded-md font-semibold text-[0.6rem] md:text-xs text-cream uppercase tracking-widest hover:bg-violet-dark focus:bg-violet-dark active:bg-violet-dark focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Openstaande vacatures
                        </a>
                    </div>

                @else
                    <ul class="list-none space-y-2">
                        @foreach ($invitation as $job)
                            <li class="border rounded-lg p-4 shadow bg-cream flex flex-col sm:flex-row justify-between items-start sm:items-center py-2">
                                <p class="text-gray-800 text-lg sm:text-xl w-full sm:w-1/3 truncate">
                                    {{ $job->application->vacature->function ?? 'Onbekende functie' }} bij
                                    {{ $job->application->vacature->company->name ?? 'Onbekend bedrijf' }}
                                </p>

                                <div class="flex items-center space-x-4 mt-2 sm:mt-0">
                                    <div class="flex flex-col sm:flex-row sm:space-x-4">
                                        @if ($job->application->vacature->ratings->isNotEmpty())
                                            <span>Je hebt deze baan een {{ $job->application->vacature->ratings->first()->rating ?? 'Geen cijfer gegeven' }} uit 5 gegeven </span>
                                        @else
                                            <span>Je hebt deze baan nog niet beoordeeld</span>
                                        @endif
                                        <span class="text-sm text-gray-500">
                                            Aangenomen op: {{ $job->updated_at ? $job->updated_at->format('d-m-Y') : 'Onbekende datum' }}
                                        </span>
                                    </div>

                                    <div class="flex flex-col sm:flex-row gap-3 mt-3 sm:mt-0 sm:ml-auto">
                                        <button
                                            class="inline-flex items-center px-4 py-2 md:px-6 md:py-3 md:text-xs bg-violet-light border border-transparent rounded-md font-semibold text-[0.6rem] text-cream uppercase tracking-widest hover:bg-violet-dark focus:bg-violet-dark active:bg-violet-dark focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            <a href="{{ route('vacatures.show', $job->application->vacature_id) }}"
                                               class="no-underline">Zie vacature</a>
                                        </button>

                                        @if ($job->application->vacature->ratings->isEmpty())
                                            <button
                                                class="inline-flex items-center px-4 py-2 md:px-6 md:py-3 md:text-xs bg-violet-light border border-transparent rounded-md font-semibold text-[0.6rem] text-cream uppercase tracking-widest hover:bg-violet-dark focus:bg-violet-dark active:bg-violet-dark focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                <a href="{{ route('ratings.create', ['vacature' => $job->application->vacature->id]) }}"
                                                   class="no-underline">Plaats beoordeling</a>
                                            </button>
                                        @else
                                            <form
                                                action="{{ route('ratings.edit', ['rating' => $job->application->vacature->ratings->first()->id ?? 'Geen rating']) }}"
                                                method="GET">
                                                <button type="submit"
                                                        class="inline-flex items-center px-4 py-2 md:px-6 md:py-3 md:text-xs bg-violet-light border border-transparent rounded-md font-semibold text-[0.6rem] text-cream uppercase tracking-widest hover:bg-violet-dark focus:bg-violet-dark active:bg-violet-dark focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Beoordeling bewerken
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </li>

                        @endforeach
                    </ul>
                @endif

            </div>


            <div class="p-4 sm:p-8 bg-moss-light shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center sm:text-left">{{ __('Mijn beoordelingen') }}</h3>
                @if (optional($user->ratings)->isEmpty())
                    <div class="flex justify-left">
                        <p class="text-gray-600">{{ __('Je hebt nog niets beoordeeld') }}</p>
                    </div>

                @else
                    <ul class="list-none space-y-2">
                        @foreach ($user->ratings as $rating)
                            <li class="border rounded-lg p-4 shadow bg-cream flex-col sm:flex-row justify-between items-start sm:items-center py-2">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center py-2">
                                    <p class="text-gray-800 text-lg sm:text-xl">
                                        {{ $rating->vacature->function ?? 'Onbekende functie' }} bij
                                        {{ $rating->vacature->company->name ?? 'Onbekend bedrijf' }}
                                    </p>
                                    <div class="flex items-center space-x-4 mt-2 sm:mt-0">

                                        <span class="text-lg sm:text-xl whitespace-nowrap mr-6">{{ $rating->rating ?? 'Geen cijfer' }} / 5 </span>

                                        <span class="text-sm text-gray-500">
                                        Beoordeeld op:
                                        {{ $rating->created_at ? $rating->created_at->format('d-m-Y') : 'Onbekende datum' }}
                                        </span>
                                        <div class="flex flex-col md:flex-row gap-3">
                                            <button
                                                class="inline-flex items-center px-4 py-2 md:px-6 md:py-3 md:text-xs bg-violet-light border border-transparent rounded-md font-semibold text-[0.6rem] text-cream uppercase tracking-widest hover:bg-violet-dark focus:bg-violet-dark active:bg-violet-dark focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                <a href="{{ route('vacatures.show', $rating->vacature_id) }}"
                                                   class="no-underline">Zie vacature</a>
                                            </button>
                                            <form action="{{ route('ratings.edit', ['rating' => $rating->id]) }}"
                                                  method="GET">
                                                <button type="submit"
                                                        class="inline-flex items-center px-4 py-2 md:px-6 md:py-3 md:text-xs bg-violet-light border border-transparent rounded-md font-semibold text-[0.6rem] text-cream uppercase tracking-widest hover:bg-violet-dark focus:bg-violet-dark active:bg-violet-dark focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Beoordeling bewerken
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-row text-gray-800">
                                    <span class="truncate max-w-full" title="{{ $rating->review }}">
                                        {{ Str::limit($rating->review, 50, '...') ?? 'Geen inhoud' }}
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif

            </div>


        </div>
    </div>
</x-layout>
