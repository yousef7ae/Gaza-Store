<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;

class Home extends Component
{
    public $sliders, $stores, $new_products, $most_wonted_list, $brands, $ads, $categories;

    public function mount()
    {
        return $this->redirect(route('admin.home'));

//        $this->sliders = Slider::where('status', 1)->whereNull('store_id')->get();
//        $this->stores = Store::where('status', 1);
//
//        if (session('city_id') and env('STORE') == "multi") {
//            $this->stores = $this->stores->where('city_id', session('city_id'));
//        }
//
//        $this->stores = $this->stores->limit(10)->get();
//
//        $this->new_products = Product::query();
//        if (session('city_id') and env('STORE') == "multi") {
//            $this->new_products = $this->new_products->whereHas('store', function ($q) {
//                return $q->where('city_id', session('city_id'))->where('status', 1);
//            });
//        }
//        $this->new_products = $this->new_products->limit(12)->get();
//        $this->most_wonted_list = Product::query();
//        if (session('city_id') and env('STORE') == "multi") {
//            $this->most_wonted_list = $this->most_wonted_list->whereHas('store', function ($q) {
//                return $q->where('city_id', session('city_id'))->where('status', 1);
//            });
//        }
//        $this->most_wonted_list = $this->most_wonted_list->limit(12)->get();
//        $this->brands = Brand::where('status', 1)->limit(8)->get();
//        $this->ads = Ad::whereNull('store_id')->inRandomOrder()->get();
//
//        $categories = Category::where('status', '1');
//        $this->categories = $categories->orderBy('created_at', "DESC")->get();
    }

    public function render()
    {
        return view('livewire.' . env('THEME') . '.home')->layout('livewire.' . env('THEME') . '.app');
    }
}
