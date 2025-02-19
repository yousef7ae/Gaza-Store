<?php

namespace App\Http\Livewire\Site\Carts;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\DeliveryFee;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentGateway;
use App\Models\Store;
use App\Models\StoreAccount;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;

class Checkout extends Component
{
    protected $listeners = ['refreshCarts'];

    public $carts = [], $total = 0, $discount = 0, $tax = 0, $subTotal = 0, $initial, $priceTotal, $address_id, $note, $address = [], $add_new_address = false, $new_address = [], $payment_gatewaies = [], $payment_gateway_id, $delivery_method = 1;
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
    }

    function refreshCarts()
    {
        $this->data();
        $this->address = Address::where('user_id', auth()->id())->get();
        $this->add_new_address = false;
    }

    function confirm()
    {

        $carts = Cart::where('user_id', auth()->id())->get();

        if (!$this->address_id) {
            $this->emit('alertDanger', __('Empty Address'));
            return false;
        }

        if ($carts->count() == 0) {
            $this->emit('alertDanger', __('Empty Cart'));
            return false;
        }

        $store_id = ($cart = Cart::where('user_id', auth()->id())->first()) ? $cart->product->store_id : 0;

        if (!$store_id) {
            $this->emit('alertDanger', __('Empty Store'));
            return false;
        }


        $order = Order::create([
            'order_number' => time() . rand(1000, 9000),
            'note' => request('note'),
            'discount' => 0,
            'total' => $carts->sum('total'),
            'coupon' => "",
            'store_id' => $store_id,
            'delivery_id' => null,
            'address_id' => $this->address_id,
            'payment_gateway_id' => $this->payment_gateway_id,
            'delivery_method' => $this->delivery_method,
            'user_id' => auth()->id(),
            'status' => 0,
        ]);

        foreach ($carts as $cart) {

            OrderDetail::create([
                'product_name' => $cart->product_name,
                'qty' => $cart->qty,
                'constant'=> $cart->constant,
                'price' => $cart->price,
                'discount' => $cart->discount,
                'total' => $cart->total,
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'store_id' => $cart->store_id,
                'user_id' => auth()->id(),
            ]);
        }

        Cart::where('user_id', auth()->id())->delete();

        $deliveries = User::role('Delivery')->get();
        foreach ($deliveries as $delivery) {

            $title = __("New order");
            $message = __('New order from') . " " . auth()->user()->name;
            $image = null;
            $order_id = $order->id;

            $delivery->notification($message, $title, $image, $order_id);
        }


        $this->redirect(route('profile.orders_details', $order->id));
    }

    function saveAddress()
    {

        if (!auth()->check()) {
            $this->emit('alertDanger', __('You are not login'));
            return false;
        }

        $validator = Validator::make($this->new_address, [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'country' => 'required',
            'city' => 'required',
            'location' => 'required',
            'zip_code' => 'required',
            'note' => 'required',
        ]);

        if (!$validator->passes()) {
            $this->emit('alertDanger', $validator->errors()->first());
            return false;
        }
        $this->new_address['user_id'] = auth()->id();
        Address::create($this->new_address);

        $this->emit('success', __('Address Successfully Added'));
        $this->emit('refreshCartShow');
        $this->emit('refreshCarts');

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

        $store = Store::whereIn('id',$this->carts->pluck('store_id')->toArray())->first();

        $this->payment_gatewaies = PaymentGateway::whereIn('id',$store->payment_gateways)->get();

        return view('livewire.' . env('THEME') . '.checkout')->layout('livewire.' . env('THEME') . '.app');
    }

}
