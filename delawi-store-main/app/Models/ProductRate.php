<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductRate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'comment',
        'rate',
        'user_id',
        'device_id',
    ];

    protected $hidden = ['product_id', 'user_id', 'device_id', 'user_id', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}
