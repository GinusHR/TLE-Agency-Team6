<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Demand;
use App\Models\Application;


class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $applications = Application::where('user_id', $user->id)
        ->orderBy('created_at')
        ->get();

        $userApplication = $applications->where('vacature_id', $user->vacature_id)->first();

        $position = $applications->search(function ($application) use ($userApplication) {
                return $application->id === $userApplication->id;
            }) + 1;

        return view('profile.show', compact('position', 'user'));
    }


    public function edit(Request $request): View
    {
        return view('profile.profileEdit', [
            'user' => $request->user(),
            'demands' => Demand::all()
        ]);
    }

    public function updateDemands(Request $request): RedirectResponse
    {
        $request->validate([
            'demands' => 'array|nullable',
            'demands.*' => 'exists:demands,id',
        ]);

        $user = auth()->user();

        $user->demands()->sync($request->input('demands', []));

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());



        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
