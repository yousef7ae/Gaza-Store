<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Nnjeim\World\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::where('status', 1)->with('timezones', 'currency')->get();
        return response()->json(['status' => true, 'message' => "success", 'data' => $countries]);
    }
}
