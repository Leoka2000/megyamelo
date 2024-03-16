<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Note;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUser;

class ProviderController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->stateless()->user();
            $user = User::where('google_id', $google_user->getId())->first();

            if (!$user) {
                $user = User::where('email', $google_user->getEmail())->first();

                if (!$user) {
                    // If no user with the Google ID or email exists, create a new user
                    $user = User::create([
                        'name' => $google_user->getName(),
                        'email' => $google_user->getEmail(),
                        'google_id' => \Illuminate\Support\Str::random(24), //passing a null google id, but works in production
                        'password' => Hash::make(Str::random(24)),
                    ]);

                    ##aqui eu coloco emails apenas para novos usuários criados, n para ja existentes
                } else {
                    // If a user with the email exists but without Google ID, update the user
                    $user->update([
                        'google_id' => $google_user->getId()
                    ]);
                }
            }


            // Manually log in the user
            Auth::login($user);
            Mail::to('lreusoliveira@gmail.com')->send(new NewUser());


            return redirect()->route('notes.create'); // Assuming you have a named route for your dashboard

        } catch (ClientException $e) {
            error_log($e);
        }
    }
}
