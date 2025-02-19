<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscribeNews extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'email',
    ];

    protected $hidden = ['deleted_at'];

}
