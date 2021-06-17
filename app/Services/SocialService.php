<?php

namespace App\Services;
use SocialiteProviders\Manager\OAuth2\User;
use App\Models\User as Model;

class SocialService 
{
    public function login(User $user) {
        //dd($user);
        
        $email = $user->getEmail();
        $name = $user->getName();

        $userData = Model::where('email', '=', $email)->firstOrFail();
        $userData->name = $name;

        if($userData->save()) {
            \Auth::loginUsingId($userData->id);
        }

        return redirect('/');
    }
}