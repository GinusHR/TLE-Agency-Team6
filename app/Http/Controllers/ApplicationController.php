<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Mail\SollicitatieMailVWerkzoekende;
use Illuminate\Support\Facades\DB;

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
                'email' => 'required|email|max:255|unique:applications,email,NULL,id,vacature_id,' . $request->vacature_id,
            ], [
                'email.unique' => 'Dit e-mailadres is al in gebruik.',
            ]);
            $email = $request->input('email');

            $existingUser = \App\Models\User::where('email', $email)->exists();

            if ($existingUser) {
                return redirect()->back()->withErrors(['email' => 'Dit e-mailadres is al in gebruik.']);
            }
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
        $demands = $request->input('demands', []); // Ontvang demands als key-value paren

        // Itereer over de demands en voeg alleen false demands toe
        foreach ($demands as $demandId => $value) {
            if ($value === 'false') {
                DB::table('application_demands_not_met')->insert([
                    'application_id' => $application->id,
                    'demand_id' => $demandId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }


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
            ->with('success', 'Je ontvangt een email als de aanmelding is gelukt!');
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
        // Verwijder de sollicitatie
        $application->delete();

        // Redirect naar de pagina van sollicitaties of waar je maar wilt
        return redirect()->route('profile.show');

    }
}
