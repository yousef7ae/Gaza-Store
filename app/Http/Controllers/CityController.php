<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;

class CityController extends Controller
{
    public function index($country_id)
    {
        $countries = City::where('status', '1')->where('country_id', $country_id)->with('country', 'state')->get();
        return response()->json(['status' => true, 'message' => "success", 'data' => $countries]);
    }
}
