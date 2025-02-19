<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\DeliveryFee;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderUser;
use App\Models\User;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        if (request()->header('device_id')) {
            Cart::where('device_id', request()->header('device_id'))->update(['device_id' => null, 'user_id' => auth('sanctum')->id()]);
        }

        $orders = Order::with('store', 'user', 'delivery', 'address', 'payment_gateway');
        if (auth('sanctum')->user()->hasRole('Delivery') and request('delivery') == 1 and request('status') != "1") {
            $ordersIDS = OrderUser::where('user_id', auth('sanctum')->id())->pluck('order_id')->toArray();
            $orders = $orders->whereNotIn('id', $ordersIDS)->whereNull('delivery_id');

        } elseif (auth('sanctum')->user()->hasRole('Delivery') and request('delivery') == 2) {
            $orders = $orders->where('delivery_id', auth('sanctum')->id())->where('status', 1);

        } elseif (auth('sanctum')->user()->hasRole('Delivery') and request('delivery') and request('status') == "1") {
            $orders = $orders->where('delivery_id', auth('sanctum')->id())->where('status', 1);

        } else if (auth('sanctum')->user()->hasRole('Merchant') and request('merchant')) {
            $orders = $orders->where('store_id', auth('sanctum')->user()->stores()->pluck('id')->toArray());

        } else {
            if (auth('sanctum')->user()->hasRole('Customer')) {
                $orders = $orders->where('user_id', auth('sanctum')->id());
            }
        }

        if (request('status')) {
            if (request('status') == "-1") {
                $orders = $orders->whereIn('status', [0, 1]);
            }elseif (request('status') == "-2") {
                $orders = $orders->where('status', '>',0);
            } else {
                $orders = $orders->where('status', request('status'));
            }
        }

        if(request('status') === "0"){
            $orders = $orders->where('status', 0);
        }

        if (request('store_id')) {
            $orders = $orders->whereIn('store_id', request('store_id'));
        }

        $orders = $orders->with('OrderDetails', 'OrderDetails.product')->with('store')->orderBy('id', 'DESC')->paginate(10);


        return response()->json(['status' => true, 'data' => $orders->items()]);
    }

    public function store()
    {
        if (!request('address_id')) {
            return response()->json(['status' => false, 'message' => "address is required"]);
        }

        if (!request('payment_gateway_id')) {
            return response()->json(['status' => false, 'message' => "payment gateway is required"]);
        }

        $carts = Cart::where(function ($q) {
            if (auth('sanctum')->id()) {
                return $q->where('user_id', auth('sanctum')->id());
            } else {
                return $q->where('device_id', request()->header('device_id'));
            }
        })->get();

        if ($carts->count() == 0) {
            return response()->json([
                "status" => false,
                "message" => "Empty Cart",
            ]);
        }

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
        if (request('distance')) {
            $delivery_fee = DeliveryFee::where('from', '<=', request('distance'))->where('to', '>', request('distance'))->whereIn('store_id', $carts->pluck('store_id')->toArray())->first();
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

        $order = Order::create([
            'order_number' => time() . rand(1000, 9000),
            'note' => request('note'),
            'discount' => $coupon_price,
            'total' => ($carts->sum('total') + $delivery_fee_price) - $coupon_price,
            'coupon' => request('coupon'),
            'store_id' => $carts[0]->store_id,
            'delivery_id' => null,
            'address_id' => request('address_id'),
            'payment_gateway_id' => request('payment_gateway_id'),
            'delivery_method' => request('delivery_method'),
            'user_id' => auth('sanctum')->id(),
            'status' => 0,
            'delivery_fee' => $delivery_fee_price,
        ]);

        foreach ($carts as $cart) {

            OrderDetail::create([
                'product_name' => $cart->product_name,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'discount' => $cart->discount,
                'total' => $cart->total,
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'store_id' => $cart->store_id,
                'user_id' => $cart->user_id,
            ]);
        }

        Cart::where('user_id', auth('sanctum')->id())->forceDelete();

        $title = __("New order");
        $message = __('New order from') . " " . auth()->user()->name;
        $image = null;
        $order_id = $order->id;
        if ($order->store and $order->store->user) {
            $order->store->user->notification($message, $title, $image, $order_id);
        }

        return response()->json(['status' => true, 'data' => $order]);
    }

    public function show($id)
    {
        $notification = false;

        $explode = explode(":", $id);

        $order = Order::query();
        if (auth('sanctum')->user()->hasRole('Delivery')) {
            $order = $order->where(function ($q) {
                return $q->where('delivery_id', auth('sanctum')->id())->orWhere('status', 0);
            });
        } else if (auth('sanctum')->user()->hasRole('Merchant')) {
            $order = $order->whereIn('store_id', auth('sanctum')->user()->stores()->pluck('id')->toArray());
        } else {
            $order = $order->where('user_id', auth('sanctum')->id());
        }

        $order = $order->where(function ($q) use ($explode) {
            return $q->where(function ($q) use ($explode) {
                return $q->where('id', $explode[0])->orWhere('order_number', $explode[0]);
            });
        });

        $order = $order->with('store', 'OrderDetails', 'OrderDetails.product', 'user', 'delivery', 'address', 'payment_gateway')->first();

        if (!$order) {
            return response()->json(['status' => false, 'message' => "you don't have permissions for this order or order not exist", 'data' => $order]);
        }

        if (!empty($explode[1])) {
            $target = User::find($explode[1]);
            if ($target) {
                if ($target->hasRole('Merchant')) {
                    $order->status = 3;
                    $order->save();
                }

                if ($target->hasRole('Customer')) {
                    $order->status = 4;
                    $order->save();
                }

                $notification = true;

            }
        } else {
            if (request('status') == -1 and $order->status != 0) {
                return response()->json(['status' => false, 'message' => "You cannot cancel the order now"]);
            }
            if (request('status')) {
                $order->status = request('status');
                $order->save();
                $notification = true;
            }
        }

        if ($notification) {
            $title = __("Change Order Status") . ' ' . $order->string_status;
            $message = __('Change Order Status') . ' ' . $order->string_status . ' ' . __('By') . " " . auth()->user()->name;
            $image = null;
            $order_id = $order->id;
            $order->store->user->notification($message, $title, $image, $order_id);
            $order->user->notification($message, $title, $image, $order_id);
        }

        return response()->json(['status' => true, 'message' => "success", 'order_id' => $order->id , 'data' => $order]);
    }

    public function update($id)
    {
        $notification = false;

        $explode = explode(":", $id);
        $order = Order::find($explode[0]);

        if (!$order) {
            return response()->json([
                "status" => false,
                "message" => "Order not exist",
            ]);
        }

        if (!empty($explode[1])) {
            $user = User::where('id', $explode[1])->first();
            if ($user->hasRole('Merchant') or $user->hasRole('Delivery')) {
                $status = 1;
                $notification = true;
            } elseif ($user->hasRole('Customer')) {
                $notification = true;
                $status = 2;
            } else {
                $status = request('status') ? request('status') : 0;
            }
        } else {
            $status = request('status') ? request('status') : 0;
        }

        if (request('add')) {
            $order = Order::where('id', $explode[0])->update([
                'delivery_id' => auth('sanctum')->id(),
                'status' => $status,
            ]);

            $notification = true;

        } else {

            if($status) {
                $order = Order::where('id', $explode[0])->update([
                    'status' => $status,
                ]);

                $notification = true;
            }
        }

        $order = Order::where('id', $explode[0])->with('delivery')->first();

        if ($notification) {
            $title = __("Change Order Status") . ' ' . $order->string_status;
            $message = __('Change Order Status') . ' ' . $order->string_status . ' ' . __('By') . " " . auth()->user()->name;
            $image = null;
            $order_id = $order->id;
            $order->store->user->notification($message, $title, $image, $order_id);
            $order->user->notification($message, $title, $image, $order_id);
        }

        OrderUser::updateOrCreate(['user_id' => auth('sanctum')->id(), 'order_id' => $order->id]);
        return response()->json(['status' => true, 'data' => $order]);

    }

    public function delete($id)
    {
        OrderUser::updateOrCreate(['user_id' => auth('sanctum')->id(), 'order_id' => $id]);
        return response()->json(['status' => true, 'message' => "success", 'data' => null]);
    }

    public function statistics()
    {
        if (request('date_from') and request('date_from')) {
            $start_month = Carbon::createFromFormat("Y-m", request('date_from'))->month;
            $start_year = Carbon::createFromFormat("Y-m", request('date_from'))->year;
            $end_month = Carbon::createFromFormat("Y-m", request('date_to'))->month;
            $end_year = Carbon::createFromFormat("Y-m", request('date_to'))->year;
            $start = Carbon::createFromFormat("Y-m", request('date_from'));
            $end = Carbon::createFromFormat("Y-m", request('date_to'))->addMonths(1);

        } else {

            $start_month = Carbon::now()->subMonths(12)->month;
            $start_year = Carbon::now()->subMonths(12)->year;
            $end_month = Carbon::now()->subMonths(1)->month;
            $end_year = Carbon::now()->year;
            $start = Carbon::now()->addMonths(1);
            $end = Carbon::now()->subMonths(12);
        }

        if ($months_count = $start->diffInMonths($end) != 12) {
            return response()->json([
                "status" => false,
                "message" => "Period not 12 months",
            ]);
        }

        $orders = [];
        for ($year = $start_year; $year <= $end_year; $year++) {
            for ($month = 1; $month <= 12; $month++) {
                if ($year == $start_year and $month >= $start_month and $year >= $start_year) {
                    $orders[] = ['year' => $year, 'month' => $month, 'count' => (int)Order::where('user_id', auth('sanctum')->id())->whereMonth('created_at', $month)->whereYear('created_at', $year)->count()];
                }

                if ($year == $end_year and $month <= $end_month and $year <= $end_year) {
                    $orders[] = ['year' => $year, 'month' => $month, 'count' => (int)Order::where('user_id', auth('sanctum')->id())->whereMonth('created_at', $month)->whereYear('created_at', $year)->count()];
                }
            }
        }

        if (!$orders) {
            return response()->json([
                "status" => false,
                "message" => "Order not exist",
            ]);
        }

        return response()->json(['status' => true, 'data' => ['total' => (float)Order::where('user_id', auth('sanctum')->id())->sum('total'), 'count' => (int)Order::where('user_id', auth('sanctum')->id())->count(), 'orders' => $orders]]);
    }
}
