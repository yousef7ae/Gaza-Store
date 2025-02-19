<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;

class Details extends Component
{


    public function render()
    {

        return view('livewire.'.env('THEME').'.details')->layout('livewire.'.env('THEME').'.app');
    }

}
