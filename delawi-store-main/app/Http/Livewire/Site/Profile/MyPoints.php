<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Order;
use App\Models\Page;
use App\Models\Store;
use Livewire\Component;

class MyPoints extends Component
{
    public $page, $orders, $stores;

    public function mount()
    {

        $this->orders = Order::where('user_id', auth()->id())->where('status',4)->get();
        $this->stores = Store::first();


        $this->page = Page::where('slug', 'Profile')->first();
    }

    public function render()
    {
        return view('livewire.'.env('THEME').'.profile.my-points')->layout('livewire.'.env('THEME').'.app');
    }
}
