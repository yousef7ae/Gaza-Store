<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{


    protected $fillable = [
        'product_name',
        'qty',
        'constant',
        'price',
        'discount',
        'total',
        'order_id',
        'product_id',
        'user_id',
        'store_id',
    ];
    protected $casts = ['constant' => 'array'];
    use HasFactory, SoftDeletes;

    protected $hidden = ['deleted_at'];

    function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->with('store');
    }

}
