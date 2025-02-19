<?php

namespace App\Http\Livewire\Site\Auth;

use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Component;

class UpdatePassword extends Component
{
    public $email, $token, $password, $password_confirmation, $remember, $page;

    public function mount()
    {
        $this->email = request('email');
        $this->token = request('token');

        if ($this->email == "" || $this->token == "") {

            session()->flash('danger', __("Error email or token"));

            return redirect()->route('login');
        }
        $this->page = Page::where('slug', 'Update Password')->first();
    }

    public function updatePassword()
    {

        $this->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);


        $status = Password::reset(['email' => $this->email, 'password' => $this->password, 'password_confirmation' => $this->password_confirmation, 'token' => $this->token],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('success', __($status));
            return redirect()->route('login');
        }

        $this->addError('password', __($status));

    }

    public function render()
    {
        return view('livewire.'.env('THEME').'.auth.update-password')->layout('livewire.'.env('THEME').'.app');
    }
}
