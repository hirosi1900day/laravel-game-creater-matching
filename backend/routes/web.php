<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//会員登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('signup', 'Auth\RegisterController@register')->name('signup');
//ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.get');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');


Route::get('/{any?}', function () {
    return view('pages.index');
});
Route::get('/post/{any?}', function () {
    return view('pages.index');
});
// Route::get('/chat/{any?}', function () {
//     return view('pages.index');
// });
// Route::get('/favorite/{any?}', function () {
//     return view('pages.index');
// });
// Route::get('/setting/{any?}', function () {
//     return view('pages.index');
// });

