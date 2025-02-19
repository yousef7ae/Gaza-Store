<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Point extends Model
{
    use  SoftDeletes, HasFactory;

    protected $fillable = ['description'];
    protected $hidden = ['deleted_at'];

}
