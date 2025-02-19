<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;

class Store extends Component
{
    public function render()
    {

        return view('livewire.'.env('THEME').'.store')->layout('livewire.'.env('THEME').'.app');
    }

}
