<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            // Check if the user already exists
            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                // Create a new user if not exists
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt('defaultpassword'),
                ]);

                if ($googleUser->user['verified_email'] ?? false) {
                    $user->email_verified_at = now();
                    $user->save();
                } else {
                    event(new Register($user));
                }

                if (!$user->hasVerifiedEmail()) {
                    return redirect()->route('verification.notice')->with('message', 'Please verify your email.');
                }
            }
            // Log the user in
            Auth::login($user);

            // Redirect to the dashboard
            return redirect()->intended('/dashboard');
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['error' => 'Failed to authenticate']);
        }
    }
}
