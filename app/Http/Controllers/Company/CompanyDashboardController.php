<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Vacature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CompanyDashboardController extends Controller
{
    public function index()
    {
        $vacatures = Vacature::where('company_id', Auth::guard('company')->user()->id)->get();
        return view('company.dashboard', compact('vacatures'));
    }

    public function profile()
    {
        $company = Auth::guard('company')->user();
        return view('company.profile', compact('company'));
    }

    public function updateProfile(Request $request)
    {
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
}
