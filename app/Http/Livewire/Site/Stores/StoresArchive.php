<?php

namespace App\Http\Livewire\Site\Stores;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Page;
use App\Models\Store;
use Livewire\Component;
use Livewire\WithPagination;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;

class StoresArchive extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $stores, $user = ['country_id' => 0, 'city_id' => 0, 'category_id' => 0, 'brand_id' => 0], $countries = [], $cities, $user_country_code, $categories = [], $brands = [], $rate = 0,$page_data;

    public function changeRate($rate)
    {
        $this->rate = $rate;
    }

    public function mount()
    {

        if (auth()->check()) {
            $this->user['country_id'] = auth()->user()->country_id ? auth()->user()->country_id : session('country_id');
            $this->user['city_id'] = auth()->user()->city_id ? auth()->user()->city_id : session('city_id');
        } else {
            $this->user['country_id'] = session('country_id');
            $this->user['city_id'] = session('city_id');
        }

        $this->page_data = Page::where('slug', 'STORES')->first();

    }

    public function render()
    {
        $this->countries = Country::where('status', '1')->get();
        $this->brands = Brand::where('status', '1')->get();
        $this->categories = Category::get();
        $this->cities = City::where('status', '1')->where('country_id', $this->user['country_id'])->orderBy('name', 'ASC')->get();
        $country = Country::where('status', '1')->where('id', $this->user['country_id'])->first();
        $this->user_country_code = $country ? strtolower($country->iso2) : "";

        $stores = Store::where('status', '1');

        if ($this->user['country_id']) {
            $stores = $stores->where('country_id', $this->user['country_id']);
        }

        if ($this->rate) {
            $stores = $stores->whereBetween('rate', [($this->rate - 1), ($this->rate + 1)]);
        }

        if ($this->user['city_id']) {
            $stores = $stores->where('city_id', $this->user['city_id']);
        }

        if ($this->user['category_id']) {
            $category = Category::where('id', $this->user['category_id'])->first();
            $stores = $stores->where('id', $category->store_id);
        }

        if ($this->user['brand_id']) {
            $brand = Brand::where('id', $this->user['brand_id'])->first();
            $stores = $stores->where('id', $brand->store_id);
        }

        $this->stores = $stores->orderBy('created_at', "DESC")->get();

        return view('livewire.'.env('THEME').'.stores.stores-archive')->layout('livewire.'.env('THEME').'.app');
    }

}
