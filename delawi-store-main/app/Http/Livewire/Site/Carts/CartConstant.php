<?php

namespace App\Http\Livewire\Site\Carts;


use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;


class CartConstant extends Component
{
    protected $listeners = ['refreshCartConstant'];

    public $product, $color, $size;

    function mount($product_id)
    {
        $this->refreshCartConstant();

        if (is_object($product_id)) {
            $this->product = $product_id;
        } else {
            $this->product = Product::find($product_id);
        }

    }
    function refreshCartConstant()
    {

    }

//foreach

    function changeconstant($id){
//        foreach (Cart::where('product_id',$id)->get() as $carts){
//            $carts->constant   =  ['color'=>$this->color, 'size'=>$this->size];
//            $carts->save();
//        }
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

        $this->emit('refreshCartConstant');
    }

    public function render()
    {
        return view('livewire.'.env('THEME').'.carts.cart-constant')->layout('livewire.'.env('THEME').'.app');
    }

}
