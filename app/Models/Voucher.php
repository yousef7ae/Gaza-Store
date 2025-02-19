<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'value',
        'count',
        'type',
        'used',
        'expiration',
        'user_id',
        'store_id',
        'category_id',
        'product_id',

    ];

    protected $hidden = ['deleted_at'];


    function store()
    {
        $this->belongsTo(Store::class);
    }

    function user()
    {
        $this->belongsTo(User::class);
    }

    function product()
    {
        $this->belongsTo(Product::class);
    }

    function category()
    {
        $this->belongsTo(Category::class);
    }

}
