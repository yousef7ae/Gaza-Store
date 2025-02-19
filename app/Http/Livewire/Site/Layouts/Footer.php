<?php

namespace App\Http\Livewire\Site\Layouts;

use App\Models\Menu;
use Livewire\Component;

class Footer extends Component
{

    public $sections, $legals, $user;

    function mount()
    {
        $this->sections = Menu::where('id', "2")->first();
        $this->legals = Menu::where('id', "3")->first();
    }

    public function render()
    {
        return view('livewire.'.env('THEME').'.footer')->layout('livewire.'.env('THEME').'.app');
    }
}
