<?php

namespace App\Http\Livewire\Site;

use App\Models\User;
use Livewire\Component;

class Profile extends Component
{

    public $name, $email, $mobile, $password, $password_confirmation;

    function mount()
    {
        $user = User::findOrFail(auth()->id());
        $this->name = $user->name;
        $this->email = $user->email;
        $this->mobile = $user->mobile;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,id,' . auth()->id(),
            'mobile' => 'required|unique:users,id,' . auth()->id(),
        ]);


        if ($this->password) {
            $this->validate([
                'password' => 'required|confirmed',
            ]);
        }


        $user = User::findOrFail(auth()->id());
        $user->name = $this->name;
        $user->email = $this->email;
        $user->mobile = $this->mobile;
        if ($this->password) {
            $user->password = bcrypt($this->password);
        }
        $user->save();

        session()->flash('message', 'User Registered.');

        return redirect()->route('site.profile');
    }


    public function render()
    {
        return view('livewire.'.env('THEME').'.profile')->layout('livewire.'.env('THEME').'.app');
    }
}
