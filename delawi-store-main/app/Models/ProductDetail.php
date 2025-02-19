<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'product_details';

    protected $hidden = ['product_id', 'user_id', 'created_at', 'updated_at', 'deleted_at'];

    function product()
    {

        return $this->belongsTo(Product::class);
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            return url('storage/' . $value);
        } else {
            return url('assets/images/image.png');
        }
    }
}
