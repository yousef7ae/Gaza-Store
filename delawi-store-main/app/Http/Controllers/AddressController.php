<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function index()
    {
        $address = Address::where('user_id', auth('sanctum')->id())->get();
        return response()->json(['status' => true, 'message' => 'success', 'data' => $address]);
    }

    public function store()
    {

        $validator = Validator::make(request()->input(), [
            'name' => 'required',
            'location' => 'required',
            'email' => 'nullable|email',
            'mobile' => 'nullable',
            'country' => 'nullable',
            'city' => 'nullable',
            'zip_code' => 'nullable',
            'note' => 'nullable',
        ]);

        if (!$validator->passes()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()]);
        }


        $address = Address::create([
            'name' => request('name'),
            'email' => request('email') ? request('email') : auth('sanctum')->user()->email,
            'mobile' => request('mobile') ? request('mobile') : auth('sanctum')->user()->mobile,
            'country' => request('country') ? request('country') : auth('sanctum')->user()->country_id,
            'city' => request('city') ? request('city') : auth('sanctum')->user()->city_id,
            'location' => request('location'),
            'zip_code' => request('zip_code'),
            'note' => request('note'),
            'user_id' => auth('sanctum')->id(),
        ]);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $address]);
    }

    public function show($id)
    {
        $address = Address::where('user_id', auth('sanctum')->id())->where('id', $id)->first();
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
            'location' => 'required',
            'email' => 'nullable|email',
            'mobile' => 'nullable',
            'country' => 'nullable',
            'city' => 'nullable',
            'zip_code' => 'nullable',
            'note' => 'nullable',
        ]);


        if (!$validator->passes()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()]);
        }

        $address = Address::where('user_id', auth('sanctum')->id())->where('id', $id)->update([
            'name' => request('name'),
            'email' => request('email') ? request('email') : auth('sanctum')->user()->email,
            'mobile' => request('mobile') ? request('mobile') : auth('sanctum')->user()->mobile,
            'country' => request('country') ? request('country') : auth('sanctum')->user()->country_id,
            'city' => request('city') ? request('city') : auth('sanctum')->user()->city_id,
            'location' => request('location'),
            'zip_code' => request('zip_code'),
            'note' => request('note'),
        ]);

        $address = Address::where('user_id', auth('sanctum')->id())->where('id', $id)->first();

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
