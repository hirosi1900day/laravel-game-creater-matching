<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Http\Requests\MyPostUpdate;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct()
    {
        // 認証が必要
        $this->middleware('auth')->except(['index']);
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
    public function index()
    {
        $posts = Post::with(['user'])
        ->orderBy(Post::CREATED_AT, 'desc')->paginate();
        return $posts;
    }

    public function detail(Post $post) 
    {
        $user = $post->user;
        return ['user'=>$user,'post'=>$post];
    }

    public function mypage() 
    {
        $posts = Auth::user()->posts()->orderBy('created_at', 'desc')->get();
        return $posts;
    }
    public function mypost(Post $post) {
        $postUser = $post->user;
        if($postUser->id == Auth::id()){
            return $post;
        }
        return [];
    }
    public function myupdate(Post $post,MyPostUpdate $request)
    {
        
        DB::beginTransaction();
        try {
            $post->title = $request->title;
            $post->content = $request->content;
            $post->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        return response($post,201);
    }      
  
    public function delete(Post $post) {
        $postUser = $post->user;
        DB::beginTransaction();
        if($postUser->id == Auth::id()){
            try {
                $post->delete();
                DB::commit();
                return response(200);
            } catch (\Exception $exception) {
                DB::rollBack();
                throw $exception;
            }
        }
        return abort(403);
    }
}
