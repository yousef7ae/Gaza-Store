<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreAccount extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'store_id',
        'order_id',
        'arrest_receipt_id',
        'date',
        'amount',

    ];

    public function store()
    {
        return $this->belongsTo(Store::class , 'store_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class , 'order_id');
    }

    public function arrest_receipt()
    {
        return $this->belongsTo(ArrestReceipt::class , 'arrest_receipt_id');
    }
}

