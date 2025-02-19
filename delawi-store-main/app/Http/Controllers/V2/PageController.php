<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Setting;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::get();

        return response()->json(['status' => true, 'data' => $pages]);
    }

    public function show($page_id)
    {
        $page = Page::where('id', $page_id)->orWhere('slug', $page_id)->first();
        if (!$page) {
            return response()->json(['status' => false, 'message' => "Page not exist", 'data' => null]);
        }

        if ($page->slug == "About Us") {
            $page->settings = Setting::pluck('value', 'name');
        }

        return response()->json(['status' => true, 'message' => "Success", 'data' => $page]);
    }
}
