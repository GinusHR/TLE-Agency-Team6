<?php

namespace App\Http\Controllers;

use App\Models\Vacature;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        return view('vacatures.create', compact('vacatures')); // Pass both variables to the view
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
            'days' => 'required|array|min:1|max:7', // Ensure at least 1 and at most 7 days
            'days.*' => 'in:Maandag,Dinsdag,Woensdag,Donderdag,Vrijdag,Zaterdag,Zondag', // Validate individual days
        ]);

        // Create the new vacature
        $newVacature = Vacature::create($validated);

        // Store the days of the week as JSON
        $newVacature->days = json_encode($validated['days']);
        $newVacature->save();

        // Redirect back with a success message
        return redirect()->route('vacatures.index')->with('success', 'Vacature succesvol aangemaakt!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $vacature = Vacature::findOrFail($id); // This will throw a ModelNotFoundException if not found
            $days = json_decode($vacature->days, true); // Decode JSON to array

            return response()->json([
                'vacature' => $vacature,
                'days_of_week' => $days
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Vacature not found.'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacature $vacature)
    {
        $companies = Vacature::all();
        $selectedDays = json_decode($vacature->days, true); // Decode JSON to get selected days

        return view('vacatures.edit', compact('vacature', 'companies', 'selectedDays'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // You can implement the update logic here
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // You can implement the destroy logic here
    }
}
