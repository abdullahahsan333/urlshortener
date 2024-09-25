<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:client')->except('logout');
    }
    
    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required']
        ]);

        $credentials['status'] = 1;

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {

            $request->session()->regenerate();

            flash()->success('Admin Login successful.');

            return redirect()->intended('admin/dashboard');
        }

        flash()->error('The provided credentials do not match our records.');

        return redirect()->back()->onlyInput('email');
    }
    
    public function showClientLoginForm()
    {
        return view('auth.login', ['url' => 'client']);
    }

    public function clientLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required']
        ]);

        $credentials['status'] = 1;

        if (Auth::guard('client')->attempt($credentials, $request->boolean('remember'))) {

            $request->session()->regenerate();

            flash()->success('Client Login successful.');

            return redirect()->intended('client/dashboard');
        }

        flash()->error('The provided credentials do not match our records.');

        return redirect()->back()->onlyInput('email');
    }
    
    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        flash()->success('Admin Logout successful.');

        return redirect()->intended('admin/login');
    }

    
    public function clientLogout(Request $request)
    {
        Auth::guard('client')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        flash()->success('Client Logout successful.');

        return redirect()->intended('client/login');
    }

}
