<?php

namespace App\Http\Livewire\Site\Stores;

use App\Models\Page;
use App\Models\Store;
use App\Models\Ad;
use Livewire\Component;

class Stores extends Component
{

    public $stores, $page,$ads;

    public function mount()
    {
        $this->stores = Store::where('status',1);

        if (session('city_id') and env('STORE') == "multi") {
            $this->stores = $this->stores->where('city_id', session('city_id'));
        }

        $this->stores = $this->stores->get();
        $this->page = Page::where('slug', 'STORES')->first();
        $this->ads = Ad::whereNull('store_id')->inRandomOrder()->get();
    }


    public function render()
    {
        return view('livewire.'.env('THEME').'.stores.stores')->layout('livewire.'.env('THEME').'.app');
    }
}
