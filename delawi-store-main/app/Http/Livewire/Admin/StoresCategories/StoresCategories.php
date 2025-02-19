<?php

namespace App\Http\Livewire\Admin\StoresCategories;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\StoreCategory;

class StoresCategories extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $name, $deleteId, $store_category_id, $create_store_category_id, $store_id, $create_store_category, $Status, $status;

    public function mount()
    {

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditStoreCategory($id)
    {
        $this->store_category_id = $id;
    }

    public function search()
    {

    }

    public function Status($id)
    {
        $this->Status = $id;
    }

    public function active()
    {
        $status = '1';

        $store_category = StoreCategory::findOrFail($this->Status);
        $store_category->status = $status;

        $store_category->save();
        session()->flash('success', __('Store Category successfully Active'));
    }

    public function inactive()
    {
        $status = '0';

        $store_category = StoreCategory::findOrFail($this->Status);
        $store_category->status = $status;

        $store_category->save();
        session()->flash('success', __('Store Category successfully Inactive'));
    }

    public function CreateStoreCategory()
    {
        $this->create_store_category_id = rand(0, 10000);
    }

    public function delete()
    {
        $store_category = StoreCategory::findOrFail($this->deleteId);

        $store_category->delete();
        $this->emit('success', __('Store Category successfully deleted.'));
    }

    public function refreshModal()
    {
        $this->store_category_id = "";
        $this->create_store_category_id = "";
    }

    public function render()
    {
        $stores_categories = StoreCategory::query();

        // if (!auth()->user()->hasRole('Admin')) {
        //     $stores_categories = $stores_categories->whereHas('categories_stores', function ($q) {
        //         return $q->whereIn('store_id', auth()->user()->stores()->pluck('id')->toArray());
        //     });
        // }

        // if ($this->store_id) {
        //     $stores_categories = $stores_categories->whereHas("stores", function ($q) {
        //         return $q->where('stores.id', $this->store_id);
        //     });
        // }

        if ($this->name) {
            $stores_categories = $stores_categories->where("name", 'LIKE', "%" . $this->name . "%");
        }

        if (array_key_exists($this->status, StoreCategory::statusList(false))) {
            $stores_categories = $stores_categories->where('status', $this->status);
        }

        $stores_categories = $stores_categories->orderBy('created_at', "DESC")->paginate(30);

        return view('livewire.admin.stores-categories.stores-categories', compact('stores_categories'))->layout('livewire.admin.app');
    }
}
