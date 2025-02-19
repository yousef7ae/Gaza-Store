<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\StoreRate;

class StoreRateController extends Controller
{
    public function index()
    {
        $store = Store::find(request('store_id'));

        if (!$store) {
            return response()->json(['status' => false, 'message' => "Store not exist", 'data' => []]);
        }

        $store_rates = StoreRate::where('store_id', $store->id)->with('store', 'user')->get();

        return response()->json(['status' => true, 'message' => "Success", 'data' => $store_rates]);

    }

    public function create()
    {
        $store = Store::find(request('store_id'));

        if (!$store) {
            return response()->json(['status' => false, 'message' => "Store not exist", 'data' => []]);
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

        StoreRate::create([
            'store_id' => $store->id,
            'comment' => request('comment'),
            'rate' => request('rate'),
            'user_id' => auth('sanctum')->id(),
            'device_id' => request()->header('device_id'),
        ]);


        if (auth('sanctum')->check()) {
            $store_rates = StoreRate::where('user_id', auth('sanctum')->id())->with('store', 'user')->get();
        } else {
            $store_rates = StoreRate::where('device_id', request()->header('device_id'))->with('store', 'user')->get();
        }


        return response()->json(['status' => true, 'data' => $store_rates]);
    }

}
