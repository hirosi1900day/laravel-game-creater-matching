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

Route::get('/reflesh-token', function (Illuminate\Http\Request $request) {
    $request->session()->regenerateToken();

    return response()->json();
});

Route::prefix('posts')->group(function () {
    // 投稿作成
    Route::post('/', 'PostController@create')->name('post.create');
    // 投稿一覧
    Route::get('/', 'PostController@index')->name('post.index');   
    //投稿詳細
    Route::get('/{post}/detail', 'PostController@detail')->name('post.detail');
    //自分の投稿を取得する
    Route::get('mypage', 'PostController@mypage')->name('post.mypage');
    //自分の投稿詳細情報を取得する
    Route::get('/{post}/mypost', 'PostController@mypost')->name('post.mypost');
    //自分の投稿詳細情報を更新する
    Route::put('/{post}/myupdate', 'PostController@myUpdate')->name('post.myupdate');
    //postの削除
    Route::delete('/{post}/delete', 'PostController@delete')->name('post.delete');
});

//userの詳細情報を取得する
Route::get('/users/{user}', 'UserController@show')->name('user.show');

Route::prefix('user')->group(function () {
    //userの一覧を取得する
    Route::get('index', 'UserController@index')->name('user.index');
    //myUser情報を更新する
    Route::post('mypage', 'UserController@store')->name('mypage.store');
    //myUser情報を取得する
    Route::get('mypage', 'UserController@myUserGet')->name('mypage.get');
});

Route::prefix('chats')->group(function () {
    //chatRoom情報の取得
    Route::get('users/{user}', 'ChatRoomController@show')->name('chat.show');
    //chatMessageを保存する
    Route::post('users', 'ChatRoomController@store')->name('chat.store');
    //chatのuser一覧を取得
    Route::get('index', 'ChatRoomController@index')->name('chat.index');
});

Route::prefix('favorites')->group(function () {
    //お気に入り一覧取得
    Route::get('index', 'FavoriteController@index')->name('favorite.index');
    //お気に入りチェック
    Route::get('{postId}/check', 'FavoriteController@like_check')->name('favorite.check');
    //お気に入りする
    Route::post('favorite', 'FavoriteController@store')->name('favorite.store');
    //お気に入りを解除する
    Route::post('unfavorite', 'FavoriteController@destroy')->name('favorite.destroy');
});