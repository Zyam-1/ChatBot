<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignUp extends Controller
{
    public function display(Request $request){
        return view("signup");
    }
}
