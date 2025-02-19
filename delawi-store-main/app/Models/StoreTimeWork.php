<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;

class StoreTimeWork extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'store_id',
        'day',
        'from',
        'to',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    function store()
    {
        return $this->belongsTo(Store::class);
    }

    static function days()
    {
        return [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
        ];

    }

}
