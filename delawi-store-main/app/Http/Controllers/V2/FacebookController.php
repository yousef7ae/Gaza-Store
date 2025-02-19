<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();

            $facebookId = User::where('facebook_id', $user->id)->first();

            if ($facebookId) {
                Auth::login($facebookId);
                return redirect('/');
            } else {
                $finduser = User::where('email', $user->email)->first();
                if ($finduser) {
                    $finduser->google_id = $user->id;
                    $finduser->save();
                    Auth::login($finduser);
                    return redirect('/');
                }

                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'password' => encrypt(time())
                ]);

                Auth::login($createUser);
                return redirect('/')->with(['success' => "account not exist"]);
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

}
