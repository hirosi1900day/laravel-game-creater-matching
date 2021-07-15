<?php

namespace App\Http\Controllers;

use App\Recruit;
use App\User;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request) {
        \Auth::user()->favorite($request->postId);
        return response(201);
    }

    public function destroy(Request $request) {
        \Auth::user()->unfavorite($request->postId);
        return response(201);
    }

    public function like_check($id) {
        
        $result = \Auth::user()->is_favorite($id);
        return ['result' => $result];
    }

    public function index() {
        $favoritePost = \Auth::user()->favorites()->orderBy('created_at','desc')->get();
        return $favoritePost;
    }


}

