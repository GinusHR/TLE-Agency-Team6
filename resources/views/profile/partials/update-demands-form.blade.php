<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Kwalificaties') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Je kwalificaties wijzigen.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.updateDemands') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="space-y-4">
            <h3 class="text-lg font-medium text-gray-900">{{ __('Selecteer je kwalificaties') }}</h3>

            @foreach ($demands as $demand)
                <div class="flex items-center">
                    <input id="demand_{{ $demand->id }}" name="demands[]" type="checkbox" value="{{ $demand->id }}"
                        @if ($user->demands->contains($demand->id)) checked @endif class="mr-2" />
                    <label for="demand_{{ $demand->id }}" class="text-gray-900">{{ $demand->name }}</label>
                </div>
            @endforeach
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Opslaan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Opgeslagen.') }}</p>
            @endif
        </div>
    </form>
</section>
