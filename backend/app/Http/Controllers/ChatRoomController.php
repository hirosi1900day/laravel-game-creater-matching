<?php

namespace App\Http\Controllers;

use App\User;
use App\ChatRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    public function show(User $user) {
        $chat_room_id = Chatroom::where('user_id', Auth::id())
        ->where('send_user_id',$user->id)
        ->pluck('id');
        //チャットルームがなければ作成する
        if($chat_room_id->isEmpty()){
            //上記の逆パターンの際
            $chat_room_id = Chatroom::where('user_id', $user->id)
            ->where('send_user_id',Auth::user())
            ->pluck('id');
        }
        if($chat_room_id->isEmpty()){
            Chatroom::create(['user_id'=>Auth::id(),'send_user_id'=>$user->id,]); //チャットルーム作成
            $latest_chat_room = Chatroom::orderBy('created_at', 'desc')->first(); //最新チャットルームを取得
            $chat_room_id = $latest_chat_room->id;
        }
        // チャットルーム取得時はオブジェクト型なので数値に変換
        if(is_object($chat_room_id)){
            $chat_room_id = $chat_room_id->first();
        }
        //チャットルームのメッセージを取得する
        $chatroom=Chatroom::findOrFail($chat_room_id);
        $messages=$chatroom->chatMessages()->get();
    
       
        if($messages->isEmpty()){
            $messages=[];
        }
        return ["user"=>$user,"message"=>$messages];
    }
}
