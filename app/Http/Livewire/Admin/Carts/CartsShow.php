<?php

namespace App\Http\Livewire\Admin\Carts;


use App\Models\Cart;
use Livewire\Component;

class CartsShow extends Component
{

    public $item;

    function mount($id)
    {
        $this->item = Cart::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.carts.carts-show')->layout('livewire.admin.app');
    }

}
