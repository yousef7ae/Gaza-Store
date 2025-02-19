<?php

namespace App\Http\Livewire\Admin\StoresCategories;

use Livewire\Component;
use App\Models\StoreCategory;
use App\Models\StoreType;
use App\Models\Store;
use Livewire\WithFileUploads;

class StoresCategoriesCreate extends Component
{
    use WithFileUploads;

    public $store_category = [], $store_types = [], $image, $imageTemp;

    function mount()
    {
        $this->store_types = StoreType::query()->get();
    }

    public function store()
    {
        $this->validate([
            'store_category.name' => 'required|string|min:1|max:150',
            'store_category.store_type_id' => 'required|exists:store_types,id',
            'store_category.image' => '',
        ]);

        $name = StoreCategory::where('name', $this->store_category['name'])->value('name');

        if ($name) {
            $this->addError('store_category.name', 'Store Category exists.');
            return false;
        }

        if ($this->imageTemp) {
            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);

            $this->imageTemp->store('stores-categories');
            $this->store_category['image'] = 'stores-categories/' . $this->imageTemp->hashName();
        } else {
            unset($this->store_category['image']);
        }

        if (!auth()->user()->hasRole('Admin')) {
            $this->store_category['user_id'] = auth()->id();
        }

        StoreCategory::create($this->store_category);

        $this->emit('success', __('Store Category successfully Added.'));
        $this->store_category = [];
    }

    public function render()
    {
        return view('livewire.admin.stores-categories.stores-categories-create')->layout('livewire.admin.app');
    }
}
