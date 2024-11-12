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

        $Message = New Message;
        $Response = New Message;
        // return empty($request->ChatID);
        if (empty($request->ChatID)){
            $Chat = New Chat;
            $TitleMessage = $NewMessage. "  Generate a Title for the text above. Whatever the title is. Only give me the title. Leave all the message behind";

            $FetchTitle = Gemini::geminiPro()->generateContent($TitleMessage);
            $title = $FetchTitle->text();
            
            $Chat->title = $title;
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
            $ResponseArr = [];

            $ResponseArr[0] = $Chat->id;
            $ResponseArr[1] = $ResToText;


            return $ResponseArr;

        }
        // else{
            
            $Message->content = trim($NewMessage);
            $Message->chat_id = $request->ChatID;
            $Message->status = "sent";

            $Message->save();

            // $History = Message::where('status', 'sent')
            //                     ->where('chat_id', $Chat->id)

            $result = Gemini::geminiPro()->generateContent($NewMessage);
            $ResToText =  $result->text();
            $Response->content = $ResToText;
            $Response->chat_id = $request->ChatID;
            $Response->status = "received";
            $Response->save();
            // $ResponseArr = [];

            // '$ResponseArr[0] = $request->id;
            $ResponseArr = $ResToText;


            return $ResponseArr;

        // }
        
        
    }
    
}
