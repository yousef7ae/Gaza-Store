<?php

namespace App\Http\Livewire\Site\Auth;

use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ResetPassword extends Component
{
    public $email, $password, $remember, $page;

    function mount()
    {

        $this->page = Page::where('slug', 'FORGET PASSWORD')->first();
    }

    public function resetPassword()
    {

        $validate = $this->validate([
            'email' => 'required|email|exists:users,email',
        ]);


        $user = User::where('email', $this->email)->first();

        if ($user) {

            $status = Password::sendResetLink(["email" => $this->email]);

            if ($status === Password::RESET_LINK_SENT) {
                session()->flash('success', __($status));
                return redirect()->route('login');
            }

            $this->addError('email', __($status));

        } else {
            $this->addError('email', __("Invalid Login"));
        }

    }


    public function render()
    {
        return view('livewire.'.env('THEME').'.auth.reset-password')->layout('livewire.'.env('THEME').'.app');
    }
}
