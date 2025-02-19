<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $email, $password, $remember;

    public function mount()
    {
        if (request()->route()->getName() == "admin.logout") {
            auth()->guard('web')->logout();
            redirect()->route('admin.home');
        }

        if (auth()->guard('web')->check()) {
            redirect()->route('admin.home');
        }
    }

    public function login()
    {
        $validate = $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        $user = User::where('email', $this->email)->first();

        if (Hash::check($this->password, $user->password) and $user->status == 1) {
            auth()->guard('web')->login($user);
            return redirect()->route('admin.home');
        } else {
            $this->addError('email', __('Invalid Login'));
        }
    }

    public function render()
    {
        return view('livewire.admin.login')->layout('livewire.admin.app');
    }
}
