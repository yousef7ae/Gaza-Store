<?php

namespace App\Http\Livewire\Site\Products;


use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;


class ProductConstant extends Component
{
    protected $listeners = ['refreshProductConstant'];

    public $product, $color, $size;

    function mount($product_id)
    {
        $this->refreshProductConstant();

        if (is_object($product_id)) {
            $this->product = $product_id;
        } else {
            $this->product = Product::find($product_id);
        }
    }

    function refreshProductConstant()
    {

    }

    function changeconstant($id){

        if (auth()->check()) {
            $old = Cart::where('user_id', auth()->id())->where('product_id', $id)->first();
        } else {
            $old = Cart::where('device_id', session()->getId())->where('product_id', $id)->first();
        }
        if ($old) {
            Cart::where('id', $old->id)->update([
                'constant' => ['color' => $this->color, 'size' => $this->size],
            ]);
        }

        $this->emit('refreshProductConstant');
    }

    public function render()
    {
        return view('livewire.'.env('THEME').'.products.product-constant')->layout('livewire.'.env('THEME').'.app');
    }
}
