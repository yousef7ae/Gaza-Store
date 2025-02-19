<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StoreCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'store_type_id',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    static function statusList($status = "")
    {
        $array = [
            0 => __('InActive'),
            1 => __('Active'),
        ];

        if ($status === false) {
            return $array;
        }

        if (array_key_exists($status, $array)) {
            return $array[$status];
        }

        return $array;
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            return url('storage/' . $value);
        } else {
            return  url('dashboard/images/image1.png');
        }
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function storeType()
    {
        return $this->belongsTo(StoreType::class, 'store_type_id');
    }
}
