<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Nnjeim\World\Models\City;

class CityController extends Controller
{
    public function index($country_id)
    {
        $countries = City::where('status', '1')->where('country_id', $country_id)->with('country', 'state')->get();
        return response()->json(['status' => true, 'message' => "success", 'data' => $countries]);
    }
}
