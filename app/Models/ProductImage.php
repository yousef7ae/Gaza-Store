<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'product_images';
    protected $hidden = ['deleted_at'];

    public function getImageAttribute($value)
    {
        if ($value) {
            return url('storage/' . $value);
        } else {
            return url('assets/images/image.png');
        }
    }

}
