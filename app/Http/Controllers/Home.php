<?php

namespace App\Http\Controllers;

use Auth;
use Gemini\Laravel\Facades\Gemini;
Use App\Models\Chat;
Use App\Models\Message;



use Illuminate\Http\Request;

class Home extends Controller
{
    public function home(Request $request){
        $Chats = Chat::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get()->toArray();
        // return $Chats;
        return view('home')->with('Chats', $Chats);
    } 

    public function HandleMessageResponse(Request $request){
        $NewMessage =  $request->message;
        // if($request->ChatID){
        //     $result = Gemini::geminiPro()->generateContent($NewMessage);
        //     return $result->text();
        // }
        // else{
        if (empty($request->CID)){
            // $ChatID = $request->ChatID;
            $Chat = New Chat;
            $Message = New Message;
            $Response = New Message;
            //Created New Chat
            $Chat->title = "";
            $Chat->user_id = Auth::user()->id;
            $Chat->save();
            
            $Message->content = trim($NewMessage);
            $Message->chat_id = $Chat->id;
            $Message->status = "sent";

            $Message->save();

            // $History = Message::where('status', 'sent')
            //                     ->where('chat_id', $Chat->id)

            $result = Gemini::geminiPro()->generateContent($NewMessage);
            $ResToText =  $result->text();
            $Response->content = $ResToText;
            $Response->chat_id = $Chat->id;
            $Response->status = "received";
            $Response->save();

            return $result->text();



        }
        
        
    }
    
}
