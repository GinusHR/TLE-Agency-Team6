<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
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

    public function changeInvitation($hash, $id)
    {
        $invitation = Invitation::findOrFail($id);
        if ($hash === $invitation->url_hashed) {
            //
        } else {
            return redirect()->route('homepage');
        }
    }
}
