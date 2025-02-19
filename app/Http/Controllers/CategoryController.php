<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Store;

class CategoryController extends Controller
{
    public function index()
    {
        $stores = Store::query();
        if (request('city_id')) {
            $stores = $stores->where('city_id', request('city_id'));
        }
        $stores = $stores->get();

        $categories = Category::where('status', 1)->whereHas('categories_stores',function ($q) use ($stores){
            return $q->whereIn('store_id',$stores->pluck('id')->toArray());
        });

        if (request('store_id')) {
            $categories = $categories->where('store_id', request('store_id'));
        }
        $categories = $categories->get();

        return response()->json(['status' => true, 'data' => $categories]);
    }
}
