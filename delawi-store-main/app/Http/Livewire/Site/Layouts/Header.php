<?php

namespace App\Http\Livewire\Site\Layouts;

use App\Models\Menu;
use App\Models\Store;
use Livewire\Component;

class Header extends Component
{
    public $menus, $store;

    function mount()
    {

        if(auth()->check() and auth()->user()->city_id){
            session()->put('country_id',auth()->user()->country_id);
            session()->put('city_id',auth()->user()->city_id);
        }else{
            session()->put('country_id',84);
            session()->put('city_id',39116);
        }

        $this->store = Store::first();
        $this->menus = Menu::where('id', 1)->first();
    }

    public function render()
    {
        return view('livewire.'.env('THEME').'.header')->layout('livewire.'.env('THEME').'.app');
    }
}
