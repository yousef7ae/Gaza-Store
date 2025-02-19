<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use  SoftDeletes, HasFactory;

    protected $fillable = [
        'title',
        'order',
        'submenus',
    ];

    protected $hidden = ['deleted_at'];

    protected $casts = ['title' => 'json', 'submenus' => 'json'];

    public function getTitleLangAttribute()
    {
        if (!empty($this->title[app()->getLocale()])) {
            return $this->title[app()->getLocale()];
        } else {
            return __("Empty");
        }
    }
}
