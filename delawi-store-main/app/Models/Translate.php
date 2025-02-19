<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Translate extends Model
{
    use  SoftDeletes, HasFactory;

    protected $fillable = [
        'key',
        'value',
        'locale',
    ];

    public function translateable()
    {
        return $this->morphTo();
    }

}
