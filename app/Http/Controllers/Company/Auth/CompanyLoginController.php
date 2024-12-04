<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('company.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login_code' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('login_code', 'password');

        if (Auth::guard('company')->attempt($credentials)){
            return redirect()->intended('company.dashboard');
        }

        return back()->withErrors([
            'login_code' => 'Login code of wachtwoord is niet correct.',
        ]);
    }

    public function logout()
    {
        Auth::guard('company')->logout();
        return redirect('/');
    }

}
