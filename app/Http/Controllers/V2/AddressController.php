<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function index()
    {
        $address = Address::where('user_id', auth('sanctum')->id())->with('country', 'city')->get();
        return response()->json(['status' => true, 'message' => 'success', 'data' => $address]);
    }

    public function store()
    {
        $validator = Validator::make(request()->input(), [
            'name' => 'required',
            'mobile' => 'required',
            //            'email' => 'nullable|email',
            'location' => 'nullable',
            'country_id' => 'nullable',
            'city_id' => 'nullable',
            'zip_code' => 'nullable',
            'note' => 'nullable',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()]);
        }

        $address = Address::create([
            'name' => request('name'),
            //            'email' => request('email') ? request('email') : auth('sanctum')->user()->email,
            'mobile' => request('mobile') ? request('mobile') : auth('sanctum')->user()->mobile,
            'country_id' => request('country_id') ? request('country_id') : auth('sanctum')->user()->country_id,
            'city_id' => request('city_id') ? request('city_id') : auth('sanctum')->user()->city_id,
            'location' => request('location'),
            'zip_code' => request('zip_code'),
            'note' => request('note'),
            'user_id' => auth('sanctum')->id(),
            'lat' => request('lat'),
            'lng' => request('lng'),
        ]);

        return response()->json(['status' => true, 'message' => 'success', 'data' => $address]);
    }

    public function show($id)
    {
        $address = Address::where('user_id', auth('sanctum')->id())->with('country', 'city')->where('id', $id)->first();
        return response()->json(['status' => true, 'data' => $address]);
    }

    public function update($id)
    {
        $address = Address::where('user_id', auth('sanctum')->id())->where('id', $id)->first();
        if (!$address) {
            return response()->json([
                "status" => false,
                "message" => "Address not exist",
                'data' => null
            ]);
        }

        $validator = Validator::make(request()->input(), [
            'name' => 'required',
            'location' => 'nullable',
            //            'email' => 'nullable|email',
            'mobile' => 'nullable',
            'country_id' => 'nullable',
            'city_id' => 'nullable',
            'zip_code' => 'nullable',
            'note' => 'nullable',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()]);
        }

        $address->update([
            'name' => request('name'),
            //            'email' => request('email') ? request('email') : auth('sanctum')->user()->email,
            'mobile' => request('mobile') ? request('mobile') : auth('sanctum')->user()->mobile,
            'country_id' => request('country_id') ? request('country_id') : auth('sanctum')->user()->country_id,
            'city_id' => request('city_id') ? request('city_id') : auth('sanctum')->user()->city_id,
            'location' => request('location'),
            'zip_code' => request('zip_code'),
            'note' => request('note'),
            'lat' => request('lat'),
            'lng' => request('lng'),
        ]);

        $address = Address::where('user_id', auth('sanctum')->id())->where('id', $id)->with('country', 'city')->first();

        return response()->json(['status' => true, 'message' => 'success', 'data' => $address]);
    }


    public function updateCoordinates($id)
    {
        $address = Address::where('user_id', auth('sanctum')->id())->where('id', $id)->first();
        if (!$address) {
            return response()->json([
                "status" => false,
                "message" => "Address not exist",
                'data' => null
            ]);
        }

        $validator = Validator::make(request()->input(), [
            'lat' => 'nullable',
            'lng' => 'nullable',
        ]);

        if (!$validator->passes()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()]);
        }

        $address->update([
            'lat' => request('lat'),
            'lng' => request('lng'),
        ]);

        $address = Address::where('user_id', auth('sanctum')->id())->where('id', $id)->with('country', 'city')->first();

        return response()->json(['status' => true, 'message' => 'success', 'data' => $address]);
    }

    public function delete($id)
    {
        $address = Address::where('user_id', auth('sanctum')->id())->where('id', $id)->first();

        if (!$address) {
            return response()->json(['status' => false, 'message' => "Address not exist"]);
        }

        $address->delete();

        return response()->json(['status' => true, 'message' => "success"]);
    }
}
