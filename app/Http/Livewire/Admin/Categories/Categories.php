<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use App\Models\CategoryStore;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $store_id, $name, $description, $image, $deleteId, $category_id, $Status, $status, $create_category;

    public function mount($store_id = null)
    {
        $this->store_id = $store_id;
    }

    public function search()
    {

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditCategory($id)
    {
        $this->category_id = $id;
    }

    public function CreateCategory()
    {
        $this->create_category = rand(0, 10000);
    }

    public function refreshModal()
    {
        $this->category_id = "";
        $this->create_category = "";
    }

    public function Status($id)
    {
        $this->Status = $id;
    }

    public function active()
    {
        $status = '1';

        $categories = Category::findOrFail($this->Status);
        $categories->status = $status;

        $categories->save();
        session()->flash('success', __('Category successfully Active'));
    }

    public function inactive()
    {
        $status = '0';

        $categories = Category::findOrFail($this->Status);
        $categories->status = $status;

        $categories->save();

        session()->flash('success', __('Category successfully Inactive'));
    }

    public function delete()
    {
        if (!auth()->guard('web')->user()->can('categories delete')) {
            $this->emit('alertError', __("You don't have the right permissions."));
            return false;
        }

        if (auth()->user()->hasRole('Admin')) {
            $category = Category::findOrFail($this->deleteId);
        } else {
            $category = CategoryStore::whereIn('store_id', auth()->user()->stores()->pluck('id')->toArray())->where('category_id',$this->deleteId)->firstOrFail();
        }

        $category->delete();
        $this->emit('success', __('Category successfully deleted.'));
    }

    public function render()
    {
        $categories = Category::query();

//        if (!auth()->user()->hasRole('Admin')) {
//            $categories = $categories->whereHas('categories_stores', function ($q) {
//                return $q->whereIn('store_id', auth()->user()->stores()->pluck('id')->toArray());
//            });
//        }

//        if ($this->store_id) {
//            $categories = $categories->whereHas("stores", function ($q) {
//                return $q->where('stores.id', $this->store_id);
//            });
//        }

        if ($this->name) {
            $categories = $categories->where("name", 'LIKE', "%" . $this->name . "%");
        }

        if ($this->description) {
            $categories = $categories->where("description", 'LIKE', "%" . $this->description . "%");
        }

        if (array_key_exists($this->status, Category::statusList(false))) {
            $categories = $categories->where('status', $this->status);
        }

        $categories = $categories->orderBy('created_at', "DESC")->paginate(30);
        // dd($categories[1]);

        return view('livewire.admin.categories.categories', compact('categories'))->layout('livewire.admin.app');
    }
}
