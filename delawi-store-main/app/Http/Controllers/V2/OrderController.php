<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\DeliveryFee;
use App\Models\DeliveryMethod;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderUser;
use App\Models\Status;
use App\Models\Store;
use App\Models\StoreAccount;
use App\Models\StoreJoin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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
        } else {
            return response()->json(['status' => false, 'message' => "Not Found Data"]);
        }
        if (request('status')) {
            if (request('status') == "-1") {
                $orders = $orders->whereIn('status', [0, 1]);
            } elseif (request('status') == "-2") {
                $orders = $orders->where('status', '>', 0);
            } else {
                $orders = $orders->where('status', request('status'));
            }
        }

        if (request('status') === "0") {
            $orders = $orders->where('status', 0);
        }

        if (request('store_id')) {
            $orders = $orders->whereIn('store_id', request('store_id'));
        }
        $orders = $orders->with('OrderDetails', 'OrderDetails.product')->with('store')->orderBy('id', 'DESC')->paginate(10);
        return response()->json(['status' => true, 'data' => $orders->items()]);
    }

    public function index_delivery()
    {
        $orders = Order::with('store', 'user', 'delivery', 'address', 'payment_gateway');
        if (auth('sanctum')->user()->hasRole('Delivery')) {
            $orders = $orders->where('delivery_id', auth('sanctum')->id())->where('status', request('status'));
        } else {
            return response()->json(['status' => false, 'message' => "Not Found Data"]);
        }

        if (request('status')) {
            if (request('status') == "-1") {
                $orders = $orders->whereIn('status', [0, 1]);
            } elseif (request('status') == "-2") {
                $orders = $orders->where('status', '>', 0);
            } else {
                $orders = $orders->where('status', request('status'));
            }
        }

        if (request('status') === "0") {
            $orders = $orders->where('status', 0);
        }

        if (request('store_id')) {
            $orders = $orders->whereIn('store_id', request('store_id'));
        }

        $orders = $orders->with('OrderDetails', 'OrderDetails.product')->with('store')->orderBy('id', 'DESC')->paginate(10);
        return response()->json(['status' => true, 'message' => "success", 'data' => $orders->items()]);
    }

    public function index_delivery_status()
    {
        $orders = Order::with('store', 'user', 'delivery', 'address', 'payment_gateway');

        if (auth('sanctum')->user()->hasRole('Delivery') and request('status') == "2") {
            $orders = $orders->where('delivery_id', auth('sanctum')->id())->where('status', 2);
        } elseif (auth('sanctum')->user()->hasRole('Delivery') and request('delivery') == 2 and request('status') == "3") {
            $orders = $orders->where('delivery_id', auth('sanctum')->id())->where('status', 3);
        } elseif (auth('sanctum')->user()->hasRole('Delivery') and request('delivery') == 2 and request('status') == "4") {
            $orders = $orders->where('delivery_id', auth('sanctum')->id())->where('status', 4);
        } else {
            return response()->json(['status' => false, 'message' => "Not Found Data"]);
        }
        if (request('status')) {
            if (request('status') == "-1") {
                $orders = $orders->whereIn('status', [0, 1]);
            } elseif (request('status') == "-2") {
                $orders = $orders->where('status', '>', 0);
            } else {
                $orders = $orders->where('status', request('status'));
            }
        }

        if (request('status') === "0") {
            $orders = $orders->where('status', 0);
        }

        if (request('store_id')) {
            $orders = $orders->whereIn('store_id', request('store_id'));
        }
        $orders = $orders->with('OrderDetails', 'OrderDetails.product')->with('store')->orderBy('id', 'DESC')->paginate(10);
        return response()->json(['status' => true, 'data' => $orders->items()]);
    }

    public function index_Merchant()
    {
        $orders = Order::with('store', 'user', 'delivery', 'address', 'payment_gateway');
        if (auth('sanctum')->user()->hasRole('Merchant') and request('merchant')) {
            $orders = $orders->where('store_id', auth('sanctum')->user()->stores()->pluck('id')->toArray());
        } else {
            return response()->json(['status' => false, 'message' => "Not Found Data"]);
        }
        if (request('status')) {
            if (request('status') == "-1") {
                $orders = $orders->whereIn('status', [0, 1]);
            } elseif (request('status') == "-2") {
                $orders = $orders->where('status', '>', 0);
            } else {
                $orders = $orders->where('status', request('status'));
            }
        }

        if (request('status') === "0") {
            $orders = $orders->where('status', 0);
        }

        if (request('store_id')) {
            $orders = $orders->whereIn('store_id', request('store_id'));
        }
        $orders = $orders->with('OrderDetails', 'OrderDetails.product')->with('store')->orderBy('id', 'DESC')->paginate(10);
        return response()->json(['status' => true, 'data' => $orders->items()]);
    }

    public function index_Customer()
    {
        $orders = Order::with('store', 'user', 'delivery', 'address', 'payment_gateway', 'order_status');
        if (auth('sanctum')->user()->hasRole('Customer')) {
            $orders = $orders->where('user_id', auth('sanctum')->id());
        } else {
            return response()->json(['status' => false, 'message' => "You Don't Have Customer Permission"]);
        }
        if (request('status')) {
            if (request('status') == "-1") {
                $orders = $orders->whereIn('status', [0, 1, 2, 3, 4, 5]);
                $orders->status = Status::where('key', -1)->get();
            } elseif (request('status') == "-2") {
                $orders = $orders->where('status', '>', 0);
            } else {
                $orders = $orders->where('status', request('status'));
            }
        }

        if (request('status') === "0") {
            $orders = $orders->where('status', 0);
        }

        if (request('store_id')) {
            $orders = $orders->whereIn('store_id', request('store_id'));
        }

        $orders = $orders->with('OrderDetails', 'OrderDetails.product')->with('store')->orderBy('id', 'DESC')->paginate(10);
        return response()->json(['status' => true, "message" => "successfully", 'data' => $orders->items()]);
    }

    public function statusList()
    {
        $status = Status::where('status', 0)->get();
        return response()->json(['status' => true, "message" => "success", 'data' => $status]);
    }

    public function store()
    {
        $validator = Validator::make(request()->input(), [
            'address_id' => 'nullable',
            'payment_gateway_id' => 'required',
            'delivery_method_type' => 'required',
            'district_id' => 'nullable',
        ]);

        if (!$validator->passes()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()]);
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

        $coupon = null;
        $coupon_price = 0;
        if (request('coupon_id')) {
            $coupon = Coupon::findOrFail(request('coupon_id'));

            if ($coupon) {
                $cartsCoupon = $carts->where('product_id', $coupon->product_id);

                $coupon_message = "success";
                $discount_code = $coupon->code;
                $coupon_price = $cartsCoupon ? $cartsCoupon->sum('total') * ($coupon->value / 100) : 0;
                $coupon_percent = $coupon->value;
            }
        }

        $delivery_fee = 0;
        $delivery_fee_price = 0;

//        if (request('delivery_method_id') != "1") {
//            $delivery_fee = DeliveryFee::whereIn('store_id', $carts->pluck('store_id')->toArray())->max('value');
//            $delivery_fee_price = $delivery_fee ? $delivery_fee : 0;
//
//            if ($carts->sum('total') > 0) {
//                $distance = $carts->sum('total') ? $carts->sum('total') : 0;
//
//                $delivery_fee = DeliveryFee::where('from', '<=', $distance)->where('to', '>', $distance)->whereIn('store_id', $carts->pluck('store_id')->toArray())->first();
//                if ($delivery_fee) {
//                    $delivery_fee_price = $delivery_fee->value;
//                }
//            }
//        }

        $redeem_points = 0;
        $redeem_price = 0;
        $redeem_message = "";

        if (request('redeem')) {
            if (auth('sanctum')->check()) {
                if (auth('sanctum')->user()->points < 100) {
                    $redeem_message = "The number of points is less than 1000";
                } else {
                    $redeem_message = "success";
                    $redeem_points = intval(auth('sanctum')->user()->points / 100) * 100;
                    $redeem_price = intval(auth('sanctum')->user()->points / 100);

                    if ($redeem_price > ($carts->sum('total') + $delivery_fee_price - $coupon_price)) {
                        $redeem_points = ($carts->sum('total') + $delivery_fee_price - $coupon_price) * 100;
                        $redeem_price = ($carts->sum('total') + $delivery_fee_price - $coupon_price);
                    }

                    $user = User::where('id', auth('sanctum')->id())->first();
                    $user->points = $user->points - $redeem_points;
                    $user->save();
                }
            } else {
                $redeem_message = "you are not login";
            }
        }

        $district = null;

        if (request('delivery_method_type') != 1) {
            $validator = Validator::make(request()->input(), [
                'district_id' => 'required|exists:districts,id',
            ]);

            if (!$validator->passes())
                return response()->json(["status" => false, "message" => $validator->errors()->first()]);

            $delivery_method = DeliveryMethod::typeList(0);

            $district = District::find(request('district_id'));
        }

        $delivery_price = $district ? $district->delivery_price : 0;

        $order = Order::create([
            'order_number' => time() . rand(1000, 9000),
            'note' => request('note'),
            'discount' => $coupon_price,
            'coupon' => request('coupon'),
            'district_id' => $district ? $district->id : null,
            'district_delivery_price' => $delivery_price,
            'store_id' => $carts[0]->store_id,
            'delivery_id' => null,
            'address_id' => request('address_id'),
            'payment_gateway_id' => request('payment_gateway_id'),
            'delivery_method_id' => request('delivery_method_type'),
            'user_id' => auth('sanctum')->id(),
            'status' => 0,
            'delivery_fee' => $delivery_fee_price,
            'redeem_price' => $redeem_price,
            'discount_price' => $coupon_price,
            'order_total' => $carts->sum('total'),
            'total' => ($carts->sum('total') + $delivery_price) - ($coupon_price + $redeem_price),
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

        $store_account = StoreAccount::create([
            'store_id' => $carts[0]->store_id,
            'order_id' => $order->id,
            'amount' =>  $order->total,
            'date' => \Illuminate\Support\Carbon::now()
        ]);

        Cart::where('user_id', auth('sanctum')->id())->forceDelete();

        $title = __("New order");
        $message = __('New order from') . " " . auth()->user()->name;
        $image = null;
        $order_id = $order->id;

        if ($order->store and $order->store->user) {
            $order->store->user->notification($message, $title, $image, ['order_id' => $order_id]);
        }

        return response()->json(['status' => true, 'data' => $order, 'redeem_price' => $redeem_price]);
    }

    public function show($id)
    {
        $notification = false;

        $explode = explode(":", $id);

        $order = Order::query();

        if (auth('sanctum')->user()->hasRole('Merchant') and request('merchant') == "1") {
            $order = $order->where('store_id', auth('sanctum')->user()->stores()->pluck('id')->toArray());
        }

        if (auth('sanctum')->user()->hasRole('Delivery') and request('delivery') == "1") {
            $ordersIDS = OrderUser::where('user_id', auth('sanctum')->id())->pluck('order_id')->toArray();
            $order = $order->whereNotIn('id', $ordersIDS)->whereNull('delivery_id');
        }

        if (auth('sanctum')->user()->hasRole('Customer') and request('customer') == "1") {
            $order = $order->where('user_id', auth('sanctum')->id());
        }

        if (auth('sanctum')->user()->hasRole('Delivery') and auth('sanctum')->user()->store_join()->count() > 0) {
            $arrayListDeliveries = auth('sanctum')->user()->store_join()->pluck('store_id');

            if ($store = auth('sanctum')->user()->stores()->first()) {
                $arrayListDeliveries[] = $store->id;
            }

            $order = $order->whereIn('store_id', $arrayListDeliveries);
        }

        $order = $order->where(function ($q) use ($explode) {
            return $q->where(function ($q) use ($explode) {
                return $q->where('id', $explode[0])->orWhere('order_number', $explode[0]);
            });
        });

        $order = $order->with('store', 'OrderDetails', 'OrderDetails.product', 'user', 'delivery', 'address', 'payment_gateway', 'delivery_method')->first();

        if (!$order) {
            return response()->json(['status' => false, 'message' => "you don't have permissions for this order or order not exist", 'data' => $order]);
        }

        if (!empty($explode[1])) {

            $target = User::find($explode[1]);

            if ($target) {

                if ($target->hasRole('Merchant') and $order->status == 2) {
                    $order->status = 3;
                    $order->save();
                } elseif ($target->hasRole('Customer') and $order->status == 3) {
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
            $order->store->user->notification("Merchant: " . $message, "Merchant: " . $title, $image, ['order_id' => $order_id]);
            $order->user->notification("Customer: " . $message, "Customer: " . $title, $image, ['order_id' => $order_id]);
        }

        return response()->json(['status' => true, 'message' => "success", 'order_id' => $order->id, 'data' => $order]);
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
            if ($status) {
                $order = Order::where('id', $explode[0])->update([
                    'status' => $status,
                ]);

                $notification = true;
            }
        }

        if (request('status') == 5) {
            $orderid = Order::where('id', $id)->first();
            $user = User::where('id', $orderid->user_id)->first();
            $user->points = $user->points + $orderid->redeem_price;
            $user->save();
        }

        $order = Order::where('id', $explode[0])->with('delivery')->first();

        if ($notification) {
            $title = __("Change Order Status") . ' ' . $order->string_status;
            $message = __('Change Order Status') . ' ' . $order->string_status . ' ' . __('By') . " " . auth()->user()->name;
            $image = null;
            $order_id = $order->id;

            if (auth('sanctum')->id() != $order->store->user->id) {
                $order->store->user->notification("Merchant: " . $message, "Merchant: " . $title, $image, ['order_id' => $order_id]);
            }

            if (auth('sanctum')->id() != $order->user->id) {
                $order->user->notification("Customer: " . $message, "Customer: " . $title, $image, ['order_id' => $order_id]);
            }
        }

        OrderUser::updateOrCreate(['user_id' => auth('sanctum')->id(), 'order_id' => $order->id]);
        return response()->json(['status' => true, 'message' => "success", 'data' => $order]);
    }

    public function update_order($id)
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
            if ($user->hasRole('Customer')) {
                $status = 1;
                $notification = true;
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
            if ($status) {
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
            $order->store->user->notification($message, $title, $image, ['order_id' => $order_id]);
            $order->user->notification($message, $title, $image, ['order_id' => $order_id]);
        }

        OrderUser::updateOrCreate(['user_id' => auth('sanctum')->id(), 'order_id' => $order->id]);
        return response()->json(['status' => true, 'data' => $order]);
    }

    public function update_qr_code()
    {
        if (!auth('sanctum')->user()->hasRole('Delivery')) {
            return response()->json(['status' => false, 'message' => "you don't have permissions for this action"]);
        }

        $validator = Validator::make(request()->all(), [
            'qr_code' => 'required'
        ]);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);

        $explode = explode(":", request('qr_code'));

        if (!empty($explode[0]))
            $order = Order::where('order_number', $explode[0])->first();

        if (!empty($explode[1]))
            $user = User::findOrFail($explode[1]);

        if ($user->hasRole('Merchant')) {
            $status = 3;
        } elseif ($user->hasRole('Customer')) {
            $status = 4;
        }else {
            return response()->json(['status' => false, 'message' => "Error In QR code"]);
        }

        $order->status = $status;
        $order->save();

        return response()->json(['status' => true, 'data' => $order]);
    }

    public function delete($id)
    {
        OrderUser::updateOrCreate(['user_id' => auth('sanctum')->id(), 'order_id' => $id]);
        return response()->json(['status' => true, 'message' => "success", 'data' => null]);
    }

    public function order_accept($id)
    {
        if (auth('sanctum')->user()->hasRole('Delivery') and request('delivery') == 2) {
            $order = Order::where('id', $id)->update([
                'status' => request('status'),
            ]);
        } else {
            return response()->json(['status' => false, 'message' => "You do not have permission"]);
        }

        return response()->json(['status' => true, 'message' => "success", 'data' => null]);
    }

    public function statistics()
    {
        if (request('date_from') and request('date_to')) {

            $start_month =  Carbon::parse( request('date_from'))->format('m');
            $end_month =  Carbon::parse( request('date_to'))->format('m');

            $start_year =  Carbon::parse( request('date_from'))->format('Y');
            $end_year =  Carbon::parse( request('date_to'))->format('Y');

            $data = [];
            $data[] = [
                'year' => $start_year.'-'.$end_year,
                'month' => $start_month.'-'.$end_month,
                'total' =>Order::where('user_id', auth('sanctum')->id())
                    ->whereMonth('created_at','>=',$start_month)
                    ->whereMonth('created_at','<=',$end_month)
                    ->whereYear('created_at','>=', $start_year)
                    ->whereYear('created_at','<=', $end_year)
                    ->sum('total'),
                'orders' => Order::where('user_id', auth('sanctum')->id())->whereMonth('created_at','>=',$start_month)->whereMonth('created_at','<=',$end_month)/*->whereYear('created_at', $year)*/->get()
            ];


//            $start_month = Carbon::createFromFormat("m", request('date_from'))->month;
//            $end_month = Carbon::createFromFormat("Y-m", request('date_to'))->month;
//            $start_year = Carbon::createFromFormat("Y-m", request('date_from'))->year;
//            $end_year = Carbon::createFromFormat("Y-m", request('date_to'))->year;
//            $start = Carbon::createFromFormat("Y-m", request('date_from'));
//            $end = Carbon::createFromFormat("Y-m", request('date_to'))->addMonths(1);
        }else {

            $start_month = Carbon::now()->subMonths(12)->month;
            $end_month = Carbon::now()->subMonths(1)->month;
            $start_year = Carbon::now()->subMonths(12)->year;
            $end_year = Carbon::now()->year;
            $start = Carbon::now()->addMonths(1);
            $end = Carbon::now()->subMonths(12);
        }

//        if ($months_count = $start->diffInMonths($end) != 12) {
//            return response()->json([
//                "status" => false,
//                "message" => "Period not 12 months",
//            ]);
//        }
//        $orders = [];
//        for ($year = $start_year; $year <= $end_year; $year++) {
//            for ($month = 1; $month <= 12; $month++) {
//                if ($year == $start_year and $month >= $start_month and $year >= $start_year) {
//                    $orders[] = ['year' => $year, 'month' => $month, 'count' => (int)Order::where('user_id', auth('sanctum')->id())->whereMonth('created_at', $month)/*->whereYear('created_at', $year)*/->count()];
//                }
//
//                if ($year == $end_year and $month <= $end_month and $year <= $end_year) {
//                    $orders[] = ['year' => $year, 'month' => $month, 'count' => (int)Order::where('user_id', auth('sanctum')->id())->whereMonth('created_at', $month)/*->whereYear('created_at', $year)*/->count()];
//
//                }
//            }
//        }

        if (count( $data[0]['orders'] ) == 0) {
            return response()->json([
                "status" => false,
                "message" => "Order not exist",
            ]);
        }

        return response()->json(['status' => true, 'data' => $data]);

//        return response()->json(['status' => true, 'data' => ['total' => (float)Order::where('user_id', auth('sanctum')->id())->sum('total'), 'count' => (int)Order::where('user_id', auth('sanctum')->id())->count(), 'orders' => $orders]]);
    }

    public function statistics_delivery()
    {
        if (!auth()->user()->hasRole('Delivery')) {
            return response()->json([
                "status" => false,
                "message" => "You do not have permission",
            ]);
        }

        $data = [];

        $orders_accept = Order::where('delivery_id', auth('sanctum')->id())->where('status',2)->with('store', 'delivery')->get();
        $total_orders_accept = $orders_accept->sum('total');
        $total_district_price_accept = $orders_accept->sum('district_delivery_price');
        $count_orders_accept = $orders_accept->count();

        $data['orders_accept'] = [
            'total_orders' => $total_orders_accept,
            'total_district_price_accept' => $total_district_price_accept,
            'count' => $count_orders_accept ,
            'orders' => $orders_accept
        ];

        $orders_inDelivery = Order::where('delivery_id', auth('sanctum')->id())->where('status',3)->with('store', 'delivery')->get();
        $total_orders_inDelivery = $orders_inDelivery->sum('total');
        $total_district_price_inDelivery = $orders_inDelivery->sum('district_delivery_price');
        $count_orders_inDelivery = $orders_inDelivery->count();

        $data['orders_inDelivery'] = [
            'total_orders' => $total_orders_inDelivery,
            'total_district_price_inDelivery' => $total_district_price_inDelivery,
            'count' => $count_orders_inDelivery ,
            'orders' => $orders_inDelivery
        ];

        $orders_completed = Order::where('delivery_id', auth('sanctum')->id())->where('status',4)->with('store', 'delivery')->get();
        $total_orders_completed = $orders_completed->sum('total');
        $total_district_price_completed = $orders_completed->sum('district_delivery_price');
        $count_orders_completed = $orders_completed->count();
        $data['orders_completed'] = [
            'total_orders' => $total_orders_completed,
            'total_district_price_completed' => $total_district_price_completed,
            'count' => $count_orders_completed ,
            'orders' => $orders_completed
        ];

        return response()->json([
            'status' => true,
            'message' => 'success',
            "data" => $data
        ]);

//        $order = Order::where('delivery_id', auth('sanctum')->id())->with('store', 'delivery')->paginate(10);
//        return response()->json([
//            'status' => true,
//            'message' => 'success',
//            "data" => [
//                'order_all' => Order::where('delivery_id', auth('sanctum')->id())->sum('total'),
//                'order_paid' => Order::where('delivery_id', auth('sanctum')->id())->where('delivery_status', 0)->sum('total'),
//                'order_not_paid' => Order::where('delivery_id', auth('sanctum')->id())->where('delivery_status', 1)->sum('total'),
//                'order' => $order->items(),
//            ]
//        ]);
    }
}
