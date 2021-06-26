<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    public function __construct()
    {
        // 認証が必要
        $this->middleware('auth');
    }


    public function create(StorePost $request)
    {

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;


        
        // データベースエラー時にファイル削除を行うため
        // トランザクションを利用する
        DB::beginTransaction();


        try {
            Auth::user()->posts()->save($post);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        // リソースの新規作成なので
        // レスポンスコードは201(CREATED)を返却する
        return response($post, 201);
    }
}
