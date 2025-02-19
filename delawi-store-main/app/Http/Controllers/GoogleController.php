<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\User;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleCallback()
    {

        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);
                return redirect('/');

            } else {

                $finduser = User::where('email', $user->email)->first();

                if ($finduser) {
                    $finduser->google_id = $user->id;
                    $finduser->save();
                    Auth::login($finduser);
                    return redirect('/');
                }

                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'email_verified_at' => Carbon::now(),
                    'password' => Hash::make(time()),
                    'status' => 1
                ]);

                $newUser->syncRoles(4); //Customer

                Auth::login($newUser);

                return redirect('/')->with(['success' => "Register Successfully"]);

            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

}
