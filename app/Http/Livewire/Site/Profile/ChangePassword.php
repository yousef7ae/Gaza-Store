<?php

namespace App\Http\Livewire\Site\Profile;

use Livewire\Component;

class ChangePassword extends Component
{


    public function render()
    {
        return view('livewire.'.env('THEME').'.profile.change-password')->layout('livewire.'.env('THEME').'.app');
    }
}
