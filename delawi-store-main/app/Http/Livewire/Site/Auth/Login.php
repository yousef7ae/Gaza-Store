<?php

namespace App\Http\Livewire\Site\Auth;

use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $email, $password, $remember, $page;


    public function mount()
    {
        if (request()->route()->getName() == "logout") {
            auth()->logout();
            redirect()->route('home');
        }

        if (auth()->check()) {
            redirect()->route('home');
        }

        $this->page = Page::where('slug', 'SIGN IN')->first();

    }


    public function login()
    {

        $validate = $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);


        $user = User::where('email', $this->email)->first();

        if (Hash::check($this->password, $user->password)) {

            if ($user->status != 1) {

                $this->addError('email', 'Account status awaiting review');
            } else {
                auth()->login($user);
                if (auth()->user()->hasRole('Customer')) {
                    return redirect()->route('home');
                } else {
                    return redirect()->route('admin.home');
                }
            }
        } else {
            $this->addError('email', __('Invalid Login'));
        }

    }


    public function render()
    {
        return view('livewire.'.env('THEME').'.auth.login')->layout('livewire.'.env('THEME').'.app');
    }
}
