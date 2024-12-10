<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Mail\acceptApplicantsMail;
use App\Mail\AfwijzingsmailDoorEisen;
use App\Models\Application;
use App\Models\Invitation;
use App\Models\Vacature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CompanyDashboardController extends Controller
{
    public function index()
    {
        if (Auth::guard('company')->user()) {
            $vacatures = Vacature::where('company_id', Auth::guard('company')->user()->id)->get();
            return view('company.dashboard', compact('vacatures'));
        } else {
            return redirect('/company/login');
        }
    }

    public function profile()
    {
        if (Auth::guard('company')->user()) {
            $company = Auth::guard('company')->user();
            return view('company.profile', compact('company'));
        } else {
            return redirect('/company/login');
        }
    }

    public function updateProfile(Request $request)
    {
        if (Auth::guard('company')->user()) {
            $company = Auth::guard('company')->user();

            $request->validate([
                'name' => 'required|string|max:255',
                'homepage_url' => 'nullable|url',
                'about_us_url' => 'nullable|url',
                'contact_url' => 'nullable|url',
                'description' => 'nullable|string',
                'image' => 'nullable|image',
                'logo' => 'nullable|image',
            ]);

            $company->update($request->only([
                'name',
                'homepage_url',
                'about_us_url',
                'contact_url',
                'description',
                'image',
                'logo'
            ]));

            return redirect()->route('company.dashboard')->with('success', 'Profiel succesvol bijgewerkt!');
        } else {

            return redirect('/company/login');
        }
    }

    public function openCloseVacature($id)
    {
        $vacature = Vacature::findOrFail($id);

        $vacature->status = !$vacature->status;

        $company_id = Auth::guard('company')->user()->id;
        $vacature->company_id = $company_id;

        $vacature->save();

        return redirect()->route('company.dashboard');
    }

    public function rejectApplicantForDemands(string $id)
    {
        $application = Application::findOrFail($id);

        $application->delete();

        //vraag gegevens op voor de mail
        if (empty($application->user_id)) {
            $email = $application->email;
        } else {
            $email = $application->user->email;
        }
        $company = $application->vacature->company->name;
        $function = $application->vacature->function;
        $details = [
            'company' => $company,
            'function' => $function
        ];
        //stuur mail
        Mail::to($email)->send(new AfwijzingsmailDoorEisen($details));

        return redirect()->route('company.dashboard');
    }

    public function acceptApplicants($id, Request $request)
    {
        $applicantsAmount = $request->input('acceptApplicants');

        $vacature = Vacature::findOrFail($id);

        $counter = 0;
        foreach ($vacature->applications->where('accepted', 0) as $key => $application) {
            if ($counter >= $applicantsAmount) {
                break; //hiermee stopt de foreach loop als het aantal doorgegeven is applicanten is bereikt
            }

            $application->accepted = 1;
            $application->save();

            //maak invitation
            $invitation = new Invitation();
            $invitation->application_id = $application->id;
            if ($request->has('workday')) {
                $workday = $request->input('workday');
                $invitation->day = $workday;
            } else {
                $workday = 0;
            }

            $invitation->save();

            //vraag gegevens op voor de mail
            if (empty($application->user_id)) {
                $email = $application->email;
            } else {
                $email = $application->user->email;
            }
            $company = $application->vacature->company->name;
            $function = $application->vacature->function;
            $location = $application->vacature->location;
            $details = [
                'company' => $company,
                'function' => $function,
                'location' => $location,
                'workday' => $workday
            ];
            //stuur mail
            Mail::to($email)->send(new acceptApplicantsMail($details));

            $counter++;
        }
        return redirect()->route('company.dashboard');
    }
}
