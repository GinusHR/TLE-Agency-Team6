@vite(['resources/js/app.js', 'resources/css/app.css'])

<x-layout>

    <body class="bg-cream">
    <div class="container mx-auto py-12">
        <h1 class="text-4xl font-bold text-center mb-6">Vacatures</h1>
        <div class="flex flex-col md:flex-row md:justify-between">
            <form action="{{ route('vacatures.filter') }}" method="post" class=" mb-6 md:mb-0">
                @csrf
                @method('PATCH')

                <div class="container md:flex justify-center">

                    <div>
                        <button id="demandsButton" data-dropdown-toggle="demands"
                                class="text-gray-100 bg-violet-light hover:bg-violet-dark focus:ring-2 focus:outline-none focus:ring-indigo-500 font-medium rounded-lg text-sm px-5 py-2.5  inline-flex items-center justify-between md:mt-6 md:w-60 md:max-w-[12vw]"
                                type="button">Eisen
                            <svg class="w-2.5 h-2.5 ml-2" aria-hidden="true" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const button = document.getElementById('demandsButton');
                                const dropdown = document.getElementById('demands');
                                const dropdownDemand = document.getElementById('dropdownDemand');

                                button.addEventListener('click', function() {
                                    dropdown.classList.toggle('hidden');
                                });
                                dropdownDemand.addEventListener('click', function() {
                                    dropdownDemand.classList.toggle('bg-moss-light');
                                });
                            });
                        </script>
                        <div id="demands" class="z-10 hidden w-60 bg-violet-light rounded-lg shadow-lg absolute">
                            <ul class="p-3 space-y-1 text-sm text-gray-300">
                                @foreach ($demands as $demand)
                                    <li>
                                        <label for="demand[{{ $demand->id }}]" id="dropdownDemand"
                                               class="flex items-center space-x-2 p-2 rounded text-sm font-medium text-gray-100 hover:bg-violet-dark has-[:checked]:bg-moss-light has-[:checked]:text-black cursor-pointer">
                                            <input id="demand[{{ $demand->id }}]" type="checkbox"
                                                   value="{{ $demand->id }}" name="demands[]"
                                                   class="w-4 h-4 text-violet-light bg-gray-900 border-gray-600 rounded focus:ring-violet-light">
                                            <span>
                                    {{ $demand->name }}
                                </span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="mb-4 md:w-60 md:ml-5">
                        <label for="uren" class="block text-sm font-medium text-gray-700">Uren</label>
                        <select name="uren" id="uren"
                                class="mt-1 px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 w-full">
                            <option value="" disabled selected>Kies aantal uur</option>
                            <option value="0">0-10</option>
                            <option value="10">10-20</option>
                            <option value="20">20-30</option>
                            <option value="30">30-40</option>
                            <option value="40">40+</option>
                        </select>
                    </div>
                    <div class="mb-4 md:w-60 md:ml-5">
                        <label for="salaris" class="block text-sm font-medium text-gray-700">Salaris</label>
                        <select name="salaris" id="salaris"
                                class="mt-1 px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 w-full">
                            <option value="" disabled selected>Kies een salaris</option>
                            <option value="1">0-500</option>
                            <option value="2">500-1000</option>
                            <option value="3">1100-1500</option>
                            <option value="4">1600-2000</option>
                            <option value="5">2100-2500</option>
                            <option value="6">2600-3000</option>
                            <option value="7">3100+</option>
                        </select>
                    </div>
                    <div class="mb-4 md:w-60 md:ml-5">
                        <label for="sort" class="block text-sm font-medium text-gray-700">Sorteren</label>
                        <select name="sort" id="sort"
                                class="mt-1 px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 w-full">
                            <option value="newest" {{ $previousSearch->sort === 'newest' ? 'selected' : '' }}>Meest
                                recent</option>
                            <option value="oldest" {{ $previousSearch->sort === 'oldest' ? 'selected' : '' }}>Minst
                                recent</option>
                            <option value="highest" {{ $previousSearch->sort === 'highest' ? 'selected' : '' }}>Salaris
                                Hoogst-Minst</option>
                            <option value="lowest" {{ $previousSearch->sort === 'lowest' ? 'selected' : '' }}>Salaris
                                Minst-Hoogst</option>
                        </select>
                    </div>


                    <div class="mb-4 md:w-60 md:ml-5">
                        <label for="search" class="block text-sm font-medium text-gray-700">Zoeken</label>
                        <input type="text" name="search" id="search" value="{{ $previousSearch->search }}"
                               class="mt-1 px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 w-full">
                    </div>


                    <button type="submit"
                            class="md:w-60 md:ml-5 bg-violet-light text-white py-2.5 md:max-h-[2.61rem]  rounded-md hover:bg-violet-dark mt-4 md:mt-6">Zoeken
                    </button>
                </div>




            </form>
            {{--            <a href="{{ route('vacatures.create') }}" id="create-vacature-link"--}}
            {{--               class="mt-6 md:mt-0 md:ml-6 inline-block bg-yellow text-black py-2 px-4 rounded-md hover:bg-violet-light">Maak--}}
            {{--                een vacature aan</a>--}}
        </div>
        <h2 class="text-2xl font-semibold mt-8">Vacatures</h2>
        @if ($vacatures->isEmpty())
            <p class="mt-4">Geen vacatures gevonden</p>
        @else
            <ul class="mt-4 space-y-4">
                @foreach ($vacatures as $vacature)
                    @if ($vacature->status == 1)
                        <li class="bg-moss-light border-2 border-gray-300 rounded-lg shadow-md p-4">
                            <div class="flex justify-between items-center">
                                <h3 class="text-xl font-bold">{{ $vacature->company->name }}</h3>
                                <button
                                    class="toggle-btn text-2xl font-bold text-gray-500 hover:text-gray-700"
                                    data-collapse="true">+
                                </button>
                            </div>
                            <div class="details mt-2 space-y-2 hidden">
                                <p class="text-sm"><span class="font-semibold">Functie:</span> {{ $vacature->function }}</p>
                                <p class="text-sm"><span class="font-semibold">Maand Salaris:</span> &euro; {{ number_format($vacature->salary, 2, ',', '.') }}</p>
                                <p class="text-sm"><span class="font-semibold">Locatie:</span> {{ $vacature->location }}</p>
                                <p class="text-sm"><span class="font-semibold">Contract:</span> {{ $vacature->time_id ? 'Fulltime' : 'Parttime' }}</p>
                                <p class="text-sm"><span class="font-semibold">Opleidings Niveau:</span>
                                    @switch($vacature->education)
                                        @case(1)
                                            N.V.T.
                                            @break
                                        @case(2)
                                            Middelbare School
                                            @break
                                        @case(3)
                                            MBO
                                            @break
                                        @case(4)
                                            HBO
                                            @break
                                        @case(5)
                                            Universitair
                                            @break
                                        @default
                                            Onbekend
                                    @endswitch
                                </p>
                                <p class="text-sm"><span class="font-semibold">Dagen:</span>
                                    @php
                                        $daysArray = json_decode($vacature->days, true);
                                    @endphp
                                    @if (is_null($daysArray) || empty($daysArray))
                                        Geen dagen beschikbaar
                                    @else
                                        {{ implode(', ', $daysArray) }}
                                    @endif
                                </p>
                                <div class="bg-info-gray text-sm p-4 rounded-md border-2 border-[#B9B9B9]">
                                    {{ $vacature->description }}
                                </div>
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <button class="bg-violet-light text-white py-2 px-4 rounded-md hover:bg-violet-dark">
                                    <a href="{{ route('vacatures.show', $vacature->id) }}">Details</a>
                                </button>
                                {{--                                <button class="bg-yellow text-black py-2 px-4 rounded-md hover:bg-violet-light">--}}
                                {{--                                    <a href="{{ route('vacatures.edit', $vacature->id) }}">Edit</a>--}}
                                {{--                                </button>--}}
                                {{--                                <form action="{{ route('vacatures.destroy', $vacature->id) }}" method="POST" class="inline-block">--}}
                                {{--                                    @csrf--}}
                                {{--                                    @method('DELETE')--}}
                                {{--                                    <button type="submit"--}}
                                {{--                                            class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600"--}}
                                {{--                                            onclick="return confirm('Weet je zeker dat je deze vacature wilt verwijderen?');">Delete</button>--}}
                                {{--                                </form>--}}
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const toggleButtons = document.querySelectorAll('.toggle-btn');

                    toggleButtons.forEach(button => {
                        button.addEventListener('click', function () {
                            const isCollapsed = button.getAttribute('data-collapse') === 'true';
                            const details = button.closest('li').querySelector('.details');

                            if (isCollapsed) {
                                details.classList.remove('hidden');
                                button.textContent = '-';
                            } else {
                                details.classList.add('hidden');
                                button.textContent = '+';
                            }

                            button.setAttribute('data-collapse', !isCollapsed);
                        });
                    });
                });
            </script>
        @endif
    </div>
    </body>
</x-layout>
