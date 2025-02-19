<?php

namespace App\Http\Livewire\Site\Carts;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    protected $listeners = ['refreshCartShow'];

    public $count;

    function mount()
    {
        $this->refreshCartShow();
    }

    function refreshCartShow()
    {

        if (auth()->check()) {
            $carts = Cart::where('user_id', auth()->id())->get();
        } else {
            $carts = Cart::where('device_id', session()->getId())->get();
        }

        $this->count = $carts->count();
    }

    public function render()
    {
        return view('livewire.'.env('THEME').'.carts.cart-show')->layout('livewire.'.env('THEME').'.app');
    }

}
