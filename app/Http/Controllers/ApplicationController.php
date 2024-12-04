<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Mail\SollicitatieMailVWerkzoekende;

class ApplicationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->has('user_id')) {
            $user_id = Auth::user()->id;
            $email = Auth::user()->email;
        } else {
            $request->validate([
                'email' => 'required|string|max:255'
            ]);
            $email = $request->input('email');
        }
        $application = new Application();


        if ($request->has('user_id')) {
            $application->user_id = $user_id;
        } else {
            $application->email = $email;
        }

        if ($request->has('secondaryInfo')) {
            $application->secondary_info = $request->input('secondaryInfo');
        }
        $application->vacature_id = $request->input('vacature_id');

        $application->save();

        $company = $request->input('vacature_company');
        $function = $request->input('vacature_function');

        $details = [
            'company' => $company,
            'function' => $function
        ];

        Mail::to($email)->send(new SollicitatieMailVWerkzoekende($details));


        return Redirect::route('vacatures.show', $request->input('vacature_id'))
            ->with('success', 'Je ontvangt een email om te controleren of de sollicitatie is geslaagd!');
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
