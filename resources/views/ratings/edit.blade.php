@vite(['resources/css/app.css', 'resources/js/app.js'])

<x-layout>
    <div class="bg-cream min-h-screen flex items-center justify-center">
        <form action="{{ route('ratings.update', $rating->id) }}" method="POST" class="bg-cream p-8-plus rounded-lg shadow-custom-light mx-auto max-w-3xl">
            @csrf
            @method('PUT')

            <h1 class="text-2.5xl font-bold text-moss-dark mb-6">Beoordeling Bewerken</h1>

            <!-- Grid Layout -->
            <div class="grid grid-cols-1 gap-6">
                <!-- Rating Field -->
                <div class="mb-4">
                    <label for="rating" class="block text-moss-dark font-bold text-xl mb-1">Rating (0-5) <span class="text-red-500">*</span></label>
                    <input type="number" name="rating" id="rating" value="{{ $rating->rating }}" step="0.1" min="0" max="5" required
                           class="w-full p-4 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none placeholder-black">
                </div>

                <!-- Review Field -->
                <div class="mb-4">
                    <label for="review" class="block text-moss-dark font-bold text-xl mb-1">Review</label>
                    <textarea name="review" id="review" rows="4"
                              class="w-full p-4 bg-moss-light rounded-lg focus:ring-2 focus:ring-moss-medium focus:outline-none placeholder-black">{{ $rating->review }}</textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button type="submit"
                        class="bg-violet-light text-white font-bold rounded-lg shadow-custom-dark hover:bg-violet-dark focus:ring-2 focus:ring-violet-dark py-3 px-8">
                    Beoordeling Bijwerken
                </button>
            </div>
        </form>
    </div>
</x-layout>
