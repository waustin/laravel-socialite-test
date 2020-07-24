<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

use App\Services\SocialAccountService;

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

    // General Socialte stuff
    public function redirectToProvider($provider)
    {
        // TODO: Check for valid provider
        try {
            return Socialite::driver($provider)->redirect();
        } catch(\Exception $e) {
            // error redirecting to provider
            dd($e);
            return redirect(route('auth.login'));
        }
    }

    public function handleProviderCallback(SocialAccountService $accountService, $provider)
    {
        // TODO: Check for valid provider
        try {
            $user = Socialite::driver($provider)->user();
        } catch(\Exception $e) {
            // Could not login / get user
            dd($e);
            return redirect(route('auth.login'));
        }
       // dd($user, $user->token, $user->getId(), $user->getEmail(), $user->getName());

        // I think token is what we need to store and do a lookup on
        $authUser = $accountService->findOrCreate($user, $provider);
        auth()->login($authUser, true);

        return redirect(route('home'));
    }
}
