<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use  SoftDeletes, HasFactory;

    protected $fillable = [
        'key',
        'value',
        'color',
        'status',
    ];

    protected $hidden = ['deleted_at'];

}
