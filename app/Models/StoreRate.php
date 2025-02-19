<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreRate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'store_id',
        'comment',
        'rate',
        'user_id',
        'device_id',
    ];

    protected $hidden = ['store_id', 'device_id', 'user_id', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }


}
