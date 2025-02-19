<?php

namespace App\Http\Livewire\Site\Products;

use App\Models\Product;
use Livewire\Component;

class ProductCard extends Component
{

    public $product, $count, $rand;

    function mount($product_id, $count = 4)
    {

        $this->count = $count;

        if (is_object($product_id)) {
            $this->product = $product_id;
        } else {
            $this->product = Product::find($product_id);
        }

        $this->rand=rand(1,1000);
    }

    public function render()
    {
        return view('livewire.'.env('THEME').'.products.product-card')->layout('livewire.'.env('THEME').'.app');
    }

}
