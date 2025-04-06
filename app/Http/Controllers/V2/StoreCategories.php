<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\StoreCategory;
use Illuminate\Http\Request;

class StoreCategories extends Controller
{
    public function index($id)
    {
        $store_categories = StoreCategory::where('status', 1)->where('store_type_id', $id)->get();

        return response()->json([
            'status' => true,
            'message' => "success",
            'data' => $store_categories,
        ]);
    }
}