<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Notification;
use App\Models\RequestDelivery;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use App\Events\ResetCode;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query();

        if (request('store_id')) {
            $users = $users->where('store_id', request('store_id'));
        }

        if (request('delivery')) {
            $users = $users->role('Delivery');
        }

        if (request('search')) {
            $users = $users->where(function ($q) {
                return $q->where('name', 'LIKE', '%%' . request('search') . '%%')
                    ->orWhere('email', 'LIKE', '%%' . request('email') . '%%');
            });
        }

        $users = $users->get();

        return response()->json(['status' => true, 'data' => $users]);
    }

    public function login()
    {
        //        return request('device_id');
        $validator = Validator::make(request()->input(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()]);
        }

        $user = User::with('country', 'city', 'roles')->where('email', request('email'))->first();
        if (Hash::check(request('password'), $user->password)) {

            $device_id = request('device_id');
            if (isset($device_id)) {
                $carts = Cart::where('device_id', $device_id)->get();
                foreach ($carts as $cart) {
                    $cart->update([
                        'user_id' => $user->id,
                        'device_id' => null,
                    ]);
                }
                $favorits = Favorite::where('device_id', $device_id)->get();
                foreach ($favorits as $favorit) {
                    $favorit->update([
                        'user_id' => $user->id,
                        'device_id' => null,
                    ]);
                }
            }

            $user->api_token = $user->createToken("api-login")->plainTextToken;
            return response()->json([
                "status" => true,
                "message" => "success",
                'data' => $user
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => __("Invalid Login")
            ]);
        }
    }

    public function register()
    {
        $validator = Validator::make(request()->input(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        if (!$validator->passes()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()]);
        }

        $data = request()->input();
        $data['password'] = Hash::make(request('password'));
        $data['status'] = 1;
        $user = User::create($data);

        $device_id = request('device_id');
        if (isset($device_id)) {
            $carts = Cart::where('device_id', $device_id)->get();
            foreach ($carts as $cart) {
                $cart->update([
                    'user_id' => $user->id,
                    'device_id' => null,
                ]);
            }
            $favorits = Favorite::where('device_id', $device_id)->get();
            foreach ($favorits as $favorit) {
                $favorit->update([
                    'user_id' => $user->id,
                    'device_id' => null,
                ]);
            }
        }

        $user = User::with('country', 'city', 'roles')->where('id', $user->id)->first();
        $user->update([
            'api_token' => $user->createToken("api-login")->plainTextToken,
        ]);
        //        $user->api_token = $user->createToken("api-login")->plainTextToken;

        $user->syncRoles(2); //Customer

        return response()->json([
            "status" => true,
            "message" => "success",
            'data' => $user
        ]);
    }

    public function user()
    {
        $user = User::where('id', auth('sanctum')->id())->with('country', 'city', 'roles')->withCount('orders')->first();

        $user->store = $user->stores()->with('store_time_works')->first();

        if ($user->store) {
            $user->store->orders = $user->store->orders()->with('store', 'address', 'payment_gateway')->orderBy('id', 'DESC')->limit(10)->get();
        }

        $user->orders = $user->orders()->with('store', 'address', 'payment_gateway')->limit(10)->get();

        return response()->json([
            "status" => true,
            "message" => "success",
            'data' => $user
        ]);
    }

    public function forget()
    {

        $validator = Validator::make(request()->input(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if (!$validator->passes()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()]);
        }

        $user = User::where('email', request('email'))->first();
        $user->reset_code = rand(1000, 9999);
        //        rand(1000, 9999)
         $user->save();

        event(new ResetCode($user));

        // $to = $user->email;

        // $from = env("MAIL_FROM_ADDRESS");

        // $fromName = env('APP_NAME');

        // $subject = "forget password " . env('APP_NAME');

        // $message = "your code is: " . $user->reset_code;

        // $headers = 'From: ' . $fromName . '<' . $from . '>';

        // mail($to, $subject, $message, $headers);

        return response()->json([
            "status" => true,
            "message" => "success",
            'user' => $user
        ]);
    }

    public function forget_confirm()
    {
        $validator = Validator::make(request()->input(), [
            'email' => 'required|email|exists:users,email',
            'reset_code' => 'required|numeric',
        ]);

        if (!$validator->passes()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()]);
        }

        $user = User::where('email', request('email'))->first();

        if ($user->reset_code != request('reset_code')) {
            return response()->json(["status" => false, "message" => "error code"]);
        }

        $user->password = Hash::make(request('password'));
        $user->save();

        // $to = $user->email;

        // $from = env("MAIL_FROM_ADDRESS");

        // $fromName = env('APP_NAME');

        // $subject = "forget password " . env('APP_NAME');

        // $message = "your code is: " . $user->reset_code;

        // $headers = 'From: ' . $fromName . '<' . $from . '>';

        // mail($to, $subject, $message, $headers);

        return response()->json([
            "status" => true,
            "message" => "success",
            'user' => $user
        ]);
    }

    public function reset_password()
    {
        $input = request('email');
        $validator = Validator::make(request()->input(), [
            'email' => 'required|email|exists:users,email',
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $user = User::where('email', request('email'))->first();

        if(!Hash::check(request('old_password') , $user->password) )
        {
            return response(['error' => ' Old Password Incorrect']);

        }

        $user->password = Hash::make(request('new_password'));
        $message = "successfully";
        $user->save();

        $response = ['status' => true, 'message' => $message , 'user' => $user];
        return response($response, 200);
    }

    public function change_delivery_available()
    {
        $user = auth('sanctum')->user();

        if ($user->hasRole('Delivery')) {
            $user->update([
                'is_available' => request('is_available'),
            ]);

            return response()->json([
                "status" => true,
                "message" => "success",
                'data' => $user
            ]);
        }

        return response()->json([
            "status" => false,
            "message" => "User don't have delivery role",
            'data' => null
        ]);
    }

    public function profile()
    {
        $user = User::where('id', auth('sanctum')->id())->first();

        if (request('name')) {
            $user->name = request('name');
        }

        if (request('country_id')) {
            $user->country_id = request('country_id');
        }

        if (request('city_id')) {
            $user->city_id = request('city_id');
        }

        if (request('address')) {
            $user->address = request('address');
        }

        if (request('postal_code')) {
            $user->postal_code = request('postal_code');
        }

        if (request('license_number')) {
            $user->license_number = request('license_number');
        }

        if (request('license_picture')) {
            $validator = Validator::make(request()->input(), [
                'license_picture' => 'image'
            ]);

            if (!$validator->passes()) {
                return response()->json(["status" => false, "message" => $validator->errors()->first()]);
            }

            $user->license_picture = request('license_picture')->store('license/' . $user->id);
        }

        if (request('vehicle_picture')) {

            $validator = Validator::make(request()->input(), [
                'vehicle_picture' => 'image'
            ]);

            if (!$validator->passes()) {
                return response()->json(["status" => false, "message" => $validator->errors()->first()]);
            }

            $user->vehicle_picture = request('vehicle_picture')->store('vehicle/' . $user->id);
        }

        if (request('image')) {

            $validator = Validator::make(request()->input(), [
                'image' => 'image'
            ]);

            if (!$validator->passes()) {
                return response()->json(["status" => false, "message" => $validator->errors()->first()]);
            }

            $user->image = request('image')->store('image/' . $user->id);
        }

        if (request('username')) {
            $validator = Validator::make(request()->input(), [
                'username' => 'unique:users,username,' . $user->id
            ]);

            if (!$validator->passes()) {
                return response()->json(["status" => false, "message" => $validator->errors()->first()]);
            }

            $user->username = request('username');
        }

        if (request('email')) {
            $validator = Validator::make(request()->input(), [
                'email' => 'unique:users,email,' . $user->id
            ]);

            if (!$validator->passes()) {
                return response()->json(["status" => false, "message" => $validator->errors()->first()]);
            }

            $user->email = request('email');
        }

        if (request('fcm_token')) {
            $user->fcm_token = request('fcm_token');
        }

        if (request('mobile')) {
            $validator = Validator::make(request()->input(), [
                'mobile' => 'unique:users,mobile,' . $user->id
            ]);

            if (!$validator->passes()) {
                return response()->json(["status" => false, "message" => $validator->errors()->first()]);
            }

            $user->mobile = request('mobile');
        }

        // if (request('is_available')) {
        //     $user->is_available = request('is_available');
        // }

        $user->save();

        $user = User::with('country', 'city', 'roles')->where('id', auth('sanctum')->id())->first();

        if (request('delete')) {
            if (request('code') == 123456) {
                User::with('country', 'city', 'roles')->where('id', auth('sanctum')->id())->delete();
            }
        }

        return response()->json([
            "status" => true,
            "message" => "success",
            'data' => $user
        ]);
    }

    public function change_password()
    {
        $user = auth('sanctum')->user();

        $validator = Validator::make(request()->input(), [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        if (!$validator->passes()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()]);
        }

        if (!Hash::check(request('old_password'), $user->password)) {
            return response()->json(["status" => false, "message" => 'Invalid old password']);
        }

        $data = [];
        if (request('password')) {
            $user->password = Hash::make(request('password'));
            $user->save();
        }

        return response()->json([
            "status" => true,
            "message" => "success",
            'user' => $user
        ]);
    }

    public function google_login()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
        } catch (RequestException $e) {
            return $e->getResponse()->json(); //Get error response body
        }

        if ($user) {
            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {

                return response()->json([
                    "status" => true,
                    "message" => "success",
                    'user' => $finduser
                ]);
            } else {

                $finduser = User::where('email', $user->email)->first();

                if ($finduser) {
                    $finduser->google_id = $user->id;
                    $finduser->save();
                    return response()->json([
                        "status" => true,
                        "message" => "success",
                        'user' => $finduser
                    ]);
                }

                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => Hash::make(time())
                ]);

                return response()->json([
                    "status" => true,
                    "message" => "success",
                    'user' => $newUser
                ]);
            }
        } else {
            return response()->json([
                "status" => false,
                "message" => "invalid",
                'user' => null
            ]);
        }
    }

    public function facebook_login()
    {
        $user = Socialite::driver('facebook')->stateless()->user();

        if ($user) {
            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {

                return response()->json([
                    "status" => true,
                    "message" => "success",
                    'user' => $finduser
                ]);
            } else {

                $finduser = User::where('email', $user->email)->first();

                if ($finduser) {
                    $finduser->google_id = $user->id;
                    $finduser->save();
                    return response()->json([
                        "status" => true,
                        "message" => "success",
                        'user' => $finduser
                    ]);
                }

                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => Hash::make(time())
                ]);

                return response()->json([
                    "status" => true,
                    "message" => "success",
                    'user' => $newUser
                ]);
            }
        } else {
            return response()->json([
                "status" => false,
                "message" => "invalid",
                'user' => null
            ]);
        }
    }

    public function requests()
    {
        $requests = RequestDelivery::query();
        if (auth('sanctum')->user()->hasRole("Merchant")) {
            $requests = $requests->whereIn('store_id', auth('sanctum')->user()->stores()->pluck('id'));
        } else {
            $requests = $requests->where('delivery_id', auth('sanctum')->id());
        }
        $requests = $requests->with('store', 'delivery')->orderBy('id', 'DESC')->paginate(10);
        return response()->json(["status" => true, "message" => "success", 'data' => $requests]);
    }

    public function request_delivery()
    {
        $validator = Validator::make(request()->input(), [
            'delivery_id' => 'required|exists:' . User::class . ',id',
        ]);

        if (!$validator->passes()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()]);
        }

        $RequestDeliveryCheck = RequestDelivery::where('store_id', auth('sanctum')->user()->stores()->first()->id)->where('delivery_id', request('delivery_id'))->first();

        if ($RequestDeliveryCheck) {
            return response()->json(["status" => false, "message" => "request exist"]);
        }

        $request_delivery = RequestDelivery::create(['store_id' => auth('sanctum')->user()->stores()->first()->id, 'delivery_id' => request('delivery_id')]);

        Notification::create([
            'title' => "request delivery",
            'description' => "Request for delivery please accept or reject",
            'type' => 'RequestDelivery',
            'type_id' => $request_delivery->id,
            'user_id' => request('delivery_id'),
            'external' => 0,
            'url' => null,
        ]);

        return response()->json([
            "status" => true,
            "message" => "success",
            'data' => $request_delivery
        ]);
    }

    public function request_delivery_status()
    {

        $request_delivery = RequestDelivery::where('store_id', auth('sanctum')->id())->where('id', request('request_id'))->first();
        if (!$request_delivery) {
            return response()->json([
                "status" => false,
                "message" => "Request not exist",
                'user' => null
            ]);
        }

        Notification::create([
            'title' => "request delivery",
            'description' => "Request for delivery please accept or reject",
            'type' => 'RequestDelivery',
            'type_id' => $request_delivery->id,
            'user_id' => request('delivery_id'),
            'external' => 0,
            'url' => null,
        ]);

        return response()->json([
            "status" => true,
            "message" => "success",
            'user' => null
        ]);
    }
}
