<?php

namespace App\Http\Livewire\Admin\Brands;

use App\Models\Brand;
use App\Models\BrandStore;
use App\Models\CategoryStore;
use App\Models\Store;
use Livewire\Component;
use Livewire\WithFileUploads;

class BrandsCreate extends Component
{
    use WithFileUploads;

    public $brand = ['brand_id' => 0], $store_id, $image, $imageTemp, $brands, $brand_name;

    public function mount($store_id = null)
    {
        $this->store_id = $store_id;
        if (!auth()->user()->hasRole('Admin')) {
            $this->brands = Brand::whereNotNull('name')->where('status', 1)->get();
        }

    }

    public function store()
    {
        $this->validate([
            'brand.description' => '',
            'brand.image' => '',
        ]);

        if (auth()->user()->hasRole('Admin')) {
            $this->validate(['brand.name' => 'required|string',]);
        }

        if ($this->brand['brand_id'] === "other") {
            $this->validate([
                'brand_name' => 'required|min:1|max:70|string',
            ]);
            $brand = Brand::updateOrCreate(['name' => $this->brand_name]);
            $this->brand['brand_id'] = $brand->id;
        }

        if (auth()->user()->hasRole('Admin') or !empty($this->brand_name)) {
            if ($this->imageTemp) {
                $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
                $this->brand['image'] = $this->imageTemp->store('Brands');
            } else {
                unset($this->brand['image']);
            }
        } else {
            unset($this->brand['image']);
        }

        $this->brand['user_id'] = auth()->id();


        $brand = Brand::updateOrCreate(['name' => $this->brand['name']], $this->brand);

        if (empty($this->brand['store_id']) and $this->store_id) {
            $this->brand['store_id'] = $this->store_id;
        }

        if (!empty($this->brand['store_id'])) {
            BrandStore::create([
                'store_id' => $this->brand['store_id'],
                'brand_id' => $brand->id
            ]);
        }


        $this->emit('success', __('Brand  successfully Added.'));
        $this->brand = ['brand_id' => 0];

    }


    public function render()
    {

        if (!auth()->user()->hasRole("Admin")) {
            $store = Store::where('user_id', auth()->id())->first();
            if ($store) {
                $this->brand['store_id'] = $store->id;
            }
        }

        return view('livewire.admin.brands.brands-create')->layout('livewire.admin.app');
    }

}
