<?php

namespace App\Http\Livewire\Site\Profile;

use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        return view('livewire.'.env('THEME').'.profile.sidebar')->layout('livewire.'.env('THEME').'.app');
    }
}
