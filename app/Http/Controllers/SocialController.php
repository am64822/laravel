<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SocialService;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function login() {
        return Socialite::driver('vkontakte')->redirect();
    }

    public function callback(SocialService $service) {
        
        //dd('stop');
        return $service->login(
            Socialite::driver('vkontakte')->user()
        );
    }
}
