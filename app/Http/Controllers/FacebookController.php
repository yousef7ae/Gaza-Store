<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Socialite;
use Exception;
use Auth;

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
                    'email_verified_at' => Carbon::now(),
                    'facebook_id' => $user->id,
                    'password' => Hash::make(time()),
                    'status' => 1
                ]);

                $createUser->syncRoles(4); //Customer

                Auth::login($createUser);
                return redirect('/')->with(['success' => "account registered"]);
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

}
