<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\PaymentGateway;
use App\Models\Store;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::whereIn('store_id', auth('sanctum')->user()->stores()->pluck('id')->toArray())->with('store', 'category', 'product')->get();
//        $coupons = Coupon::with( 'store','category','product')->get();
        return response()->json(['status' => true, 'message' => "success", 'data' => $coupons]);
    }

    public function store()
    {
        $validator = Validator::make(request()->input(), [
            'code' => 'required|unique:' . Coupon::class,
            'value' => 'required|digits_between:1,100',
            'store_id' => 'required',
            'category_id' => 'nullable',
            'product_id' => 'nullable',
        ]);

        if (!$validator->passes()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()]);
        }

        $coupon = Store::create($this->coupon);

        $this->emit('success', 'Coupon  successfully Added.');
        $this->coupon = [];

    }


    public function show($code)
    {
        $coupon = Coupon::where('code', $code)->with('product', 'store', 'category')->first();

        if (!$coupon) {
            return response()->json(['status' => false, 'message' => "Coupon not exist", 'data' => $coupon]);
        }


        if (auth('sanctum')->check()) {
            $carts = Cart::where('user_id', auth('sanctum')->id())->with('product', 'user')->get();
        } else {
            $carts = Cart::where('device_id', request()->header('device_id'))->with('product', 'user')->get();
        }

        if ($carts->count() > 0) {
            Order::where('device_id', request()->header('device_id'))->update(['user_id' => auth('sanctum')->id()]);
        }

        $data = [
            'carts' => $carts,
            'cart_total' => $carts->sum('total'),
            'delivery_price' => 0,
            'total' => $carts->sum('total'),
            'payment_gateway' => PaymentGateway::select('id', 'name', 'description')->get(),
            'addresses' => Address::where('user_id', auth('sanctum')->id())->get(),
        ];

        return response()->json(['status' => true, 'message' => "success", 'data' => ['coupon' => $coupon, 'cart' => $data]]);
    }

    public function create()
    {
        $validator = Validator::make(request()->input(), [
            'code' => 'required|unique:' . Coupon::class,
            'value' => 'required|digits_between:1,100',
            'store_id' => 'required',
            'category_id' => 'nullable',
            'product_id' => 'nullable',
        ]);

        if (!$validator->passes()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()]);
        }


        $address = Coupon::create([
            'code' => request('code'),
            'value' => request('value'),
            'store_id' => request('store_id'),
            'category_id' => request('category_id'),
            'product_id' => request('product_id'),
            'user_id' => auth('sanctum')->id(),
        ]);

        return response()->json(['status' => true, 'message' => 'success', 'data' => $address]);
    }

    public function change_status($coupon_id)
    {

        $coupon = Coupon::where('id', $coupon_id)->first();
        if (!$coupon) {
            return response()->json(['status' => false, 'message' => "Coupon not exist", 'data' => []]);
        }

        if (!in_array($coupon->store_id, auth('sanctum')->user()->stores()->pluck('id')->toArray())) {
            return response()->json(['status' => false, 'message' => "Error Permission", 'data' => []]);
        }

        $coupon->status = request('status') ? 1 : 0;
        $coupon->save();

        return response()->json(['status' => true, 'message' => "Success", 'data' => $coupon]);
    }

}
