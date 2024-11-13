<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Error;

class SignUp extends Controller
{
    public function display(Request $request){
        try {
            //code...
            return view("signup");
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
