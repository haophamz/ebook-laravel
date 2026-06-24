<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
{
    $googleUser = Socialite::driver('google')
        ->stateless()
        ->user();

    $user = User::where('email', $googleUser->getEmail())->first();

    if (!$user) {

        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt(str()->random(32)),
        ]);

    } else {

        $user->update([
            'email_verified_at' => now()
        ]);

    }

    Auth::login($user);


           return redirect()->intended('/'); 
}
}