<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use Illuminate\Http\Request;
use App\Models\User;
class ChatController extends Controller
{
    

    public function chat()
    {
        return view('chat');
    }

    public function send(Request $request)
    {
        //echo '<pre>';print_r($request);die;
        $user = User::find(auth()->user()->id);
        $this->saveChatData($request);
        event(new ChatEvent($request->message,$user));
    }

    public function getOldMessage()
    {
        return session('chat');
    }

    public function saveChatData(Request $request){
        session()->put('chat',$request->chat);
    }
    /*public function send()
    {
        $message = 'hey';
        $user = User::find(auth()->user()->id);
        event(new ChatEvent($message,$user));
    }*/
}
