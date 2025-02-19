<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Store;
use App\Models\User;
use Kutia\Larafirebase\Facades\Larafirebase;
use Nnjeim\World\Actions\SeedAction;
use Notification;
use Request;

class HomeController extends Controller
{
    public function index()
    {
        Product::doesntHave('store')->delete();
        Favorite::doesntHave('product')->delete();
        Cart::doesntHave('product')->delete();

        $sliders = Slider::with('store', 'product')->where(function($slider){
            return $slider->whereNull('store_id');
//                ->orWhereHas('store',function ($store){
//                return $store->where('status',1)->where('city_id', request('city_id'));
//            });
        })->limit(5)->get();

        $stores = Store::query();
        if (request('city_id')) {
            $stores = $stores->where('city_id', request('city_id'));
        }

        $stores = $stores->where('status',1)->get();
        $most_wanted = Product::whereIn('store_id', $stores->pluck('id')->toArray())->where('most_wanted', 1)->with('store')->limit(5)->get();
        $new_products = Product::whereIn('store_id', $stores->pluck('id')->toArray())->where('new_product', 1)->with('store')->limit(5)->get();
        $brands = Brand::whereHas('brands_stores',function ($q) use ($stores){
            return $q->whereIn('store_id',$stores->pluck('id')->toArray());
        })->where('status',1)->get();

        $categories = Category::whereHas('categories_stores',function ($q) use ($stores){
            return $q->whereIn('store_id',$stores->pluck('id')->toArray());
        })->get();

        $advertisement = Ad::where(function($slider){
            return $slider->whereNull('store_id')
                ->orWhereHas('store',function ($store){
                if(request('city_id')) {
                    return $store->where('status',1)->where('city_id', request('city_id'));
                }
            });
        })
            //->where('date','>=',Carbon::now())
        ->inRandomOrder()->first();

        $advertisement2 = Ad::where(function($slider){
            return $slider->whereNull('store_id')->orWhereHas('store',function ($store){
                if(request('city_id')) {
                    return $store->where('status',1)->where('city_id', request('city_id'));
                }
            });
        })
            //->where('date','>=',Carbon::now())
        ->inRandomOrder()->first();

        $carts_count = Cart::where('user_id', auth('sanctum')->id())->count();
        $deliveries = User::whereHas('roles', function($q) {
            return $q->where('name', 'delivery');
        })->limit(5)->get();

        return response()->json([
            'status' => true,
            'message' => "success",
            'data' => [
                'carts_count' => $carts_count,
                'sliders' => $sliders,
                'stores' => $stores,
                'most_wanted' => $most_wanted,
                'new_products' => $new_products,
                'brands' => $brands,
                'categories' => $categories,
                'deliveries' => $deliveries,
                'advertisement' => $advertisement,
                'advertisement2' => $advertisement2,
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

//        $user=User::where('id',118)->first();
//        $deliveries = User::where('fcm_token',$user->fcm_token)->get();

//        User::where('id','>',0)->update(['fcm_token' => null]);
        $deliveries = User::whereNotNull('fcm_token')->get();
        foreach ($deliveries as $delivery){

            $title = __("New order");
            $message = __('New order from')  ;
            $image = "https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg";
            $order_id = 1;

            dump($delivery->fcm_token);
            dump($delivery->notification($message,$title,$image,['order_id'=>$order_id]));
        }

    }

}
