<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserMypageUpdate;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function show(User $user) {
       return $user;
    }

    public function myUserGet() {
        return Auth::user();
    }

    public function update(UserMypageUpdate $request) {
        if($request->user_id != Auth::id()) {
            return response(403);
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->self_introduce = $request->self_introduce;

        DB::beginTransaction();
        try {
            $user->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return response($user, 201);
    }
    
}
