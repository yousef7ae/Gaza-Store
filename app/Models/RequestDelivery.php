<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestDelivery extends Model
{
    use  SoftDeletes, HasFactory;

    protected $fillable = [
        'store_id',
        'delivery_id',
        'status',
    ];

    protected $hidden = ['deleted_at'];

    protected $appends = ['string_status'];

    public function delivery()
    {
        return $this->belongsTo(User::class, 'delivery_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function getStringStatusAttribute()
    {
        return $this->statusList($this->status ? $this->status : 0);
    }

    static function statusList($status = "")
    {
        $array = [
            0 => __('Awaiting review'),
            1 => __('Accepted'),
            2 => __('Reject'),
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
