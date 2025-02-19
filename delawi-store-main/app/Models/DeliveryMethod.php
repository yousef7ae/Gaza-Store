<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryMethod extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'description',
        'image'

    ];

    protected $hidden = ['deleted_at'];

    public function getImageAttribute($value)
    {
        if ($value) {
            return url('storage/' . $value);
        } else {
            return url('dashboard/images/image1.png');
        }
    }

    static function typeList($status = "")
    {
        $array = [
            0 => __('Delivery'),
            1 => __('From Store'),
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
