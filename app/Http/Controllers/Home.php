<?php

namespace App\Http\Controllers;

use Auth;
use Gemini\Laravel\Facades\Gemini;
Use App\Models\Chat;
Use App\Models\Message;



use Illuminate\Http\Request;

class Home extends Controller
{
    // public function homeChatById(Request $request,$id){
    //     return $id;
    // }
    public function home(Request $request){
        $messages = [];
        if($request->has('id')){
            $ChatID = trim($request->query('id'));
            if(!empty($ChatID)){
                $messages = Message::where('chat_id', $ChatID)->orderBy('created_at', 'asc')->get(['content', 'status']);
            }
        }
        // return $messages;
        $Chats = Chat::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get()->toArray();
        return view('home')->with('Chats', $Chats)->with('messages',  $messages);
    } 

    public function HandleMessageResponse(Request $request){
        $NewMessage =  $request->message;
        // return empty($request->ChatID);
        if (empty($request->ChatID)){
            $Chat = New Chat;
            $Message = New Message;
            $Response = New Message;
            
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

            return $ResToText;

        }
        
        
    }
    
}
