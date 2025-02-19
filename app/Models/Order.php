<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $hidden = ['deleted_at'];

    protected $appends = ['qr_code', 'string_status'];

    protected $fillable = [
        'order_number',
        'note',
        'discount',
        'total',
        'order_total',
        'coupon',
        'buyer_id',
        'driver_id',
        'delivery_id',
        'user_id',
        'address_id',
        'payment_gateway_id',
        'delivery_method_id',
        'store_id',
        'status_id',
        'status',
        'delivery_fee',
        'redeem_price',
        'district_id',
        'district_delivery_price',
    ];

    function getQrCodeAttribute()
    {
        if ($this->order_number) {

            $output_file = 'qr-code/img-' . $this->order_number . (auth()->check() ? auth()->id() : 0) . (request('merchant') ? 1 : (request('delivery') ? 2 : 3)) . '.png';
            if (!Storage::exists($output_file)) {
                $image = QrCode::format('png')
                    ->size(200)
                    ->generate($this->order_number . ':' . (auth()->check() ? auth()->id() : 0));
                Storage::put($output_file, $image); //storage/app/public/img/qr-code/img-1557309130.png
            }
            return url('storage/' . $output_file);
        }
    }

    function OrderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    function store()
    {
        return $this->belongsTo(Store::class);
    }

    function address()
    {
        return $this->belongsTo(Address::class);
    }

    function district()
    {
        return $this->belongsTo(District::class);
    }

    function payment_gateway()
    {
        return $this->belongsTo(PaymentGateway::class);
    }
    function delivery_method()
    {
        return $this->belongsTo(DeliveryMethod::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function delivery()
    {
        return $this->belongsTo(User::class, 'delivery_id');
    }

    function order_status()
    {
        return $this->belongsTo(Status::class, 'status', 'key');
    }

    public function getStringStatusAttribute()
    {
        return $this->statusList($this->status ? $this->status : 0);
    }

    static function statusList($status = "")
    {
        $array = [
            0 => __('Pending'),
            1 => __('Store Accepted'),
            2 => __('Delivery accepted'),
            3 => __('In delivery'),
            4 => __('Completed'),
            5 => __('Canceled'),
        ];

        if ($status === false) {
            return $array;
        }

        if (array_key_exists($status, $array)) {
            return $array[$status];
        }

        return $array;
    }
}
