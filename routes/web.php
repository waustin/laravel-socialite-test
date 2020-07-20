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

// Socialite
// -------
// Github
/*
Route::get('/login/github', 'Auth\SocialLoginController@redirectToGithub')->name('auth.github.login');
Route::get('/login/github/callback', 'Auth\SocialLoginController@handleGithubCallback')->name('auth.github.callback');

// Twitter
Route::get('/login/twitter', 'Auth\SocialLoginController@redirectToTwitter')->name('auth.github.login');
Route::get('/login/twitter/callback', 'Auth\SocialLoginController@handleTwitterCallback')->name('auth.github.callback');
*/
// General
Route::get('/login/{provider}', 'Auth\SocialLoginController@redirectToProvider')->name('auth.socialite.login');
Route::get('/login/{provider}/callback', 'Auth\SocialLoginController@handleProviderCallback')->name('auth.socialite.callback');