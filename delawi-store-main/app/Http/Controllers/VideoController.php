<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Support\Facades\Validator;

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
