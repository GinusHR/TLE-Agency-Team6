@vite(['resources/js/app.js', 'resources/css/app.css'])
<x-layout>
    <div class="flex justify-start items-center w-1/2 pl-10 pt-6">
        <a href="{{route('company.dashboard') }}"
           class="text-violet-light hover:text-violet-800 font-medium mb-6 inline-block">
            &larr; Terug naar Dashboard
        </a>
    </div>
    <div class="flex flex-col items-center min-h-screen bg-gray-50 py-10">
        <div class="w-full md:w-[70vw] bg-moss-light p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-center mb-6">Profiel Beheren</h1>
            <form method="POST" action="{{ route('company.update', $company->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="flex flex-row justify-evenly">
                    <div >
                        <input name="login_code" id="login_code" value="{{$company->login_code}}" hidden>
                        <input name="password" id="password" value="{{$company->password}}" hidden>
                        <div class="mb-4">
                            <label for="name" class="text-gray-700 font-medium mb-2">Bedrijfsnaam:</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="bg-cream w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-violet-light"
                                value="{{ $company->name }}">
                        </div>

                        <div class="mb-4">
                            <label for="homepage_url" class="text-gray-700 font-medium mb-2">Website url:</label>
                            <input
                                type="url"
                                name="homepage_url"
                                id="homepage_url"
                                class="bg-cream w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-violet-light"
                                value="{{ $company->homepage_url }}">
                        </div>

                        <div class="mb-4">
                            <label for="about_url" class="text-gray-700 font-medium mb-2">Over ons url:</label>
                            <input
                                type="url"
                                name="about_us_url"
                                id="about_us_url"
                                class="bg-cream w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-violet-light"
                                value="{{ $company->about_us_url }}">
                        </div>

                        <div class="mb-4">
                            <label for="contact_url" class="text-gray-700 font-medium mb-2">Contact url:</label>
                            <input
                                type="url"
                                name="contact_url"
                                id="contact_url"
                                class="bg-cream w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-violet-light"
                                value="{{ $company->contact_url }}">
                        </div>

                        <div class="mb-4">
                            <label for="description" class="text-gray-700 font-medium mb-2">Beschrijving:</label>
                            <textarea
                                type="text"
                                cols="35"
                                rows="13"
                                id="description"
                                class="bg-cream w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-violet-light"
                                name="description">{{ $company->description }} </textarea>
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <div class="mb-4">
                            <label for="image" class="text-gray-700 font-medium mb-2">Bedrijfs foto:</label>
                            <input
                                type="file"
                                name="image"
                                id="image"
                                class="bg-cream w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-violet-light"
                                src="{{$company->image}}">
                            @if($company->image)
                                <img class="mt-3 mb-4 rounded-lg w-48" src="{{asset('storage/'. $company->image)}}"
                                     alt="Bedrijfsfoto">
                            @endif
                        </div>

                        <div class="mb-6">
                            <label for="logo" class="text-gray-700 font-medium mb-2">Bedrijfs logo:</label>
                            <input
                                type="file"
                                name="logo"
                                id="logo"
                                class="bg-cream w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-violet-light"
                                src="{{$company->logo}}">
                            @if($company->image)
                                <img class="mt-3 mb-4 rounded-lg w-20" src="{{asset('storage/'. $company->logo)}}"
                                     alt="Bedrijfslogo">
                            @endif
                        </div>
                    </div>

                </div>


                <div class="flex justify-center">
                    <button
                        type="submit"
                        class="w-1/4 px-4 py-2 bg-violet-light text-white rounded-lg hover:bg-violet-dark">Opslaan
                    </button>
                </div>

            </form>
        </div>
    </div>

</x-layout>
