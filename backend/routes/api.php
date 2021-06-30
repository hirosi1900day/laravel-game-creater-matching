<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function () {
    return Auth::user();
});

// 投稿作成
Route::post('/post', 'PostController@create')->name('post.create');
// 投稿一覧
Route::get('/posts', 'PostController@index')->name('post.index');
//userの詳細情報を取得する
Route::get('/users/{user}', 'UserController@show')->name('user.show');
