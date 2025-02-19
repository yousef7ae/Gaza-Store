<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;

use App\Models\Address;
use App\Models\Coupon;
use App\Models\DeliveryFee;
use App\Models\Order;
use App\Models\PaymentGateway;
use App\Models\DeliveryMethod;
use App\Models\Product;
use App\Models\Cart;
use App\Models\District;
use App\Models\Store;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class CartsController extends Controller
{
    public function index()
    {
        $device_id = request('device_id') ? request('device_id') : request()->header('device_id');

        if (auth('sanctum')->id() and $device_id) {
            Order::where('device_id', $device_id)->update(['device_id' => null, 'user_id' => auth('sanctum')->id()]);
        }

        $carts = Cart::where(function ($q) use ($device_id) {
            if (auth('sanctum')->id()) {
                return $q->where('user_id', auth('sanctum')->id());
            } else {
                return $q->where('device_id', $device_id);
            }
        })->with('product', 'product.store', 'user')->get();

        $discount_code = "";
        $coupon_price = 0;
        $coupon_message = "";
        $coupon_percent = 0;
        if (request('coupon')) {
            $coupon = Coupon::where('code', request('coupon'))->where('status', 1)->whereIn('store_id', $carts->pluck('store_id')->toArray())->first();
            if (!$coupon) {
                $coupon_message = "coupon not exist";
            } else {
                $coupon_message = "success";
                $discount_code = $coupon->code;
                $coupon_price = $carts->sum('total') * ($coupon->value / 100);
                $coupon_percent = $coupon->value;
            }
        }

        $delivery_fee = DeliveryFee::whereIn('store_id', $carts->pluck('store_id')->toArray())->max('value');
        $delivery_fee_price = $delivery_fee ? $delivery_fee : 0;

        if (request('distance') >= 0) {
            $distance = request('distance') ? request('distance') : 0;

            $delivery_fee = DeliveryFee::where('from', '<=', $distance)->where('to', '>', $distance)->whereIn('store_id', $carts->pluck('store_id')->toArray())->first();
            if ($delivery_fee) {
                $delivery_fee_price = $delivery_fee->value;
            }
        }

        $redeem_points = 0;
        $redeem_price = 0;
        $redeem_message = "";

        if (request('redeem')) {
            if (auth('sanctum')->check()) {
                if (auth('sanctum')->user()->points < 1000) {
                    $redeem_message = "The number of points is less than 1000";
                } elseif (auth('sanctum')->user()->points > 100) {
                    $redeem_message = "The number of points is less than 100";
                } else {
                    $redeem_message = "success";
                    $redeem_points = intval(auth('sanctum')->user()->points / 100) * 100;
                    $redeem_price = intval(auth('sanctum')->user()->points / 100);
                }
            } else {
                $redeem_message = "you are not login";
            }
        }

        $data = [
            'carts' => $carts,
            'cart_total' => $carts->sum('total'),
            'delivery_price' => $delivery_fee_price,
            'discount_code' => $discount_code,
            'discount_price' => $coupon_price,
            'coupon_percent' => $coupon_percent,
            'discount_message' => $coupon_message,
            'redeem_points' => $redeem_points,
            'redeem_price' => $redeem_price,
            'redeem_message' => $redeem_message,
            'total' => $carts->sum('total') + $delivery_fee_price - ($coupon_price + $redeem_price),
            'payment_gateway' => PaymentGateway::select('id', 'name', 'description', 'image')->get(),
            'districts' => District::get(),
            'addresses' => Address::where('user_id', auth()->id())->get(),
        ];

        return response()->json(['status' => true, 'message' => $coupon_message, 'data' => $data]);
    }

    public function checkCoupon()
    {
        $device_id = request()->header('device_id') ? request()->header('device_id') : request('device_id');
        if (!request('coupon')) {
            return response()->json(['status' => false, 'message' => 'coupon is required']);
        }

        if (auth('sanctum')->check()) {
            $carts = Cart::where('user_id', auth('sanctum')->id())
                ->with('product', 'user')
                ->get();
        } else {
            $carts = Cart::where('device_id', $device_id)
                ->with('product', 'user')
                ->get();
        }

        $discount_code = '';
        $coupon_price = 0;
        $coupon_message = '';
        $coupon_percent = 0;

        $coupon = Coupon::where('code', request('coupon'))
            ->where('status', 1)
            ->where('expiration', '>=', Carbon::now())
            ->first();

        if (!$coupon) {
            return response()->json(['status' => false, 'message' => 'coupon not exists or expired']);
        } else {
            $cartsCoupon = $carts->where('product_id', $coupon->product_id);

            if ($cartsCoupon->count() == 0) {
                return response()->json(['status' => false, 'message' => 'There is no products for this coupon']);
            }

            $coupon_message = 'success';
            $discount_code = $coupon->code;
            $coupon_price = $cartsCoupon ? $cartsCoupon->sum('total') * ($coupon->value / 100) : 0;
            $coupon_percent = $coupon->value;
        }

        $data = [
            'coupon' => $coupon,
            'coupon_price' => $coupon_price,
            'total_carts' => $carts->sum('total'),
            'total_after_discount' => $carts->sum('total') - $coupon_price,
        ];

        return response()->json(['status' => true, 'message' => 'success', 'data' => $data]);
    }

    public function checkout()
    {
        $carts = Cart::where('user_id', auth('sanctum')->id())
            ->with('product', 'user')
            ->get();

        $discount_code = '';
        $coupon_price = 0;
        $coupon_message = '';
        $coupon_percent = 0;

//        if (request('coupon')) {
//            $coupon = Coupon::where('code', request('coupon'))->where('status', 1)->whereIn('store_id', $carts->pluck('store_id')->toArray())->first();
//            if (!$coupon) {
//                $coupon_message = "coupon not exist";
//            } else {
//                $coupon_message = "success";
//                $discount_code = $coupon->code;
//                $coupon_price = $carts->sum('total') * ($coupon->value / 100);
//                $coupon_percent = $coupon->value;
//            }
//        }

        $delivery_fee_price = 0;
        // $delivery_fee = DeliveryFee::whereIn('store_id', $carts->pluck('store_id')->toArray())->max('value');
        // $delivery_fee_price = $delivery_fee ? $delivery_fee : 0;
        // if (request('distance') >= 0) {
        //     $distance = request('distance') ? request('distance') : 0;
        //     $delivery_fee = DeliveryFee::where('from', '<=', $distance)->where('to', '>', $distance)->whereIn('store_id', $carts->pluck('store_id')->toArray())->first();
        //     if ($delivery_fee) {
        //         $delivery_fee_price = $delivery_fee->value;
        //     }
        // }

        $redeem_points = 0;
        $redeem_price = 0;
        $redeem_message = "";

        if (request('redeem')) {
            if (auth('sanctum')->check()) {
                if (auth('sanctum')->user()->points < 1000) {
                    $redeem_message = "The number of points is less than 1000";
                } elseif (auth('sanctum')->user()->points > 100) {
                    $redeem_message = "The number of points is less than 100";
                } else {
                    $redeem_message = "success";
                    $redeem_points = intval(auth('sanctum')->user()->points / 100) * 100;
                    $redeem_price = intval(auth('sanctum')->user()->points / 100);
                }
            } else {
                $redeem_message = "you are not login";
            }
        }

        $data = [
            'carts' => $carts,
            'cart_total' => $carts->sum('total'),
            'delivery_price' => $delivery_fee_price,
            'discount_code' => $discount_code,
            'discount_price' => $coupon_price,
            'coupon_percent' => $coupon_percent,
            'discount_message' => $coupon_message,
            'redeem_points' => $redeem_points,
            'redeem_price' => $redeem_price,
            'redeem_message' => $redeem_message,
            'total' => $carts->sum('total') + $delivery_fee_price - ($coupon_price + $redeem_price),
            'payment_gateway' => PaymentGateway::select('id', 'name', 'description', 'image')->get(),
            'delivery_method' => DeliveryMethod::typeList(),
            'districts' => District::all(),
            'addresses' => Address::where('user_id', auth()->id())->get(),
        ];

        return response()->json(['status' => true, 'message' => "Success", 'data' => $data]);
    }

    public function create()
    {
        $device_id = request()->header('device_id') ? request()->header('device_id') : request('device_id');

        $product = Product::find(request('product_id'));
        if (!$product) {
            return response()->json(['status' => false, 'message' => "Product not exist", 'data' => null]);
        }

        $carts = Cart::where(function ($q) use ($device_id) {
            if (auth('sanctum')->id()) {
                return $q->where('user_id', auth('sanctum')->id());
            } else {
                return $q->where('device_id', $device_id);
            }
        })->with('product', 'user')->get();

        if ($carts->count() > 0) {
            $cart_check = Cart::where(function ($q) use ($device_id) {
                if (auth('sanctum')->id()) {
                    return $q->where('user_id', auth('sanctum')->id());
                } else {
                    return $q->where('device_id', $device_id);
                }
            })->pluck('store_id')->toArray();
            if (!in_array($product->store_id, $cart_check)) {
                return response()->json(['status' => false, 'message' => "Not same store in cart", 'data' => null]);
            }
        }

        $qty = request('qty') ? request('qty') : 1;

        $old = Cart::where(function ($q) use ($device_id) {
            if (auth('sanctum')->id()) {
                return $q->where('user_id', auth('sanctum')->id());
            } else {
                return $q->where('device_id', $device_id);
            }
        })->where('product_id', $product->id)->first();

        if ($old) {
            $qty = $qty;
            Cart::where('id', $old->id)->update([
                'product_id' => $product->id,
                'product_name' => $product->name,
                'qty' => $qty,
                'price' => $product->price,
                'total' => $product->price * $qty,
                'user_id' => auth('sanctum')->id(),
                'store_id' => $product->store ? $product->store->id : null,
                'device_id' => auth('sanctum')->id() ? null : $device_id,
            ]);
        } else {
            Cart::create([
                'product_id' => $product->id,
                'product_name' => $product->name,
                'qty' => $qty,
                'price' => $product->price,
                'total' => $product->price * $qty,
                'user_id' => auth('sanctum')->id(),
                'store_id' => $product->store ? $product->store->id : null,
                'device_id' => auth('sanctum')->id() ? null : $device_id,
            ]);
        }

        $carts = Cart::where(function ($q) use ($device_id) {
            if (auth('sanctum')->id()) {
                return $q->where('user_id', auth('sanctum')->id());
            } else {
                return $q->where('device_id', $device_id);
            }
        })->with('product', 'user')->get();

        $data = [
            'carts' => $carts,
            'cart_total' => $carts->sum('total'),
            'delivery_price' => 0,
            'total' => $carts->sum('total'),
            'payment_gateway' => PaymentGateway::select('id', 'name', 'description')->get(),
            'addresses' => Address::where('user_id', auth('sanctum')->id())->get(),
        ];

        return response()->json(['status' => true, 'message' => "Success", 'data' => $data]);
    }

    function remove()
    {
        $device_id = request()->header('device_id') ? request()->header('device_id') : request('device_id');

        $product = Product::find(request('product_id'));

        if ($product) {
            $old = Cart::where(function ($q) use ($device_id) {
                if (auth('sanctum')->id()) {
                    return $q->where('user_id', auth('sanctum')->id());
                } else {
                    return $q->where('device_id', $device_id);
                }
            })->where('product_id', $product->id)->first();

            if ($old) {
                Cart::where('id', $old->id)->forceDelete();
            }
        }

        $carts = Cart::where(function ($q) use ($device_id) {
            if (auth('sanctum')->id()) {
                return $q->where('user_id', auth('sanctum')->id());
            } else {
                return $q->where('device_id', $device_id);
            }
        })->with('product', 'user')->get();

        $data = [
            'carts' => $carts,
            'cart_total' => $carts->sum('total'),
            'delivery_price' => 0,
            'total' => $carts->sum('total'),
            'payment_gateway' => PaymentGateway::select('id', 'name', 'description')->get(),
            'addresses' => Address::where('user_id', auth('sanctum')->id())->get(),
        ];

        return response()->json(['status' => true, 'message' => "Success", 'data' => ($carts->count() > 0 ? $data : null)]);
    }
}
