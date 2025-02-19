<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nnjeim\World\Models\Currency;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['is_favorite', 'is_cart', 'rate'];

    protected $fillable = [
        'name',
        'description',
        'price',
        'old_price',
        'code',
        'order_status',
        'new_product',
        'most_wanted',
        'user_id',
//        'store_id',
        'category_id',
//        'brand_id',
        'image',
    ];


    protected $hidden = ['product_rates', 'deleted_at'];

    protected $casts = ['price' => 'float'];

    public function getImageAttribute()
    {
        return ($image = $this->images()->first()) ? $image->image : url('assets/images/image.png');
    }

    static function statusList($status = "")
    {
        $array = [
            0 => __('InActive'),
            1 => __('Active'),
        ];

        if ($status === false) {
            return $array;
        }

        if (array_key_exists($status, $array)) {
            return $array[$status];
        }

        return $array;
    }

    public function getPriceStringAttribute()
    {
        if($this->store and $this->store->currency) {
            return $this->price . ' ' . $this->store->currency->code;
        }

        return $this->price;
    }

    public function getTotalStringAttribute()
    {
        return $this->total.' '.$this->store->currency->code;
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    function ProductDetails()
    {
        return $this->hasMany(ProductDetail::class);
    }

    function product_rates()
    {
        return $this->hasMany(ProductRate::class);
    }

    function getIsFavoriteAttribute()
    {
        if (auth()->check() or auth('sanctum')->check()) {
            if (auth('sanctum')->check()) {
                return Favorite::where('user_id', auth('sanctum')->id())->where('product_id', $this->id)->exists();
            } else {
                return Favorite::where('user_id', auth()->id())->where('product_id', $this->id)->exists();
            }
        } else {
            $device_id = request()->header('device_id') ? request()->header('device_id') : request('device_id');
            if($device_id) {
                return Favorite::where('device_id', $device_id)->where('product_id', $this->id)->exists();
            }else{
                return Favorite::where('device_id', session()->getId())->where('product_id', $this->id)->exists();
            }
        }
    }

    function getIsCartAttribute()
    {
        if (auth()->check() or auth('sanctum')->check()) {
            if (auth('sanctum')->check()) {
                return Cart::where('user_id', auth('sanctum')->id())->where('product_id', $this->id)->exists();
            } else {
                return Cart::where('user_id', auth()->id())->where('product_id', $this->id)->exists();
            }
        } else {
            $device_id = request()->header('device_id') ? request()->header('device_id') : request('device_id');
            if($device_id) {
                return Cart::where('device_id', $device_id)->where('product_id', $this->id)->exists();
            }else{
                return Cart::where('device_id', session()->getId())->where('product_id', $this->id)->exists();
            }
        }

    }

    function getRateAttribute()
    {
        if (!empty($this->product_rates) and $this->product_rates->count() > 0) {
            return $this->product_rates->sum('rate') / $this->product_rates->count();
        }
        return 0;
    }


}
