<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    // socialite stuff
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        $user = Socialite::driver('github')->user();
        dd($user, $user->token);
    }


    // Create a new user from a social login
    protected function createUserFromSocialAccount() {

    }

    // Lookup User from Social Account
    protected function lookupUserFromSocialAccount() {

    }

    // General Socialte stuff
    public function redirectToProvider($provider)
    {
        // TODO: Check for valid provider
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        // TODO: Check for valid provider
        $user = Socialite::driver($provider)->user();
        dd($user, $user->token);
    }
}
