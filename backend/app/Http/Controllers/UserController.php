<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserMypageUpdate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct()
    {
        // 認証が必要
        $this->middleware('auth')->except(['index','show']);
    }

    public function index(){
        $users = User::OrderBy('created_at','desc')->get();
       
        return $users;
    }

    public function show(User $user) {
       return $user;
    }

    public function myUserGet() {
        return Auth::user();
    }

    public function store(UserMypageUpdate $request) {
        if($request->user_id != Auth::id()) {
            return response(403);
        }

        dd($request->file);
        $user = Auth::user();
        $user->name = $request->name;
        $user->self_introduce = $request->self_introduce;

        if($file = $request->file){
            //保存するファイルに名前をつける    
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $path = Storage::disk('s3')->putFileAs('/userImage',$file, $fileName,'public');
            $user->image_location = $path;
        }
       
        DB::beginTransaction();
        try {
            $user->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Storage::disk('s3')->delete($path);
            throw $exception;
        }

        return response($user, 201);
    }
    
}
