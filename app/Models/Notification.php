<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'type',
        'type_id',
        'user_id',
        'external',
        'url',
    ];

    protected $casts = [
        'external' => 'integer'
    ];

    function user()
    {

        return $this->belongsTo(User::class);
    }

    function AD()
    {

        return $this->belongsTo(Ad::class);
    }


}
