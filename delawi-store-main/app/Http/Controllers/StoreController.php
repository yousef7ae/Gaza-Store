<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\StoreJoin;
use App\Models\StoreTimeWork;
use App\Models\Store;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::query();

        if (request('city_id')) {
            $stores = $stores->where('city_id', request('city_id'));
        }

        if (request('country_id')) {
            $stores = $stores->where('country_id', request('country_id'));
        }

        if (request('need_delivery')) {
            $stores = $stores->where('need_delivery', request('need_delivery'));
        }

        if (request('delivery_stores')) {
            $stores = $stores->whereIn('id', StoreJoin::where('user_id', auth('sanctum')->id())->pluck('store_id')->toArray());
        }

        $stores = $stores->where('status',1)->get();

        return response()->json(['status' => true, 'data' => $stores]);
    }

    public function show($store_id)
    {
        $store = Store::where('id', $store_id)->withCount('products')->with('store_time_works','sliders','categories')
            ->with('city')->where('status',1)->with('products')->first();

        if (!$store) {
            return response()->json(['status' => false, 'message' => "Store not exist", 'data' => []]);
        }

        $store->advertisements = Ad::get();
        $store->most_wanted = request('category_id') ? $store->products()->where('status', 1)->where('most_wanted', 1)->where('category_id', request('category_id'))->get() : $store->products()->where('status', 1)->where('most_wanted', 1)->get();
        $store->new_products = request('category_id') ? $store->products()->where('status', 1)->where('new_product', 1)->where('category_id', request('category_id'))->get() : $store->products()->where('status', 1)->where('new_product', 1)->get();
        $store->latest_offers = request('category_id') ? $store->products()->where('status', 1)->where('most_wanted', 1)->where('category_id', request('category_id'))->get() : $store->products()->where('status', 1)->where('most_wanted', 1)->get();

        return response()->json(['status' => true, 'message' => "Success", 'data' => $store]);
    }

    public function store_times()
    {

        $validator = Validator::make(request()->input(), [
            'store_id' => 'required|exists:stores,id',
            'days' => 'required|array',
            'days.*' => 'required|array',
            'days.*.status' => 'boolean',
            'days.*.from' => 'required|date_format:H:i:s',
            'days.*.to' => 'required|date_format:H:i:s',
        ]);

        if (!$validator->passes()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()]);
        }

        $store = Store::where('id', request('store_id'))->firstOrFail();

        if ($store->user_id != auth('sanctum')->id()) {
            return response()->json(["status" => false, "message" => 'Error permission']);
        }

        $daysArray = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

        $days = (array)request('days');

        foreach ($daysArray as $day) {
            StoreTimeWork::updateOrCreate(
                ['day' => $day, "store_id" => $store->id],
                [
                    'status' => (!empty($days[$day]) and !empty($days[$day]['status']) and $days[$day]['status']) ? 1 : 0,
                    'from' => (!empty($days[$day]) and !empty($days[$day]['from'])) ? $days[$day]['from'] : "00:00:00",
                    'to' => (!empty($days[$day]) and !empty($days[$day]['to'])) ? $days[$day]['to'] : "00:00:00"
                ]);
        }

        return response()->json(['status' => true, 'message' => 'success', 'data' => $store->store_time_works()->select('day', 'from', 'to', 'status')->get()]);
    }

    public function join($store_id)
    {

        $store = Store::where('id', $store_id)->first();

        if (!$store) {
            return response()->json(["status" => false, "message" => 'Store note exist']);
        }

        $store_join = StoreJoin::where(['store_id' => $store->id, 'user_id' => auth('sanctum')->id()])->first();

        if ($store_join) {
            return response()->json(["status" => false, "message" => 'Application exist']);
        }

        $store_join = StoreJoin::updateOrCreate(['store_id' => $store->id, 'user_id' => auth('sanctum')->id()]);

        return response()->json(['status' => true, 'message' => 'success', 'data' => $store_join]);
    }

    public function need_delivery($store_id)
    {

        $store = Store::where('id', $store_id)->first();

        if (!$store) {
            return response()->json(["status" => false, "message" => 'Store note exist']);
        }

        if ($store->user_id != auth('sanctum')->id()) {
            return response()->json(["status" => false, "message" => 'you dont have permissions']);
        }

        $store->need_delivery = request('need_delivery');
        $store->save();

        return response()->json(['status' => true, 'message' => 'success', 'data' => $store]);
    }

}
