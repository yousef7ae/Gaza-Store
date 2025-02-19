<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Favorite;

class FavoritesController extends Controller
{
    public function index()
    {
        $device_id = request()->header('device_id') ? request()->header('device_id') : request('device_id');
        if (auth('sanctum')->id()) {
            Favorite::where('device_id', $device_id)->update(['device_id' => null, 'user_id' => auth('sanctum')->id()]);
        }
        if (auth('sanctum')->check()) {
            $favorites = Favorite::where('user_id', auth('sanctum')->id())->with('product', 'product.store', 'user')->get();
        } else {
            $favorites = Favorite::where('device_id', $device_id)->with('product', 'product.store', 'user')->get();
        }

        return response()->json(['status' => true, 'message' => "Success", 'data' => $favorites]);
    }

    public function create()
    {
        $device_id = request()->header('device_id') ? request()->header('device_id') : request('device_id');
        $product = Product::find(request('product_id'));

        if ($product) {
            if (auth('sanctum')->check()) {
                $old = Favorite::where('user_id', auth('sanctum')->id())->where('product_id', $product->id)->first();
            } else {
                $old = Favorite::where('device_id', $device_id)->where('product_id', $product->id)->first();
            }
            if (!$old) {
                Favorite::create([
                    'product_id' => $product->id,
                    'user_id' => auth('sanctum')->id(),
                    'device_id' => auth('sanctum')->id() ? null : $device_id,
                ]);
            }
        }

        if (auth('sanctum')->check()) {
            $favorites = Favorite::where('user_id', auth('sanctum')->id())->with('product', 'product.store', 'user')->get();
        } else {
            $favorites = Favorite::where('device_id', $device_id)->with('product', 'product.store', 'user')->get();
        }

        return response()->json(['status' => true, 'message' => "Success", 'data' => $favorites]);
    }

    function remove()
    {
        $device_id = request()->header('device_id') ? request()->header('device_id') : request('device_id');

        $product = Product::find(request('product_id'));
        if (!$product) {
            return response()->json(['status' => false, 'message' => "Product not exist", 'data' => []]);
        }


        if (auth('sanctum')->check()) {
            $old = Favorite::where('user_id', auth('sanctum')->id())->where('product_id', $product->id)->first();
        } else {
            $old = Favorite::where('device_id', $device_id)->where('product_id', $product->id)->first();
        }

        if ($old) {
            Favorite::where('id', $old->id)->delete();
        }

        if (auth('sanctum')->check()) {
            $favorites = Favorite::where('user_id', auth('sanctum')->id())->with('product', 'product.store', 'user')->get();
        } else {
            $favorites = Favorite::where('device_id', $device_id)->with('product', 'product.store', 'user')->get();
        }

        return response()->json(['status' => true, 'message' => "Success", 'data' => $favorites]);

    }

}
