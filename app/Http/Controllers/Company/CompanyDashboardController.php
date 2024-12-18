<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Mail\acceptApplicantsMail;
use App\Mail\acceptNewDateMail;
use App\Mail\AfwijzingsmailDoorEisen;
use App\Mail\chooseNewDateMail;
use App\Models\Application;
use App\Models\Invitation;
use App\Models\Vacature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Nullable;
use Illuminate\Support\Str;
use Carbon\Carbon;


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

    public function update(Request $request, Company $company)
    {
        if (Auth::guard('company')->user()) {

            $request->validate([
                'name' => 'nullable|string|max:255',
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

            ]));

            if ($request->hasFile('image')) {
                if ($company->image) {
                    Storage::disk('public')->delete($company->image);
                }
                $company->image = $request->file('image')->store('images', 'public');
            }

            if ($request->hasFile('logo')) {
                if ($company->logo) {
                    Storage::disk('public')->delete($company->logo);
                }
                $company->logo = $request->file('logo')->store('logos', 'public');
            }

            $company->save();
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
        $request->validate([
            'acceptApplicants' => 'required|integer',
            'workday' => 'nullable|date|after_or_equal:' . now()->addDays(2)->startOfDay(),
        ]);


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

            $invitation->url_hashed = Str::random(32);

            if ($request->has('workday') && !empty($request->input('workday'))) {
                //splits tijd en dag en laat het in de juiste format zien
                Carbon::setLocale('nl');
                $workdayTime = $request->input('workday');
                $workday = Carbon::parse($workdayTime)->translatedFormat('l j F Y');
                $worktime = Carbon::parse($workdayTime)->format('H:i');
                $invitation->day = $workday;
                $invitation->time = $worktime;
            } else {
                $workday = '';
                $worktime = '';
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
            $link = url('invitations/' . $invitation->url_hashed . '/' . $invitation->id);
            $details = [
                'company' => $company,
                'function' => $function,
                'location' => $location,
                'workday' => $workday,
                'worktime' => $worktime,
                'link' => $link
            ];
            //stuur mail
            Mail::to($email)->send(new acceptApplicantsMail($details));

            $counter++;
        }
        return redirect()->route('company.dashboard')->with('success', 'Sollicitanten zijn succesvol aangenomen');
    }



    public function acceptNewDate($id)
    {
        $invitation = Invitation::findOrFail($id);

        $invitation->declined = 0;
        $invitation->save();

        $application = $invitation->application;
        //vraag gegevens op voor de mail
        if (empty($application->user_id)) {
            $email = $application->email;
        } else {
            $email = $application->user->email;
        }
        $company = $application->vacature->company->name;
        $function = $application->vacature->function;
        $location = $application->vacature->location;
        $workday = $invitation->day;
        $worktime = $invitation->time;
        $details = [
            'company' => $company,
            'function' => $function,
            'location' => $location,
            'workday' => $workday,
            'worktime' => $worktime,
        ];
        //stuur mail
        Mail::to($email)->send(new acceptNewDateMail($details));

        return redirect()->route('company.dashboard');
    }
    public function chooseNewDate($id)
    {
        $invitation = Invitation::findOrFail($id);

        $invitation->declined = null;
        $invitation->day = null;
        $invitation->time = null;
        $invitation->save();

        $application = $invitation->application;
        //vraag gegevens op voor de mail
        if (empty($application->user_id)) {
            $email = $application->email;
        } else {
            $email = $application->user->email;
        }
        $company = $application->vacature->company->name;
        $function = $application->vacature->function;
        $location = $application->vacature->location;
        $link = url('invitations/' . $invitation->url_hashed . '/' . $invitation->id);
        $details = [
            'company' => $company,
            'function' => $function,
            'location' => $location,
            'link' => $link,
        ];
        //stuur mail
        Mail::to($email)->send(new chooseNewDateMail($details));

        return redirect()->route('company.dashboard');
    }
    public function removeApplicantFromList($id)
    {
        $invitation = Invitation::findOrFail($id);
        $application = $invitation->application;

        $invitation->delete();
        $application->delete();

        return redirect()->route('company.dashboard');
    }
}
