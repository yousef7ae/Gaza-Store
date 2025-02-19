<?php

namespace App\Http\Livewire\Site\Carts;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;

class AddToCart extends Component
{

    public $product, $is_cart,$string;

    function mount($product_id,$string = false)
    {
        $this->string = $string;
        if (is_object($product_id)) {
            $this->product = $product_id;
        } else {
            $this->product = Product::find($product_id);
        }

        $this->is_cart = $this->product->is_cart;
    }

    function add()
    {

        $qty = 1;
        if ($this->product) {
            if (auth()->check()) {
                $old = Cart::where('product_id', $this->id)->where('user_id', auth()->id())->first();
            } else {
                $old = Cart::where('product_id', $this->id)->where('device_id', session()->getId())->first();
            }

            if ($old) {
                $qty = $old->qty + $qty;
                Cart::where('id', $old->id)->update([
                    'product_id' => $this->product->id,
                    'store_id' => $this->product->store_id,
                    'product_name' => $this->product->name,
                    'qty' => $qty,
                    'price' => $this->product->price,
                    'total' => $this->product->price * $qty,
                    'user_id' => auth()->id(),
                    'device_id' => session()->getId(),
                ]);
            } else {
                Cart::create([
                    'product_id' => $this->product->id,
                    'store_id' => $this->product->store_id,
                    'product_name' => $this->product->name,
                    'qty' => $qty,
                    'price' => $this->product->price,
                    'total' => $this->product->price * $qty,
                    'user_id' => auth()->id(),
                    'device_id' => session()->getId(),
                ]);
            }
        }

        $this->is_cart = $this->product->is_cart;

        $this->emit('success', __('Product Successfully Added To Cart'));
        $this->emit('refreshCartShow');
    }


    function remove()
    {
        if (auth()->check()) {
            $old = Cart::where('product_id', $this->product->id)->where('user_id', auth()->id())->first();
        } else {
            $old = Cart::where('product_id', $this->product->id)->where('device_id', session()->getId())->first();
        }

        if($old){
            $old->delete();
        }

        $this->is_cart = $this->product->is_cart;

        $this->emit('success', __('Product Successfully Removed From Cart'));
        $this->emit('refreshCartShow');

    }

    public function render()
    {
        return view('livewire.'.env('THEME').'.carts.add-to-cart')->layout('livewire.'.env('THEME').'.app');
    }

}
