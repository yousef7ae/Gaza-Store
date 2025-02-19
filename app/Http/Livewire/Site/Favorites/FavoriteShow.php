<?php

namespace App\Http\Livewire\Site\Favorites;

use App\Models\Favorite;
use Livewire\Component;

class FavoriteShow extends Component
{

    protected $listeners = ['refreshFavoriteShow'];

    public $count;

    function mount()
    {
        $this->refreshFavoriteShow();
    }

    function refreshFavoriteShow()
    {
        if (auth()->check()) {
            $carts = Favorite::where('user_id', auth()->id());
        } else {
            $carts = Favorite::where('device_id', session()->getId());
        }

        $this->count = $carts->count();
    }

    public function render()
    {
        return view('livewire.'.env('THEME').'.favorites.favorite-show')->layout('livewire.'.env('THEME').'.app');
    }

}
