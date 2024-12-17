<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Vacature $vacature)
    {
        return view('ratings.create', compact('vacature'));
    }

    public function store(Request $request, Vacature $vacature)
    {
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
            return redirect()->route('vacatures.show', $vacature->id)
                ->with('error', 'Je bent niet gemachtigd om deze vacature te beoordelen.');
        }

        // Save the rating
        Rating::create([
            'vacature_id' => $vacature->id,
            'user_id' => $user->id,
            'rating' => $validated['rating'],
            'review' => $validated['review'],
        ]);

        return redirect()->route('vacatures.show', $vacature->id)
            ->with('success', 'Beoordeling succesvol toegevoegd.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
