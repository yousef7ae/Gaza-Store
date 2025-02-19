<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'country',
        'city',
        'location',
        'zip_code',
        'note',
        'user_id',
        'lat',
        'lng',
        'country_id',
        'city_id',
    ];

    protected $hidden = ['deleted_at'];

    function country()
    {
        return $this->belongsTo(Country::class);
    }

    function city()
    {
        return $this->belongsTo(City::class);
    }
}
