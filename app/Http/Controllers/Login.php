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
        // $email = $request->email;
        // $pwd = $request->password;
        $credentials = $request->validate([
            "email"=> ['required', 'email'],
            "password"=> ['required']
        ]);

        if(Auth::attempt($credentials)){
            echo $request->session()->regenerate();
        }
        else echo "False Email or Password";

    }

    public function logout(Request $request){
        // print_r($request->session());
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        // print_r($request->session());
        return redirect('/login');
    }
}
