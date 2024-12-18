<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function show($hash, $id)
    {
        $invitation = Invitation::findOrFail($id);
        if ($hash === $invitation->url_hashed) {

            return view('invitations.show', [
                'invitation' => $invitation,
            ]);
        } else {
            return redirect()->route('homepage');
        }
    }

    public function acceptInvitation($hash, $id)
    {
        $invitation = Invitation::findOrFail($id);
        if ($hash === $invitation->url_hashed) {
            $invitation->declined = false;
            $invitation->save();

            return redirect()->route('homepage')->with('success', 'Je bent succesvol aangenomen!');
        } else {
            return redirect()->route('homepage');
        }
    }

    public function declineInvitation($hash, $id)
    {
        $invitation = Invitation::findOrFail($id);
        if ($hash === $invitation->url_hashed) {
            $invitation->declined = true;
            $invitation->save();

            return redirect()->route('homepage')->with('success', 'De aanvraag is succesvol geweigerd!');
        } else {
            return redirect()->route('homepage');
        }
    }

    public function changeInvitation($hash, $id, Request $request)
    {
        $request->validate([
            'workday' => 'required|date|after_or_equal:' . now()->addDays(2)->startOfDay(),
        ]);
        $invitation = Invitation::findOrFail($id);
        if ($hash === $invitation->url_hashed) {
            $invitation->declined = 2;

            //splits tijd en dag en laat het in de juiste format zien
            Carbon::setLocale('nl');
            $workdayTime = $request->input('workday');
            $workday = Carbon::parse($workdayTime)->translatedFormat('l j F Y');
            $worktime = Carbon::parse($workdayTime)->format('H:i');
            $invitation->day = $workday;
            $invitation->time = $worktime;

            $invitation->save();

            return redirect()->route('homepage')->with('success', 'De gekozen datum is succesvol doorgegeven!');
        } else {
            return redirect()->route('homepage');
        }
    }
}
