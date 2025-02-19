<?php

namespace App\Models;

use App\Http\Livewire\Admin\StoreAccounts\StoreAccounts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArrestReceipt extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'store_id',
        'amount',
        'date',
        'note'
    ];

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function store_account()
    {
        return $this->belongsTo(StoreAccounts::class , 'arrest_receipt_id');
    }
}
