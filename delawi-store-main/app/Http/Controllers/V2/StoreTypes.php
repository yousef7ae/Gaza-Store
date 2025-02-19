<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\StoreType;

class StoreTypes extends Controller
{
    //
    public function index()
    {
        $store_categories = StoreType::query()->get();

        return response()->json([
            'status' => true,
            'message' => "success",
            'data' => $store_categories,
        ]);
    }
}
