<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\Currency;

class Store extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'image',
        'user_id',
        'phone',
        'mobile',
        'email',
        'address',
        'store_category_id',
        'store_type_id',
        'country_id',
        'city_id',
        'lat',
        'lng',
        'url_facebook',
        'url_instagram',
        'url_whatsapp',
        'url_twitter',
        'url_telegram',
        'payment_gateways',
    ];

    protected $appends = ['customers_count', 'rate', 'currency', 'join'];
    protected $hidden = ['deleted_at', 'store_rates'];

    protected $casts = [
        'products_count' => 'integer',
        'payment_gateways' => 'json',
    ];

    public function getCurrencyAttribute()
    {
        if ($this->currency_id) {
            return Currency::where('id', $this->currency_id)->first();
        }
        return Currency::where('code', 'LYD')->first();
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

    static function typesList($status = "")
    {
        $array = [
            0 => __('Store'),
            1 => __('Resturant'),
        ];

        if ($status === false) {
            return $array;
        }

        if (array_key_exists($status, $array)) {
            return $array[$status];
        }

        return $array;
    }

    public function sliders()
    {
        return $this->hasMany(Slider::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, CategoryStore::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class)->with('store');
    }

    function country()
    {
        return $this->belongsTo(Country::class);
    }

    function city()
    {
        return $this->belongsTo(City::class);
    }

    function brands()
    {
        return $this->belongsToMany(Brand::class, BrandStore::class);
    }

    function store_rates()
    {
        return $this->hasMany(StoreRate::class);
    }

    function store_time_works()
    {
        return $this->hasMany(StoreTimeWork::class);
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            return url('storage/' . $value);
        } else {
            return url('dashboard/images/image1.png');
        }
    }

    public function getCustomersCountAttribute($value)
    {
        return 0;
    }

    function getRateAttribute()
    {
        $rate = 0;

        if (!empty($this->store_rates) and $this->store_rates->count() > 0) {
            $rate = $this->store_rates->sum('rate') / $this->store_rates->count();
        }
        $this->rate = $rate;
        unset($this->orders);
        unset($this->advertisements);
        unset($this->most_wanted);
        unset($this->new_products);
        unset($this->latest_offers);
        $this->save();
        return number_format($rate, 2, '.', '');
    }

    function getJoinAttribute()
    {
        return StoreJoin::where(['store_id' => $this->id, 'user_id' => (auth('sanctum')->check() ? auth('sanctum')->id() : (auth()->check() ? auth()->id() : 0))])->exists();
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    public function arrest_receipts()
    {
        return $this->hasMany(ArrestReceipt::class, 'store_id');
    }

    public function stores_accounts()
    {
        return $this->hasMany(StoreAccount::class);
    }
}
