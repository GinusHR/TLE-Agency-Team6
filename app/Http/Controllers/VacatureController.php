<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Vacature;
use Illuminate\Http\Request;

class VacatureController extends Controller {
    public function index() {
        $vacatures = Vacature::where('status', 1)->get();
        return view('vacatures',compact('vacatures') );
    }

    public function filter(Request $request) {

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
            })->with('company')->get();
        }

        if ($request->filled('filter')) {
            $value = $request->input('filter');
            $query->where(function ($q) use ($value) {

            });
        }

        $vacatures = $query->get();
        return view('vacatures', compact('vacatures'));
    }

    public function show($id) {

    }



}
