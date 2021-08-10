<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserMypageUpdate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Service\ImageService;

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

    public function store(Request $request) {
        if($request->user_id != Auth::id()) {
            return response(403);
        }
        $user = Auth::user();
        $user->name = $request->name;
        $user->self_introduce = $request->self_introduce;
        $user->occupation = $request->occupation;
        $path = "";

        DB::beginTransaction();
        try {
            if($file = $request->file && $request->file != "null") {
                if($user->image_loccation){
                    //新規登録
                    //保存するファイルに名前をつける 
                    $fileName = time().'.'.$request->file->getClientOriginalExtension();
                    $path = Storage::disk('s3')->putFileAs('/userImage',$request->file, $fileName,'public');
                    $user->image_location = $path;
                } else {
                    //アップデート
                    //保存するファイルに名前をつける
                    Storage::disk('s3')->delete($user->image_location);
                    $fileName = time().'.'.$request->file->getClientOriginalExtension();
                    $path = Storage::disk('s3')->putFileAs('/userImage',$request->file, $fileName,'public');
                    $user->image_location = $path;
                }
                
            }
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
