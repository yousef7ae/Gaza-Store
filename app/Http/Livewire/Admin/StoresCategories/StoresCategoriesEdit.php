<?php

namespace App\Http\Livewire\Admin\StoresCategories;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\StoreCategory;
use App\Models\StoreType;

class StoresCategoriesEdit extends Component
{
    use WithFileUploads;

    public $store_category, $stores_categories, $store_types = [], $image, $imageTemp;

    function mount($id)
    {
        $store_category = StoreCategory::findOrFail($id);
        $this->store_category = $store_category->toArray();

        $this->stores_categories = StoreCategory::where('status', 1)->get();
        $this->store_types = StoreType::query()->get();
    }

    public function update()
    {
        $store = StoreCategory::findOrFail($this->store_category['id']);

        $this->validate([
            'store_category.name' => 'required|string|min:1|max:150',
            'store_category.store_type_id' => 'required|exists:store_types,id',
        ]);

        if ($this->imageTemp) {
            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);

            $this->imageTemp->store('stores-categories');
            $this->store_category['image'] = 'stores-categories/' . $this->imageTemp->hashName();
        } else {
            unset($this->store_category['image']);
        }

        $store->update($this->store_category);
        return redirect()->route('admin.stores-categories');
//        $this->emit('success','Store successfully updated.');
    }

    function render()
    {
        return view('livewire.admin.stores-categories.stores-categories-edit')->layout('livewire.admin.app');
    }
}
