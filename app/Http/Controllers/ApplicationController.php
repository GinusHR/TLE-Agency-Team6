<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ApplicationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->has('user_id')) {
            $user_id = Auth::user()->id;
        } else {
            $request->validate([
                'email' => 'required|string|max:255'
            ]);
        }
        $application = new Application();


        if ($request->has('user_id')) {
            $application->user_id = $user_id;
        } else {
            $application->email = $request->input('email');
        }

        if ($request->has('secondaryInfo')) {
            $application->secondary_info = $request->input('secondaryInfo');
        }
        $application->vacature_id = $request->input('vacature_id');


        $application->save();

        return Redirect::route('vacatures.show', $request->input('vacature_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }
}
