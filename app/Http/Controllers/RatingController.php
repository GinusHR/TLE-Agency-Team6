<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacature;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RatingController extends Controller
{
    public function index()
    {
        // If you need to show a list of ratings, implement here
    }

    public function create($vacatureId)
    {
        Log::debug('Create method reached in RatingController with vacature ID: ' . $vacatureId);

        // Check if the vacature exists
        $vacature = Vacature::find($vacatureId);
        if (!$vacature) {
            Log::error('Vacature with ID ' . $vacatureId . ' not found.');
            return redirect()->route('vacatures.index')->with('error', 'Vacature niet gevonden.');
        }

        // Fetch the user's application to ensure eligibility
        $user = Auth::user();
        $application = $vacature->applications()
            ->where('user_id', $user->id)
            ->whereHas('invitation', function ($query) {
                $query->where('declined', false);
            })->first();

        if (!$application) {
            Log::debug('User ' . $user->id . ' is not eligible to review the vacature ' . $vacatureId);
            return redirect()->route('vacatures.show', ['vacature' => $vacatureId])
                ->with('error', 'Je bent niet gemachtigd om deze vacature te beoordelen.');
        }

        // Show the review form
        return view('ratings.create', ['vacature' => $vacature]);
    }

    public function store(Request $request, Vacature $vacature)
    {
        Log::debug('Store method reached in RatingController for vacature ID: ' . $vacature->id);

        $validated = $request->validate([
            'rating' => 'required|numeric|min:0|max:5',
            'review' => 'nullable|string|max:1024',
        ]);

        $user = Auth::user();

        // Ensure the user is eligible to rate
        $application = $vacature->applications()
            ->where('user_id', $user->id)
            ->whereHas('invitation', function ($query) {
                $query->where('declined', false);
            })->first();

        if (!$application) {
            Log::debug('User ' . $user->id . ' is not eligible to rate the vacature ' . $vacature->id);
            return redirect()->route('vacatures.show', ['vacature' => $vacature->id])
                ->with('error', 'Je bent niet gemachtigd om deze vacature te beoordelen.');
        }

        // Save the rating
        Rating::create([
            'vacature_id' => $vacature->id,
            'user_id' => $user->id,
            'rating' => $validated['rating'],
            'review' => $validated['review'],
        ]);

        Log::debug('Rating successfully created for user ' . $user->id . ' and vacature ' . $vacature->id);

        return redirect()->route('vacatures.show', ['vacature' => $vacature->id])
            ->with('success', 'Beoordeling succesvol toegevoegd.');
    }

    public function show(string $id)
    {
        // You can implement this if necessary (e.g., show ratings for a vacature)
    }

    public function edit($id)
    {
        $rating = Rating::findOrFail($id);

        // Check if the logged-in user is the creator of the rating
        if (Auth::id() !== $rating->user_id) {
            return redirect()->route('vacatures.show', $rating->vacature_id)
                ->with('error', 'Je kunt deze beoordeling niet bewerken.');
        }

        return view('ratings.edit', compact('rating'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|numeric|min:0|max:5',
            'review' => 'required|string|max:1000',
        ]);

        $rating = Rating::findOrFail($id);

        // Ensure the logged-in user is the creator of the rating
        if (Auth::id() !== $rating->user_id) {
            return redirect()->route('vacatures.show', $rating->vacature_id)
                ->with('error', 'Je kunt deze beoordeling niet bewerken.');
        }

        $rating->update([
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->route('vacatures.show', $rating->vacature_id)
            ->with('success', 'Beoordeling succesvol bijgewerkt!');
    }

    public function destroy($id)
    {
        $rating = Rating::findOrFail($id);

        // Ensure the logged-in user is the creator of the rating
        if (Auth::id() !== $rating->user_id) {
            return redirect()->route('vacatures.show', $rating->vacature_id)
                ->with('error', 'Je kunt deze beoordeling niet verwijderen.');
        }

        $rating->delete();

        return redirect()->route('vacatures.show', $rating->vacature_id)
            ->with('success', 'Beoordeling succesvol verwijderd!');
    }
}
