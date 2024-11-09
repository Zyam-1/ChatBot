<?php

namespace App\Http\Controllers;

use Gemini\Laravel\Facades\Gemini;


use Illuminate\Http\Request;

class Home extends Controller
{
    public function home(Request $request){
        
        return view('home');
    } 

    public function HandleMessageResponse(Request $request){
        $message =  $request->message;
        $result = Gemini::geminiPro()->generateContent($message);
        return $result->text();
    }
    
}
