<?php

namespace App\Http\Livewire\Site\Favorites;

use App\Models\Favorite;
use App\Models\Product;
use Livewire\Component;

class Favorites extends Component
{
    protected $listeners = ['refreshFavorites'];

    public $favorites = [], $total = 0, $discount = 0, $tax = 0, $subTotal = 0, $initial, $priceTotal;

    function mount()
    {
        $this->data();
    }

    function refreshFavorites()
    {
        $this->data();
    }

    function data()
    {
        if (auth()->check()) {
            $favorites = Favorite::where('user_id', auth()->id());
        } else {
            $favorites = Favorite::where('device_id', session()->getId());
        }
        $this->favorites = $favorites->get();
    }

    function remove($id)
    {
        Favorite::where('user_id', auth()->id())->where('id', $id)->delete();

        $this->data();
        $this->emit('success', __('Product Successfully Remove From Favorites.'));
        $this->emit('refreshFavoriteShow');
        $this->emit('refreshFavorites');


    }

    public function render()
    {

        return view('livewire.'.env('THEME').'.favorites.favorites')->layout('livewire.'.env('THEME').'.app');
    }

}
