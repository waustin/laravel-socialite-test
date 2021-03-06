<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/{user}', 'UserController@show')->name('users.show');
Route::post('/users/{user}', 'UserController@update')->name('users.update');

// Socialite
// -------
// General
Route::get('/login/{provider}', 'Auth\SocialLoginController@redirectToProvider')->name('auth.socialite.login');
Route::get('/login/{provider}/callback', 'Auth\SocialLoginController@handleProviderCallback')->name('auth.socialite.callback');