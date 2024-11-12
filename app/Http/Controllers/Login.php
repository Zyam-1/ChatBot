<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Redirect;

class Login extends Controller
{
    public function login(Request $request){
        return view("login");
    }

    public function authenticate(Request $request)  {

        $credentials = $request->validate([
            "email"=> ['required', 'email'],
            "password"=> ['required']
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/home');

        }
        return back()->withErrors([
            "email"=> "Please check your credentials"
        ])->onlyInput("email");

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/login');
    }
}
