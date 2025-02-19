<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'user_id',
        'status',
    ];

    protected $casts = ['user_id' => 'integer'];

    public function getImageAttribute($value)
    {
        if ($value) {
            return url('storage/' . $value);
        } else {
            return url('dashboard/images/image1.png');
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function message()
    {
        return $this->hasOne(Message::class)->orderBy('id','DESC');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, Participant::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

}
