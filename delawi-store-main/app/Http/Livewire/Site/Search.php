<?php

namespace App\Http\Livewire\Site;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Livewire\Component;

class Search extends Component
{
    public $stores = [],$categories = [],$brands = [],$products = [],$search_string;

    public function mount()
    {

    }

    public function render()
    {
        $this->stores = Store::where('name', 'LIKE','%%'.$this->search_string.'%%')->limit('10')->get();
        $this->categories = Category::where('name', 'LIKE','%%'.$this->search_string.'%%')->limit('10')->get();
        $this->brands = Brand::where('name', 'LIKE','%%'.$this->search_string.'%%')->limit('10')->get();
        $this->products = Product::where('name', 'LIKE','%%'.$this->search_string.'%%')->limit('10')->get();

        return view('livewire.'.env('THEME').'.search')->layout('livewire.'.env('THEME').'.app');
    }
}
