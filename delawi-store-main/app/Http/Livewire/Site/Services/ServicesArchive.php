<?php

namespace App\Http\Livewire\Site\Services;

use Livewire\Component;

class ServicesArchive extends Component
{
    public function render()
    {
        return view('livewire.'.env('THEME').'.services.services-archive');
    }
}
