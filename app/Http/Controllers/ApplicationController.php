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
        //check of gebruiker een account heeft en gebruik email van account of ingevulde email
        if ($request->has('user_id')) {
            $user_id = Auth::user()->id;
            $email = Auth::user()->email;
        } else {
            $request->validate([
                'email' => 'required|string|max:255'
            ]);
            $email = $request->input('email');
        }
        //maak een application aan
        $application = new Application();

        //gebruik user_id of email
        if ($request->has('user_id')) {
            $application->user_id = $user_id;
        } else {
            $application->email = $email;
        }

        //als de vacature secondary informatie nodig had de info opslaan
        if ($request->has('secondaryInfo')) {
            $application->secondary_info = $request->input('secondaryInfo');
        }
        $application->vacature_id = $request->input('vacature_id');
        //sla application op
        $application->save();

        //voeg de extra eisen waar niet aan zijn voldaan toe aan de aaplication_demands_not_met table



        //vraag gegevens op voor de mail
        $company = $request->input('vacature_company');
        $function = $request->input('vacature_function');
        $details = [
            'company' => $company,
            'function' => $function
        ];
        //stuur mail
        Mail::to($email)->send(new SollicitatieMailVWerkzoekende($details));
        //stuur gebruiker terug naar de vacaturepagina
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
