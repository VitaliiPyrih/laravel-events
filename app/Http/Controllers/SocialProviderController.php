<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialProviderController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            $user = User::where('provider_id', $socialUser->getId())->first();
            if (!$user) {
                if (User::where('email',$socialUser->getEmail())->exists()) {
                    return redirect()->route('login')->with('email_taken', 'Ця електронна адреса вже використовується.');
                }
                $newUser = User::create([
                    'provider_id' => $socialUser->getId(),
                    'provider' => $provider,
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'avatar' => $socialUser->getAvatar(),
                    'email_verified_at' => now(),
                    'provider_token' => $socialUser->token,
                ]);


                Auth::login($newUser);
                return redirect()->route('profile');
            } else {
                Auth::login($user);
                return redirect()->route('profile');
            }
        } catch (\Exception $exception) {
//            dd($exception);
        }
    }
}
