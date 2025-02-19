<?php

namespace App\Http\Livewire\Site\Products;

use App\Models\ProductRate;
use Livewire\Component;

class ProductRates extends Component
{
    public $product_rate, $product_rate_id, $product, $array;

    protected $listeners = ['refreshModal'];

    public function refreshModal()
    {

    }

    function mount($array = [])
    {
        if (!empty($array['product_rate_id'])) {
            $this->product_rate['product_id'] = $array['product_rate_id'];
        }
    }


    public function store()
    {
        $this->validate([
            'product_rate.rate' => 'required|in:0,1,2,3,4,5',
            'product_rate.comment' => 'required|string|min:1|max:2000',
        ]);

        $this->product_rate['user_id'] = auth()->user()->id;

        $product_rate = ProductRate::create($this->product_rate);
        $this->emit('success', __('Product Rate Successfully'));

    }



    public function render()
    {
        return view('livewire.'.env('THEME').'.products.product-rates')->layout('livewire.'.env('THEME').'.app');
    }

}
