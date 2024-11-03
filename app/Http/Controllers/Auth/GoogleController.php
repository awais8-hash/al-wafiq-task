<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            // Find or create the user
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'email_verified_at' => now(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(uniqid()) // Set a random password
                ]
            );

            // Log the user in
            Auth::login($user);

            return redirect()->route('performance');
        } catch (\Exception $e) {
            return redirect()->route('login');
        }
    }

    public function signOut(){
        Auth::logout();
        return redirect()->route('login');
    }
}
