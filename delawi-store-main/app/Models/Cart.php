<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'price',
        'qty',
        'constant',
        'total',
        'product_id',
        'product_name',
        'user_id',
        'device_id',
        'store_id',
    ];

    protected $casts = ['qty' => 'integer', 'price' => 'float', 'total' => 'float', 'constant' => 'array'];

    protected $hidden = ['product_id', 'product_name', 'device_id', 'user_id', 'deleted_at'];

    public function getPriceStringAttribute()
    {
        return $this->price.' '.($this->product->store->currency?$this->product->store->currency->code:"");
    }

    public function getTotalStringAttribute()
    {
        return $this->total.' '.($this->product->store->currency?$this->product->store->currency->code:"");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
