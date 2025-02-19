<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Carbon\Carbon;

class NotificationsController extends Controller
{

    public function index()
    {

        $notifications = Notification::where('user_id', auth('sanctum')->id());

        $notifications = $notifications->orderBy('id','DESC')->paginate(10);

        Notification::where('user_id', auth('sanctum')->id())->whereNull('read_at')->update(['read_at' => Carbon::now()]);

        return response()->json(['status' => true, 'message' => "success", 'data' => $notifications->items()]);
    }

}
