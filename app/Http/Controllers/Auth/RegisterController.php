<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Admin;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->middleware('guest:client');
    }

    public function showAdminRegisterForm()
    {
        return view('auth.register', ['url' => 'admin']);
    }

    public function showClientRegisterForm()
    {
        return view('auth.register', ['url' => 'client']);
    }

    public function adminRegister(Request $request)
    {
        if(!Admin::where('email', $request->email)->exists()) {
            $data = new Admin;
            
            $data->name       = $request->name;
            $data->email      = $request->email;
            $data->password   = Hash::make($request->password);

            $data->save();

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
        } else {
            flash()->warning('Admin already Exists!');
            return redirect()->route('login');
        }
    }

    
    public function clientRegister(Request $request)
    {
        if(!Client::where('email', $request->email)->exists()) {
            $data = new Client;
            
            $data->name       = $request->name;
            $data->email      = $request->email;
            $data->password   = Hash::make($request->password);

            $data->save();

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
        } else {
            flash()->warning('Client already Exists!');
            return redirect()->route('home');
        }
    }
    
}

