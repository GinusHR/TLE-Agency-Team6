<?php

namespace App\Http\Controllers;

use App\Models\Vacature;
use App\Models\Day;
use App\Models\DayVacature;
use Illuminate\Http\Request;

class VacatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Retrieve all vacatures without any filters
        $vacatures = Vacature::paginate(10); // Adjust the number per page as needed

        // Pass the vacatures to the view
        return view('vacatures.index', compact('vacatures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vacatures = Vacature::all();
        $days = Day::all();
        return view('vacatures.create', compact('vacatures'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'function' => 'required|max:255',
            'salary' => 'required|numeric',
            'workhours' => 'required|numeric|min:0|max:80',
            'location' => 'nullable|string|max:255',
            'place' => 'required|string|max:255',
            'time_id' => 'required|boolean',
            'description' => 'required|max:1024',
            'secondary_info_needed' => 'required|boolean',
            'status' => 'required|integer|in:0,1',
            'days' => 'required|array', // Assuming this is an array of day IDs
        ]);

        // Create the new vacature and store it in the variable
        $newVacature = Vacature::create($validated);

        // Loop through each day in the 'days' array from the request
        foreach ($validated['days'] as $dayId) {
            // Check if the day already exists, or create it
            $day = Day::firstOrCreate(['id' => $dayId]);

            // Link the new day to the new vacature
            DayVacature::create(['day_id' => $day->id, 'vacature_id' => $newVacature->id]);
        }

        // Redirect back with a success message
        return redirect()->route('vacatures.index')->with('success', 'Vacature succesvol aangemaakt!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacature $vacature)
    {
        $companies = Vacature::all();
        $days = Day::all();
        $selectedDays = $vacature->days->pluck('id')->toArray(); // Get selected day IDs

        return view('vacatures.edit', compact('vacature', 'companies', 'days', 'selectedDays'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
