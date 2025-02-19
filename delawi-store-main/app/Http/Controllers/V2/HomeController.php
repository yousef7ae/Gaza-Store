<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Notification;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $validator = Validator::make(request()->input(), [
            'store_id' => 'required|exists:stores,id',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                "status" => false, "message" => $validator->errors()->first()
            ]);
        }

        Product::doesntHave('store')->delete();
        Favorite::doesntHave('product')->delete();
        Cart::doesntHave('product')->delete();

        $store_id = request('store_id');

        $stores = Store::where('status', 1)->where('id', $store_id);
        if (request('city_id')) {
            $stores = $stores->where('city_id', request('city_id'));
        }
        $stores = $stores->get();

        $sliders = Slider::where('status', 1)->where('store_id', $store_id)->take(5)->get();

        $advertisement = Ad::where('status', 1)->where('store_id', $store_id)->inRandomOrder()->first();
        $advertisement2 = Ad::where('status', 1)->where('store_id', $store_id)->inRandomOrder()->first();

        $categories = Category::whereHas('categories_stores', function ($q) use ($stores) {
            return $q->whereIn('store_id', $stores->pluck('id')->toArray());
        });

        $categories = $categories->where('status', 1)->get();

        $products = Product::with('store')->where('status', 1)
            ->whereHas('category', function ($q) {
                $q->where('status', 1);
            })
            ->where('store_id', $store_id)->get();

        $carts_count = Cart::where('user_id', auth('sanctum')->id())->count();

        $notifications_count = Notification::where('user_id', auth('sanctum')->id())->whereNull('read_at')->count();

//        $sliders = Slider::with('store', 'product')->where(function ($slider) {
//            return $slider->whereNull('store_id')->orWhereHas('store', function ($store) {
//                return $store->where('city_id', request('city_id'));
//            });
//        })->limit(5)->get();

//        $most_wanted = Product::whereIn('store_id', $stores->pluck('id')->toArray())->where('most_wanted', 1)->with('store')->limit(5)->get();
//        $new_products = Product::whereIn('store_id', $stores->pluck('id')->toArray())->where('new_product', 1)->with('store')->limit(5)->get();

//        $brands = Brand::whereHas('brands_stores', function ($q) use ($stores){
//            return $q->whereIn('store_id',$stores->pluck('id')->toArray());
//        })->where('status',1)->get();

//        $store_types = StoreType::query()->get();

//        $advertisement = Ad::where(function ($slider) {
//            return $slider->whereNull('store_id')->orWhereHas('store', function ($store) {
//                if (request('city_id')) {
//                    return $store->where('city_id', request('city_id'));
//                }
//            });
//        })->inRandomOrder()->first();
//
//        $advertisement2 = Ad::where(function ($slider) {
//            return $slider->whereNull('store_id')->orWhereHas('store', function ($store) {
//                if (request('city_id')) {
//                    return $store->where('city_id', request('city_id'));
//                }
//            });
//        })->inRandomOrder()->first();

//        $deliveries = User::whereHas('roles', function ($q) {
//            return $q->where('name', 'delivery');
//        })->limit(5)->get();

        return response()->json([
            'status' => true,
            'message' => "success",
            'data' => [
                'carts_count' => $carts_count,
                'notifications_count' => $notifications_count,
                'name' => auth('sanctum')->user()->name ?? '',
                'sliders' => $sliders, // Store sliders
                'categories' => $categories, // store categories
                'products' => $products,
                'advertisement' => $advertisement,
                'advertisement2' => $advertisement2,
//                'most_wanted' => $most_wanted,
//                'new_products' => $new_products,
//                'brands' => $brands,
//                'store_types' => $store_types,
//                'deliveries' => $deliveries,
            ]
        ]);
    }

    public function carts_count()
    {
        $carts_count = Cart::where('user_id', auth('sanctum')->id())->count();
        return response()->json([
            'status' => true,
            'message' => "success",
            'data' => [
                'carts_count' => $carts_count,
            ]
        ]);
    }

    public function updateToken()
    {
        auth('sanctum')->user()->update(['fcm_token' => request('token')]);
        return auth('sanctum')->user();
    }

    public function notification()
    {

//        User::where('id','>',0)->update(['fcm_token' => null]);
        $deliveries = User::whereNotNull('fcm_token')->get();
        foreach ($deliveries as $delivery) {

            $title = __("New order");
            $message = __('New order from');
            $image = "https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg";
            $order_id = 1;

            dump($delivery->fcm_token);
            dump($delivery->notification($message, $title, $image, $order_id));
        }

    }

}
