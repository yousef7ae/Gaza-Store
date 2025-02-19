<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::get();
        return response()->json(['status' => true, 'message' => 'success', 'data' => $videos]);
    }

    public function show($id)
    {
        $video = Video::where('id', $id)->first();
        return response()->json(['status' => true, 'data' => $video]);
    }
}
