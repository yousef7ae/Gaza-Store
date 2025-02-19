<?php

namespace App\Http\Controllers;

use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {

        $pages = Faq::get();

        return response()->json(['status' => true, 'data' => $pages]);
    }

    public function show($page_id)
    {

        $page = Faq::where('id', $page_id)->first();
        if (!$page) {
            return response()->json(['status' => false, 'message' => "Page not exist", 'data' => []]);
        }

        return response()->json(['status' => true, 'message' => "Success", 'data' => $page]);
    }


}
