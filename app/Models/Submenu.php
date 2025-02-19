<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submenu extends Model
{
    use  SoftDeletes, HasFactory;

    protected $fillable = ['name', 'url', 'order', 'menu_id'];

    protected $hidden = ['deleted_at'];


    public function translate()
    {
        return $this->morphOne(Translate::class, 'translateable');
    }

    public function translates()
    {
        return $this->morphMany(Translate::class, 'translateable');
    }

    public function getNameLangAttribute()
    {
        $val = $this->translates()->where('key', 'name')->where('locale', app()->getLocale())->first();
        if ($val) {
            return $val->value;
        } else {
            return $this->name;
        }
    }


    public function getImageAttribute($value)
    {
        if ($value) {
            return url('storage/' . $value);
        } else {
            return url('dashboard/images/image1.png');
        }
    }

    function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
