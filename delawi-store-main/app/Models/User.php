<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use SoftDeletes, HasRoles, HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'image',
        'password',
        'status',
        'status_merchant',
        'store_id',
        'country_id',
        'city_id',
        'address',
        'postal_code',
        'fcm_token',
        'api_token',
        'is_available'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'deleted_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'country_id' => 'int',
        'city_id' => 'int',
    ];

    public function getRoleIdAttribute()
    {
        return ($this->roles and (!empty($this->roles[0]))) ? $this->roles[0]->id : 0;
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            return url('storage/' . $value);
        } else {
            return url('dashboard/images/1.png');
        }
    }

    static function statusList($status = "")
    {
        $array = [
            0 => __('Awaiting review'),
            1 => __('Accepted'),
            2 => __('Disabled'),
        ];

        if ($status === false) {
            return $array;
        }

        if (!is_string($status) and $status != false or $status >= 0) {
            return !empty($array[$status]) ? $array[$status] : $status;
        }

        return $array;
    }

    static function status_merchantList($status_merchant = "")
    {
        $array = [
            0 => __('percentage discount'),
            1 => __('Monthly subscription'),
            2 => __('Discount on the number of orders'),
        ];

        if ($status_merchant === false) {
            return $array;
        }

        if (!is_string($status_merchant) and $status_merchant != false or $status_merchant >= 0) {
            return !empty($array[$status_merchant]) ? $array[$status_merchant] : $status_merchant;
        }

        return $array;
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    function product_rates()
    {
        return $this->belongsToMany(Product::class, ProductRate::class);
    }

    function store_rates()
    {
        return $this->belongsToMany(Store::class, StoreRate::class);
    }

    public function notification($message = null, $title = null, $image = null, $data = [])
    {
        $responses = [];
        if ($this->fcm_token) {
            $array = [];

            if (!empty($data['order_id'])) {
                $type = 'order';
                $type_id = $data['order_id'];
                $array['data'] = ['order_id' => $data['order_id'], 'status' => Order::where('id', $data['order_id'])->value('status'), 'roles' => $this->roles()->pluck('name')];
            }

            if (!empty($data['chat_id'])) {
                $type = 'chat';
                $type_id = $data['chat_id'];
                $array['data'] = ['chat_id' => $data['chat_id']];
            }

            if (!empty($data['store_id'])) {
                $type = 'store';
                $type_id = $data['store_id'];
                $array['data'] = ['store_id' => $data['store_id']];
            }

            if (!empty($data['product_id'])) {
                $type = 'product';
                $type_id = $data['product_id'];
                $array['data'] = ['product_id' => $data['product_id']];
            }

            if (!empty($type) and !empty($type_id)) {
                Notification::create([
                    'title' => $title,
                    'description' => $message,
                    'type' => $type,
                    'type_id' => $type_id,
                    'user_id' => auth('sanctum')->id(),
                ]);

                $array['to'] = $this->fcm_token;

                if ($message) {
                    $array['notification']['body'] = $message;
                }

                if ($title) {
                    $array['notification']['title'] = $title;
                }

                if ($image) {
                    $array['notification']['image'] = $image;
                }

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($array),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: key=' . env('FIREBASE_SERVER_KEY'),
                        'Content-Type: application/json',
                        'to: '
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                $responses[] = $response;
            }
            return $responses;
        }
    }

    function store_join()
    {
        return $this->hasMany(StoreJoin::class);
    }

    // public function getIsAvailableAttribute()
    // {
    //     if ($this->is_available == 1) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
