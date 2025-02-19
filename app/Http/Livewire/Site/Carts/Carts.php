<?php

namespace App\Http\Livewire\Site\Carts;

use App\Models\Address;
use App\Models\Cart;
use App\Models\DeliveryFee;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Page;
use App\Models\Coupon;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;

class Carts extends Component
{
    protected $listeners = ['refreshCarts'];

    public $page_data,$carts = [], $total = 0, $discount = 0, $tax = 0, $subTotal = 0, $initial, $priceTotal, $address_id, $note, $address = [], $add_new_address = false, $new_address = [];
    public $color, $size, $most_wonted_list;
    public $discount_code,$coupon,$coupon_price,$coupon_percent,$coupon_message,$delivery_fee_price;
    public $redeem_points, $redeem_price, $redeem_message, $redeem;
    public $distance,$cart_total;

    function mount()
    {

        $this->data();
        $this->address = Address::where('user_id', auth()->id())->get();
        if (auth()->check() and auth()->user()->country != null and auth()->user()->city != null) {
            $this->new_address['country'] = (auth()->user() and auth()->user()->country) ? auth()->user()->country->name : Country::where('id', session('country_id'))->first()->name;
            $this->new_address['city'] = (auth()->user() and auth()->user()->city) ? auth()->user()->city->name : City::where('id', session('city_id'))->first()->name;
        }

        $this->page_data = Page::where('slug', 'cart')->first();

        $this->most_wonted_list = \App\Models\Product::limit(10)->get();

    }

    function refreshCarts()
    {
        $this->data();
        $this->address = Address::where('user_id', auth()->id())->get();
        $this->add_new_address = false;
    }



    function data()
    {
        if (auth()->check()) {
            $carts = \App\Models\Cart::where('user_id', auth()->id())->with('product', 'user')->get();
        } else {
            $carts = Cart::where('device_id', session()->getId())->with('product', 'user')->get();
        }

        if ($carts->count() > 0) {
            Order::where('device_id', session()->getId())->update(['user_id' => auth()->id()]);
        }

        $this->discount_code = "";
        $this->coupon_price = 0;
        $this->coupon_message = "";
        $this->coupon_percent = 0;

        if ($this->coupon) {
            $coupon = Coupon::where('code', $this->coupon)->where('status', 1)
                ->whereIn('store_id', $carts->pluck('store_id')->toArray())
                ->first();
            if (!$coupon) {
                $this->coupon_message = "coupon not exist";
            } else {
                $this->coupon_message = "success";
                $this->discount_code = $coupon->code;
                $this->coupon_price = $carts->sum('total') * ($coupon->value / 100);
                $this->coupon_percent = $coupon->value;
            }
         }


        $delivery_fee = DeliveryFee::whereIn('store_id', $carts->pluck('store_id')->toArray())->max('value');
        $this->delivery_fee_price = $delivery_fee ? $delivery_fee : 0;

        if ($this->distance >= 0) {
            $distance = $this->distance ? $this->distance : 0;

            $delivery_fee = DeliveryFee::where('from', '<=', $distance)->where('to', '>', $distance)->whereIn('store_id', $carts->pluck('store_id')->toArray())->first();
            if ($delivery_fee) {
                $this->delivery_fee_price = $delivery_fee->value;
            }
        }

        $this->redeem_points = 0;
        $this->redeem_price = 0;
        $this->redeem_message = "";

        if ($this->redeem) {
            if (auth()->check()) {
                if (auth()->user()->points < 1000) {
                    $redeem_message = "The number of points is less than 1000";
                } elseif (auth()->user()->points > 100) {
                    $this->redeem_message = "The number of points is less than 100";
                } else {
                    $this->redeem_message = "success";
                    $this->redeem_points = intval(auth()->user()->points / 100) * 100;
                    $this->redeem_price = intval(auth()->user()->points / 100);
                }
            } else {
                $this->redeem_message = "you are not login";
            }
        }

        $this->carts = $carts;
        $this->cart_total = $carts->sum('total');
        $this->total = $carts->sum('total') - ($this->coupon_price+$this->redeem_price);

    }

    function remove($id)
    {
        Cart::where('id', $id)->delete();
        $this->data();
        $this->emit('success', __('Product Successfully Remove From Cart'));
        $this->emit('refreshCartShow');
        $this->emit('refreshCarts');
    }

    function plus($id)
    {
        $cart = Cart::where('id', $id)->first();
        $cart->qty = $cart->qty + 1;
        $cart->total = $cart->price * $cart->qty;
        if ($cart->qty < 1) {
            $cart->delete();
        } else {
            $cart->save();
        }
        $this->data();
        $this->emit('refreshCarts');
    }

    function minus($id)
    {
        $cart = Cart::where('id', $id)->first();
        $cart->qty = $cart->qty - 1;
        $cart->total = $cart->price * $cart->qty;
        if ($cart->qty < 1) {
            $cart->delete();
        } else {
            $cart->save();
        }
        $this->data();
        $this->emit('refreshCarts');
    }

    public function render()
    {
        return view('livewire.'.env('THEME').'.carts.carts')->layout('livewire.'.env('THEME').'.app');
    }

}
