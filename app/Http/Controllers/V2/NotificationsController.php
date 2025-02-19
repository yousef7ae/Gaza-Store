<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Carbon\Carbon;

class NotificationsController extends Controller
{

    public function index()
    {

        $notifications = Notification::where('user_id', auth('sanctum')->id())->with('user');

        $notifications = $notifications->orderBy('id','DESC')->paginate(10);

        Notification::where('user_id', auth('sanctum')->id())->whereNull('read_at')->update(['read_at' => Carbon::now()]);

        return response()->json(['status' => true, 'message' => "success", 'data' => $notifications->items()]);
    }

    public function send_notification()
    {
        $notifications = Notification::where('user_id', auth('sanctum')->id())->whereNull('read_at')->update(['read_at' => Carbon::now()]);

        return response()->json(['status' => true, 'message' => "success", 'data' => $notifications]);

    }


}
