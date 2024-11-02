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

        }

    }
}
