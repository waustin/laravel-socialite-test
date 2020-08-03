<?php

namespace App\Services;

use Laravel\Socialite\Contracts\User as ProviderUser;
use App\User;
use App\LinkedSocialAccount;

class SocialAccountService
{
    public function findOrCreate(ProviderUser $providerUser, $provider)
    {
        $account = LinkedSocialAccount::where([
                ['provider_name', $provider],
                ['provider_id', $providerUser->getId()]
            ])->first();

        if($account) {
            return $account->user;
        } else {
        
            // No Social Account Found
            

            // NEVER AUTO ASSOCIATE social and site user by email
            // Never create user from email from provider
            // Don't trust email provider address.


            // try to find a user with provider email.
            // TODO what if provider email is NULL
            $user = User::where('email', $providerUser->getEmail())->first();

            if( !$user ) {
                // No matching User found, create a new one
                // Show form and pre-fill
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                ]);
            }

            $user->accounts()->create([
                'provider_id' => $providerUser->getId(),
                'provider_name' => $provider,
            ]);

            return $user;
        }
    }
}