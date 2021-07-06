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
//userの一覧を取得する
Route::get('/user/index', 'UserController@index')->name('user.index');
//userの詳細情報を取得する
Route::get('/users/{user}', 'UserController@show')->name('user.show');
//myUser情報を更新する
Route::post('/user/mypage', 'UserController@store')->name('mypage.store');
//myUser情報を取得する
Route::get('/user/mypage', 'UserController@myUserGet')->name('mypage.get');
//chatRoom情報の取得
Route::get('/chats/users/{user}', 'ChatRoomController@show')->name('chat.show');
//chatMessageを保存する
Route::post('/chats/users', 'ChatRoomController@store')->name('chat.store');
//chatのuser一覧を取得
Route::get('/chat/index', 'ChatRoomController@index')->name('chat.index');