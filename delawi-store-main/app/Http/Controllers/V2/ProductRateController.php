<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductRate;

class ProductRateController extends Controller
{
    public function index()
    {
        $product = Product::find(request('product_id'));

        if (!$product) {
            return response()->json(['status' => false, 'message' => "Product not exist", 'data' => []]);
        }

        $product_rates = ProductRate::where('product_id', $product->id)->with('product', 'user')->withOut('product.product_rates')->get();

        return response()->json(['status' => true, 'message' => "Success", 'data' => $product_rates]);

    }

    public function create()
    {

        $product = Product::find(request('product_id'));

        if (!$product) {
            return response()->json(['status' => false, 'message' => "Product not exist", 'data' => []]);
        }

        if (request('rate') < 1) {
            return response()->json(['status' => false, 'message' => "Error rate lower than 1 ", 'data' => []]);
        }

        if (request('rate') > 5) {
            return response()->json(['status' => false, 'message' => "Error rate upper than 5 ", 'data' => []]);
        }

        if (!request('comment')) {
            return response()->json(['status' => false, 'message' => "Empty comment ", 'data' => []]);
        }

        $check = ProductRate::where('product_id', $product->id)->where('user_id', auth('sanctum')->id())->first();
        if ($check) {
            return response()->json(['status' => false, 'message' => "Rate exist ", 'data' => []]);
        }

        ProductRate::create([
            'product_id' => $product->id,
            'comment' => request('comment'),
            'rate' => request('rate'),
            'user_id' => auth('sanctum')->id(),
            'device_id' => request()->header('device_id'),
        ]);

        $product_rates = ProductRate::where('product_id', $product->id)->with('product', 'user')->withOut('product.product_rates')->get();

        return response()->json(['status' => true, 'message' => "Success", 'data' => $product_rates]);
    }

}
