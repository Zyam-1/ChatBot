<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Error;
use Redirect;

class Login extends Controller
{
    public function login(Request $request){
        return view("login");
    }

    public function authenticate(Request $request)  {

        try {
            //code...
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
    
        } catch (\Exception $e) {
            $error = New Error;
            $error->description = $e->getMessage();
            $error->lineNumber = $e->getLine();
            $error->moduleName = "Authenticate";
            $error->fileName = "Login.php";
            $error->save();
        }
        
    }

    public function logout(Request $request){
        try {
            //code...
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerate();
            return redirect('/login');
        } catch (\Exception $e) {
            //throw $th;
            $error = New Error;
            $error->description = $e->getMessage();
            $error->lineNumber = $e->getLine();
            $error->moduleName = "Authenticate";
            $error->fileName = "Login.php";
            $error->save();
        }

    }
}
