<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Demand;
use App\Models\Vacature;
use Illuminate\Http\Request;

class VacatureController extends Controller {
    public function index(Request $request) {
        $vacatures = Vacature::where('status', 1)->get();
        $demands = Demand::all();
        $previousSearch = $request;
        return view('vacatures',compact('vacatures','previousSearch', 'demands') );
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
                $q->whereBetween('salary', [0,500]);
            })->when($pay === '2', function ($q) {
                $q->whereBetween('salary', [500,1000]);
            })->when($pay === '3', function ($q) {
                $q->whereBetween('salary', [1000,1500]);
            })->when($pay === '4', function ($q) {
                $q->whereBetween('salary', [1500,2000]);
            })->when($pay === '5', function ($q) {
                $q->whereBetween('salary', [2000,2500]);
            })->when($pay === '6', function ($q) {
                $q->whereBetween('salary', [2500,3000]);
            })->when($pay === '7', function ($q) {
                $q->where('salary', '>=', 3000);
            });
        }

        if ($request->input('sort')==='oldest') {
            $query->orderBy('id', 'ASC');
        } elseif($request->input('sort')==='newest') {
            $query->orderBy('id', 'DESC');
        } elseif ($request->input('sort')==='highest') {
            $query->orderBy('salary', 'DESC');
        } elseif ($request->input('sort')==='lowest') {
            $query->orderBy('id', 'ASC');
        }

        if($request->filled('demands')) {
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

    public function show($id) {

    }



}
