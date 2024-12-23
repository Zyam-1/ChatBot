<?php

namespace App\Http\Controllers;

use Auth;
use Gemini\Data\Content;
use Gemini\Enums\Role;
use Gemini\Laravel\Facades\Gemini;
Use App\Models\Chat;
Use App\Models\Error;

Use App\Models\Message;



use Illuminate\Http\Request;

class Home extends Controller
{
    // public function homeChatById(Request $request,$id){
    //     return $id;
    // }
    public function home(Request $request){
        try {
            //code...
            $messages = [];
            if($request->has('id')){
                $ChatID = trim($request->query('id'));
                if(!empty($ChatID)){
                    $messages = Message::where('chat_id', $ChatID)->orderBy('created_at', 'asc')->get(['content', 'status']);
                }
            }
            $Chats = Chat::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get()->toArray();
            return view('home')->with('Chats', $Chats)->with('messages',  $messages);
        } catch (\Exception $e) {
            //throw $th;
            $error = New Error;
            $error->description = $e->getMessage();
            $error->lineNumber = $e->getLine();
            $error->moduleName = "home";
            $error->fileName = "Home.php";
            $error->save();
        }

    } 

    public function HandleMessageResponse(Request $request){
        try {
            // print_r($History);
            //code...
            $NewMessage =  $request->message;
            $Message = New Message;
            $Response = New Message;
        // return empty($request->ChatID);
        if (empty($request->ChatID)){
            $Chat = New Chat;
            $TitleMessage = $NewMessage . "  Generate a Title for the text above. Whatever the title is. Only give me the title. Leave all the message behind";

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
            // $HistoryMessages = [];
            // $FormatedMessagHis = [];

            
            $HistoryMessages = Message::where('chat_id', $request->ChatID)->orderBy('created_at', 'asc')->take(10)->get(['content', 'status'])->toArray();
            // print_r($History);
            // return $HistoryMessages;
            $FormatedMessagHis = array_map(fn($msg) => Content::parse(part: $msg['content'], role: $msg['status'] == 'received' ? Role::MODEL: Role::USER), $HistoryMessages);
            // return $FormatedMessagHis;
            // foreach($HistoryMessages as $HisMessage){
            //     $HistoryString .= $HisMessage->content;
                
            // }
            // if(substr(trim($HistoryString), - 1) != "."){
            //     $HistoryString .= ".";
            // }
            // return $HistoryString;
            // 'return  $FormatedMessagHis;
            $chat = Gemini::chat()->startChat(history: $FormatedMessagHis);
            $result = Gemini::geminiPro()->generateContent(trim($NewMessage));
            return $result->text();
            $Message->content = trim($NewMessage);
            $Message->chat_id = $request->ChatID;
            $Message->status = "sent";

            $Message->save();

            


            $result = Gemini::geminiPro()->generateContent($HistoryString  . $NewMessage);
            $ResToText =  $result->text();
            $Response->content = $ResToText;
            $Response->chat_id = $request->ChatID;
            $Response->status = "received";
            $Response->save();

            $ResponseArr = $ResToText;
            return $ResponseArr;
        } catch (\Exception $e) {
            //throw $th;
            $error = New Error;
            $error->description = $e->getMessage();
            $error->lineNumber = $e->getLine();
            $error->moduleName = "HandleMessageResponse";
            $error->fileName = "Home.php";
            $error->save();
        }}
        
    
}
