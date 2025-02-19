<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::whereHas('participants', function ($q) {
            return $q->where('participants.user_id', auth('sanctum')->id());
        })->with('participants', 'message')->paginate(10);

        return response()->json(['status' => true, 'message' => "success", 'data' => $chats->items()], 200);

    }

    public function chat()
    {
        $validator = Validator::make(request()->all(), [
            'user_id' => 'required|exists:' . User::class . ',id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->messages()->first(), 'data' => null], 402);
        }

        $chat = Chat::whereHas('participants', function ($q) {
            return $q->where('participants.user_id', auth('sanctum')->id());
        })->whereHas('participants', function ($q) {
            return $q->where('participants.user_id', request('user_id'));
        })->with('participants')->first();

        if (!$chat) {

            $user = User::find(request('user_id'));
            $store = $user->stores->first();
            if (!$store) {
                return response()->json(['status' => false, 'message' => "Store not exist", 'data' => null], 402);
            }

            $chat = Chat::create([
                'title' => "(" . $store->name . ") " . $user->name . " - " . auth('sanctum')->user()->name,
                'user_id' => auth('sanctum')->id(),
                'status' => 1,
            ]);


            Participant::create(['chat_id' => $chat->id, 'user_id' => auth('sanctum')->id()]);
            Participant::create(['chat_id' => $chat->id, 'user_id' => request('user_id')]);
            $chat->messages()->create(['message' => 'Hello', 'user_id' => auth('sanctum')->id()]);
        }

        return response()->json(['status' => true, 'message' => "success", 'data' => $chat], 200);

    }

    public function messages()
    {
        $validator = Validator::make(request()->all(), [
            'user_id' => 'required|exists:' . Chat::class . ',id',
        ]);

        $chat = Chat::whereHas('participants', function ($q) {
            return $q->where('participants.user_id', auth('sanctum')->id());
        })->with('participants')->where('id', request('chat_id'))->first();

        if (!$chat) {
            return response()->json(['status' => false, 'message' => "Chat not exist or deleted", 'data' => $chat], 402);
        }

        $messages = $chat->messages()->with('user')->orderBy('id', 'DESC')->paginate(10);

        return response()->json(['status' => true, 'message' => "success", 'data' => $messages->items()], 200);

    }

    public function message()
    {
        $validator = Validator::make(request()->all(), [
            'chat_id' => 'required|exists:' . Chat::class . ',id',
        ]);

        $chat = Chat::whereHas('participants', function ($q) {
            return $q->where('participants.user_id', auth('sanctum')->id());
        })->with('participants')->where('id', request('chat_id'))->first();

        if (!$chat) {
            return response()->json(['status' => false, 'message' => "Chat not exist or deleted", 'data' => $chat], 402);
        }

        $message = $chat->messages()->create(['message' => request('message'), 'user_id' => auth('sanctum')->id()]);
        $message->user;

        return response()->json(['status' => true, 'message' => "success", 'data' => $message], 200);

    }

}
