<?php

namespace App\Http\Controllers;

use App\Models\Vacature;
use Illuminate\Http\Request;

class VacatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacature $vacature)
    {
        return view('vacatures.show', ['vacature' => $vacature]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacature $vacature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vacature $vacature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacature $vacature)
    {
        //
    }
}
