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


//Admin 認証不要
Route::group(['prefix' => 'admin'], function() {
    Route::get('/',      function () { return redirect('/admin/home'); });
    Route::get('login',  'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login');
});
 
//Admin ログイン後
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::get('home',    'Admin\HomeController@index')->name('admin.home');
    Route::get('users/{user}',    'Admin\HomeController@show')->name('admin.user.show');
});


Route::get('/{any?}', function () {
    return view('pages.index');
})->where('any', '.+');