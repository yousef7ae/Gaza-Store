<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $validator = Validator::make(request()->input(), [
            'category_id' => 'required|exists:categories,id',
        ]);

        // if (!$validator->passes()) {
        //     return response()->json([
        //         "status" => false,
        //         "message" => $validator->errors()->first()
        //     ]);
        // }

        $category_id = request('category_id');
        $products = Product::where('status', 1)->where('category_id', $category_id);

        $products = $products->where('status', 1);

//         if (auth('sanctum')->check()) {
//             if (auth('sanctum')->user()->hasRole('Merchant')) {
// //                $products = $products->where('status', 1);
//             } else {
//                 $products = $products->where('status', 1);
//             }
//         } else {
//             $products = $products->where('status', 1);
//         }

        // if (request('city_id')) {
        //     $products = $products->whereHas('store', function ($q) {
        //         return $q->where('city_id', request('city_id'));
        //     });
        // }

        // if (request('category_id')) {
        //     $products = $products->where('category_id', request('category_id'));
        // }

        // if (request('brand_id')) {
        //     $products = $products->where('brand_id', request('brand_id'));
        // }

        // if (request('most_wanted')) {
        //     $products = $products->where('most_wanted', 1);
        // }

        // if (request('new_product')) {
        //     $products = $products->where('new_product', 1);
        // }

        // if (request('price_from') and request('price_to')) {
        //     $products = $products->whereBetween('price', [request('price_from'), request('price_to')]);
        // }

        if (request('search')) {
            $products = $products->where(function ($q) {
                return $q->where('name', 'LIKE', '%%' . request('search') . '%%')
                    ->orWhere('description', 'LIKE', '%%' . request('search') . '%%');
            });
        }

        $products = $products->with('category')->get();

        //        $advertisement = Ad::whereHas('store', function ($q) {
        //            return $q->where('city_id', request('city_id'));
        //        })->inRandomOrder()->first();

        return response()->json(['status' => true, 'message' => "Success", 'data' => $products], Response::HTTP_OK);
    }

    public function show($product_id)
    {
        $product = Product::where('id', $product_id)->where('status',1)->with('images', 'category')->first();
        if (!$product) {
            return response()->json(['status' => false, 'message' => "Product not exist", 'data' => []]);
        }

        // $product->similar_products = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->limit(5)->get();

        return response()->json(['status' => true, 'message' => "Success", 'data' => $product]);
    }

    // public function change_status($product_id)
    // {
    //     $product = Product::where('id', $product_id)->with('images', 'store', 'category', 'brand', 'ProductDetails')->first();
    //     if (!$product) {
    //         return response()->json(['status' => false, 'message' => "Product not exist", 'data' => []]);
    //     }

    //     if (!in_array($product->store_id, auth('sanctum')->user()->stores()->pluck('id')->toArray())) {
    //         return response()->json(['status' => false, 'message' => "Error Permission", 'data' => []]);
    //     }

    //     $product->status = request('status') ? 1 : 0;
    //     $product->save();

    //     return response()->json(['status' => true, 'message' => "Success", 'data' => $product]);
    // }
}
