<?php

namespace App\Http\Controllers;

use Nnjeim\World\Models\Country;
use Nnjeim\World\World;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::where('status', 1)->with('timezones', 'currency')->get();
        return response()->json(['status' => true, 'message' => "success", 'data' => $countries]);
    }
}
