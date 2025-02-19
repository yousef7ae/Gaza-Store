<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;

class Favorites extends Component
{

    public function render()
    {
        return view('livewire.'.env('THEME').'.favorites')->layout('livewire.'.env('THEME').'.app');
    }
}
