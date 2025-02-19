<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::where('status', 1)->get();
        return response()->json(['status' => true, 'data' => $brands]);
    }
}
