<?php

namespace App\Http\Controllers;

use App\User;
use App\ChatRoom;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreChat;
use Illuminate\Support\Facades\DB;

class ChatRoomController extends Controller
{

    public function __construct()
    {
        // 認証が必要
        $this->middleware('auth');
    }
  
    public function show(User $user) {
        
        $chat_room_id = ChatRoom::where('user_id', Auth::id())
        ->where('send_user_id',$user->id)
        ->pluck('id');
        
        
        if($chat_room_id->isEmpty()){
            //上記の逆パターンの際
            $chat_room_id = ChatRoom::where('user_id', $user->id)
            ->where('send_user_id',Auth::id())
            ->pluck('id');
        }
        //チャットルームがなければ作成する
        if($chat_room_id->isEmpty()){
            ChatRoom::create(['user_id'=>$user->id,'send_user_id'=>Auth::id(),]); //チャットルーム作成
            $latest_chat_room = ChatRoom::orderBy('created_at', 'desc')->first(); //最新チャットルームを取得
            $chat_room_id = $latest_chat_room->id;
        }
        // チャットルーム取得時はオブジェクト型なので数値に変換
        if(is_object($chat_room_id)){
            $chat_room_id = $chat_room_id->first();
        }
        
       
        //チャットルームのメッセージを取得する
        $chatroom=ChatRoom::findOrFail($chat_room_id);
        $messages=$chatroom->chatMessages()->get();

        if($messages->isEmpty()){
            $messages=[];
        }
        return ["user"=>$user,"message"=>$messages];
    }

    public function store(StoreChat $request) {
        $chat_room_id = ChatRoom::where('user_id', Auth::id())
        ->where('send_user_id',$request->user_id)
        ->pluck('id');
        
        //チャットルームがなければ作成する
        if($chat_room_id->isEmpty()){
            //上記の逆パターンの際
            $chat_room_id = ChatRoom::where('user_id', $request->user_id)
            ->where('send_user_id',Auth::id())
            ->pluck('id');
        }
        if(is_object($chat_room_id)){
            $chat_room_id = $chat_room_id->first();
        }
        DB::beginTransaction();
        try {
            ChatRoom::findOrFail($chat_room_id)->chatMessages()->create([
                'user_id'=>Auth::id(),
                'message'=>$request->message,
                 ]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        // リソースの新規作成なので
        // レスポンスコードは201(CREATED)を返却する
        return response(201);
    }
}
