<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
    ];

    public $timestamps = false;

    protected $hidden = ['created_at', 'updated_at'];

    public function getImageAttribute($value)
    {
        if ($value) {
            return url('storage/' . $value);
        } else {
            return  url('dashboard/images/' . $this->name . '.png');
        }
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
