<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\Point;

class PointController extends Controller
{
    public function index()
    {
        $points = Point::get();
        return response()->json(['status' => true, 'message' => 'success', 'data' => $points]);
    }

    public function show($id)
    {
        $point = Point::where('id', $id)->first();
        return response()->json(['status' => true, 'data' => $point]);
    }
}
