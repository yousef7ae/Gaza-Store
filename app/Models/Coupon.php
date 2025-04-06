<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'value',
        'count',
//        'type',
//        'type_status',
//        'used',
        'user_id',
//        'store_id',
//        'category_id',
       'product_id',
        'expiration',
        'status',
    ];

//    protected $appends = ['type'];

    protected $hidden = ['deleted_at'];

    function store()
    {
        return $this->belongsTo(Store::class);
    }

//    function getTypeAttribute()
//    {
//        $type = "";
//
//        if ($this->store_id) {
//            $type = "store";
//        }
//        if ($this->category_id) {
//            $type = "category";
//        }
//        if ($this->product_id) {
//            $type = "product";
//        }
//
//        return $type;
//    }

    static function type_statusList($type_status = "")
    {
        $array = [
            0 => __('percentage discount'),
            1 => __('value discount'),
        ];

        if ($type_status === false) {
            return $array;
        }

        if (!is_string($type_status) and $type_status != false or $type_status >= 0) {
            return !empty($array[$type_status]) ? $array[$type_status] : $type_status;
        }

        return $array;
    }

    function category()
    {
        return $this->belongsTo(Category::class);
    }

    function product()
    {
        return $this->belongsTo(Product::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
