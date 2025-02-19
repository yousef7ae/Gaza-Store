<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentGateway;
use App\Models\Voucher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PaymentGatewayController extends Controller
{

    public function index()
    {
        $payment_gateway = PaymentGateway::select('id', 'name', 'description', 'image')->get();

        if (!$payment_gateway) {
            return response()->json(['status' => false, 'message' => "Coupon not exist", 'data' => $payment_gateway]);
        }

        return response()->json(['status' => true, 'message' => "success", 'data' => $payment_gateway]);
    }

}
