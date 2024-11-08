<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\password;

use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callback()
    {
        $socialUser = Socialite::driver('google')->user();

        $registeredUser = User::where('google_id', $socialUser->id)->first();


        if (!$registeredUser) {
            $user = User::updateOrCreate([
                'google_id' => $socialUser->id,
            ], [
                'name' => $socialUser->name,
                'username' => $socialUser->name,
                'picture' => $socialUser->avatar,
                'password' => Str::password(7, true, true, false, false),
                'email' => $socialUser->email,
                'google_token' => $socialUser->token,
                'google_refresh_token' => $socialUser->refreshToken,
                'role_id' => 3
            ]);

            Auth::login($user);

            return redirect('/')->with('message', 'Anda berhasil Login!');
        }

        Auth::login($registeredUser);

        return redirect('/')->with('Anda berhasil login!');
    }
}
