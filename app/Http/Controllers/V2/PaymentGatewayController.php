<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;

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
