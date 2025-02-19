<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryFee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'store_id',
        'from',
        'to',
        'value',
    ];

    protected $hidden = ['deleted_at'];

    function store()
    {
        return $this->belongsTo(Store::class);
    }

}
