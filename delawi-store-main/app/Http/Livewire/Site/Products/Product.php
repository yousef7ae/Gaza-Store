<?php

namespace App\Http\Livewire\Site\Products;

use Livewire\Component;
use App\Models\Coupon;

class Product extends Component
{

    protected $listeners = ['refreshModal'];

    public $product, $most_wonted_list, $product_rate_id;
    public $color, $size, $copone;

    function mount($product_id)
    {
        $this->product = \App\Models\Product::findOrFail($product_id);
        $this->most_wonted_list = \App\Models\Product::where('id', '!=', $product_id)->where('store_id', $this->product->store_id)->limit(10)->get();

        $this->copone = Coupon::where('product_id',$product_id)->first();

    }

    public function ProductRate($product_id)
    {
        $this->product_rate_id = $product_id;
    }

    public function refreshModal()
    {
        $this->product_rate_id = "";
    }

    public function render()
    {
        return view('livewire.'.env('THEME').'.products.product')->layout('livewire.'.env('THEME').'.app');
    }

}
