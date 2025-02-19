<?php

namespace App\Http\Livewire\Site\Stores;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Store;
use Livewire\Component;
use Livewire\WithPagination;

class StoresSingle extends Component
{
    use WithPagination;

    protected $listeners = ['refreshModal'];
    protected $paginationTheme = 'bootstrap';

    public $store, $store_rate_id, $rate, $category_id, $brand_id, $sliders;

    public function mount($slug)
    {
        $this->store = Store::where('status', '1')->findOrFail($slug);
        $this->sliders = Slider::where('store_id', $slug)->where('status', '1')->limit(10)->orderBy('created_at', "DESC")->get();
        if (request('rate')) {
            $this->rate = request('rate');
        }
        if (request('category_id')) {
            $this->category_id = request('category_id');
        }
        if (request('brand_id')) {
            $this->brand_id = request('brand_id');
        }

    }

    public function StoreRate($slug)
    {
        $this->store_rate_id = $slug;
    }

    public function refreshModal()
    {
        $this->store_rate_id = "";
    }

    public function changeRate($rate)
    {
        $this->rate = $rate;
    }

    public function render()
    {
        $products = $this->store->products();

        if ($this->rate) {
            $productsList = $this->store->products()->get()->whereBetween('rate', [($this->rate - 1), ($this->rate + 1)]);
            $products = $products->whereIn('id', $productsList->pluck('id')->toArray());
        }

        if ($this->category_id) {
            $products = $products->where('category_id', $this->category_id);
        }

        if ($this->brand_id) {
            $products = $products->where('brand_id', $this->brand_id);
        }

        $products = $products->paginate(12);
        return view('livewire.'.env('THEME').'.stores.stores-single', compact('products'))->layout('livewire.'.env('THEME').'.app');
    }


}
