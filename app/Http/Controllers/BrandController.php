<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Site\Product;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::where('status', 1)->get();
        return response()->json(['status' => true, 'data' => $brands]);
    }
}
