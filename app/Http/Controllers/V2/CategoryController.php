<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        // $validator = Validator::make(request()->input(), [
        //     'store_id' => 'required|exists:stores,id',
        // ]);

        // if (!$validator->passes()) {
        //     return response()->json([
        //         "status" => false, "message" => $validator->errors()->first()
        //     ]);
        // }

        // $store_id = request('store_id');
        // $stores = Store::where('status', 1)->where('id', $store_id);

        // if (request('city_id')) {
        //     $stores = $stores->where('city_id', request('city_id'));
        // }
        // $stores = $stores->get();

        $categories = Category::where('status', 1)->get();

        if(!$categories->count()) {
            return response()->json(['status' => false, 'message' => 'No categories found']);
        }
        // whereHas('categories_stores', function ($q) use ($stores) {
        //     return $q->whereIn('store_id', $stores->pluck('id')->toArray());
        // });

//        if (request('store_id')) {
//            $categories = $categories->where('store_id', $store_id);
//        }

        return response()->json(['status' => true, 'data' => $categories]);
    }

    
}
