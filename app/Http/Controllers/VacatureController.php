<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Demand;
use App\Models\Vacature;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class VacatureController extends Controller
{
    public function index(Request $request)
    {
        $vacatures = Vacature::where('status', 1)->get();
        $demands = Demand::all();
        $previousSearch = $request;
        // Pass the vacatures to the view
        return view('vacatures.index', compact('vacatures', 'previousSearch', 'demands'));
    }

    public function filter(Request $request)
    {
        $query = Vacature::query();
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('location', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%")
                    ->orWhere('function', 'LIKE', "%{$search}%")
                    ->orWhereHas('company', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%");
                    });
            });
        }
        if ($request->filled('uren')) {
            $hours = $request->input('uren');
            $query->when($hours === '0', function ($q) {
                $q->whereBetween('workhours', [0, 10]);
            })->when($hours === '10', function ($q) {
                $q->whereBetween('workhours', [10, 20]);
            })->when($hours === '20', function ($q) {
                $q->whereBetween('workhours', [20, 30]);
            })->when($hours === '30', function ($q) {
                $q->whereBetween('workhours', [30, 40]);
            })->when($hours === '40', function ($q) {
                $q->where('workhours', '>=', 40);
            });
        }

        if ($request->filled('salaris')) {
            $pay = $request->input('salaris');
            $query->when($pay === '1', function ($q) {
                $q->whereBetween('salary', [0, 500]);
            })->when($pay === '2', function ($q) {
                $q->whereBetween('salary', [500, 1000]);
            })->when($pay === '3', function ($q) {
                $q->whereBetween('salary', [1100, 1500]);
            })->when($pay === '4', function ($q) {
                $q->whereBetween('salary', [1600, 2000]);
            })->when($pay === '5', function ($q) {
                $q->whereBetween('salary', [2100, 2500]);
            })->when($pay === '6', function ($q) {
                $q->whereBetween('salary', [2600, 3000]);
            })->when($pay === '7', function ($q) {
                $q->where('salary', '>=', 3100);
            });
        }

        if ($request->input('sort') === 'oldest') {
            $query->orderBy('id', 'ASC');
        } elseif ($request->input('sort') === 'newest') {
            $query->orderBy('id', 'DESC');
        } elseif ($request->input('sort') === 'highest') {
            $query->orderBy('salary', 'DESC');
        } elseif ($request->input('sort') === 'lowest') {
            $query->orderBy('id', 'ASC');
        }

        if ($request->filled('demands')) {
            $demands = $request->input('demands');
            $query->whereHas('demand', function ($q) use ($demands) {
                $q->whereIn('name', $demands);
            });
        }

        $vacatures = $query->with('company')->with('demand')->get();
        $previousSearch = $request;
        $demands = Demand::all();
        return view('vacatures', compact('vacatures', 'previousSearch', 'demands'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $vacature = Vacature::findOrFail($id); // This will throw a ModelNotFoundException if not found
            $days = json_decode($vacature->days, true); // Decode JSON to array
            return view('vacatures.show', [
                'vacature' => $vacature,
            ]);
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vacatures = Vacature::all();
        return view('vacatures.create', compact('vacatures')); // Pass both variables to the view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Step 1: Validate the incoming request data
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'function' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'workhours' => 'required|numeric|min:0|max:80',
            'location' => 'nullable|string|max:255',
            'place' => 'required|string|max:255',
            'time_id' => 'required|boolean',
            'description' => 'required|string|max:1024',
            'secondary_info_needed' => 'required|boolean',
            'status' => 'required|integer|in:0,1',
            'days' => 'required|array|min:1|max:7',
            'days.*' => 'in:Maandag,Dinsdag,Woensdag,Donderdag,Vrijdag,Zaterdag,Zondag',
        ]);

        // Step 2: Find the existing Vacature record by its ID
        $vacature = Vacature::findOrFail($id);

        // Step 3: Update the record with the validated data, including JSON-encoded days
        $vacature->update(array_merge($validated, [
            'days' => json_encode($validated['days']), // Encode days as JSON
        ]));

        // Step 4: Redirect the user with a success message
        return redirect()->route('vacatures.index')->with('success', 'Vacature succesvol bijgewerkt.');
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

        // Create the new vacature with days encoded as JSON
        $newVacature = Vacature::create(array_merge($validated, [
            'days' => json_encode($validated['days']), // Encode days as JSON
        ]));

        // Redirect back with a success message
        return redirect()->route('vacatures.index')->with('success', 'Vacature succesvol aangemaakt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the vacature by ID
        $vacature = Vacature::findOrFail($id);

        // Delete the vacature and all related records will be deleted automatically
        $vacature->delete();

        // Redirect back with a success message
        return redirect()->route('vacatures.index')->with('success', 'Vacature succesvol verwijderd.');
    }
}
