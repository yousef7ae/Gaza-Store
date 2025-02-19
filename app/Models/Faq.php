<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use  SoftDeletes, HasFactory;

    protected $fillable = [
        'title',
        'description',
        'order',
        'slug',
    ];

    protected $appends = ['title_lang','description_lang'];

    protected $hidden = ['deleted_at'];

    protected $casts = ['title' => 'json', 'description' => 'json'];

    public function getTitleLangAttribute()
    {
        if (!empty($this->title[app()->getLocale()])) {
            return $this->title[app()->getLocale()];
        }
    }

    public function getDescriptionLangAttribute()
    {
        if (!empty($this->description[app()->getLocale()])) {
            return $this->description[app()->getLocale()];
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


    static function statusList($status = "")
    {
        $array = [
            -1 => __('Decline'),
            0 => __('Pending'),
            1 => __('Accepted'),
        ];

        if ($status === false) {
            return $array;
        }

//        if(array_key_exists($status,$array)){
//            return $array[$status];
//        }

        if (!is_string($status) and $status != false or $status >= 0) {
            return !empty($array[$status]) ? $array[$status] : $status;
        }

        return $array;
    }
}
