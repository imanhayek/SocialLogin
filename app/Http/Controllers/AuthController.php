<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {

        try {
            //create a user using socialite driver google
            $user = Socialite::driver('google')->user();
           
            // if the user exits, use that user and login
            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {
                //if the user exists, login and show dashboard
                Auth::login($finduser);
                return redirect('/dashboard');
            } else {
                //user is not yet created, so create first
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'sign_in_type' => 'google',
                    'password' => encrypt('')
                ]);

                $newUser->save();
                //login as the new user
                Auth::login($newUser);
                // go to the dashboard
                return redirect('/dashboard');
            }
            //catch exceptions
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


    public function redirectToApple()
    {
        return Socialite::driver('sign-in-with-apple')->redirect();
    }

    public function handleAppleCallback()
    {
        
        try {
            //create a user using socialite driver google
            $user = Socialite::driver('sign-in-with-apple')->user();

            // if the user exits, use that user and login
            $finduser = User::where('apple_id', $user->id)->first();
            if ($finduser) {
                //if the user exists, login and show dashboard
                Auth::login($finduser);
                return redirect('/dashboard');
            } else {
                //user is not yet created, so create first
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'apple_id' => $user->id,
                    'sign_in_type' => 'apple',
                    'password' => encrypt('')
                ]);

                $newUser->save();
                //login as the new user
                Auth::login($newUser);
                // go to the dashboard
                return redirect('/dashboard');
            }
            //catch exceptions
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
