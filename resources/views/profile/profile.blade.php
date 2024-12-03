<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Profile') }}
            </h2>
            <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                {{ __('Edit Profile') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ __('My Applications') }}</h3>
                @if ($user->applications && $user->applications->isEmpty())
                    <p class="text-gray-600 dark:text-gray-400">{{ __("You haven't applied to a job yet") }}</p>
                @else
                    <ul class="list-disc pl-5">
                        @foreach (($user->applications ?? collect()) as $application)
                            <li>
                                <p class="text-gray-800 dark:text-gray-200">
                                    {{ $application->job_title ?? 'Unknown function' }} bij {{ $application->company_name ?? 'Unknown company' }}
                                    <span class="text-sm text-gray-500">{{ $application->created_at ? $application->created_at->format('d-m-Y') : 'Unknown date' }}</span>
                                </p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ __('My Reviews') }}</h3>
                @if ($user->reviews && $user->reviews->isEmpty())
                    <p class="text-gray-600 dark:text-gray-400">{{ __("You haven't placed any reviews") }}</p>
                @else
                    <ul class="list-disc pl-5">
                        @foreach (($user->reviews ?? collect()) as $review)
                            <li>
                                <p class="text-gray-800 dark:text-gray-200">
                                    {{ $review->content ?? 'No content' }}
                                    <span class="text-sm text-gray-500">- {{ $review->created_at ? $review->created_at->format('d-m-Y') : 'Unknown date' }}</span>
                                </p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
