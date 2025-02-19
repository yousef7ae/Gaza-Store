<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use App\Models\CategoryStore;
use App\Models\Store;
use Livewire\Component;
use Livewire\WithFileUploads;

class CategoriesCreate extends Component
{
    use WithFileUploads;

    public $category = ['category_id' => 0, 'store_id' => 0], $stores, $image, $imageTemp, $categories;

    function mount($category_id = null)
    {
        $this->category['category_id'] = $category_id;
    }

    public function store()
    {
        $this->validate([
            'category.name' => 'required',
            'category.description' => 'nullable|max:2000',
        ]);

//        if (auth()->user()->hasRole('Admin')) {
//            $this->validate(['category.store_id' => 'required|exists:stores,id']);
//        }

        // if ($this->category['category_id'] === "other") {
        //     $this->validate(['category.name' => 'required|string|min:1|max:150']);

        //     if (auth()->user()->hasRole('Admin')) {
        //         $name = Category::where('store_id', $this->category['store_id'])->where('name', $this->category['name'])->value('name');
        //     } else {
        //         $name = Category::where('store_id', auth()->user()->stores()->value('id'))->where('name', $this->category['name'])->value('name');
        //     }

        //     if ($name) {
        //         $this->addError('category.name', 'Category exists.');
        //         return false;
        //     } else {
        //         $this->category['category_id'] = null;
        //     }
        // } else {
        //     $this->validate(['category.category_id' => 'required|exists:categories,id']);
        //     $category2 = Category::where('store_id', $this->category['store_id'])->where('id', $this->category['category_id'])->first();
        //     if ($category2) {
        //         $this->addError('category.name', 'Category Store exists.');
        //         $this->addError('category.category_id', 'Category Store exists.');
        //         return false;
        //     }
        // }

        if ($this->imageTemp) {
            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
            $this->category['image'] = $this->imageTemp->store('categories');
        } else {
            unset($this->category['image']);
        }

        $category = Category::create($this->category);

//        if (!auth()->user()->hasRole('Admin')) {
//            $this->category['user_id'] = auth()->id();
//        }

//        if ($this->category['store_id'] == null) {
//            $this->category['store_id'] = auth()->user()->stores()->value('id');
//        }

//        if(!$this->category['category_id']) {
//            $category = Category::create($this->category);
//            $this->category['category_id'] = $category->id;
//        }

//        CategoryStore::updateOrCreate([
//            'store_id' => $this->category['store_id'],
//            'category_id' => $this->category['category_id']
//        ]);

        $this->emit('success', __('Category  successfully Added.'));
        $this->category = ['category_id' => 0, 'store_id' => 0];
    }

    public function render()
    {
        if (auth()->user()->hasRole('Admin')) {
            $this->stores = Store::where('status', 1)->get();
        }

        // $this->categories = Category::query();

        // if($this->category['store_id']) {
        //     $this->categories =$this->categories->where('store_id', $this->category['store_id']);
        // }

        // $this->categories =$this->categories->get();

        return view('livewire.admin.categories.categories-create')->layout('livewire.admin.app');
    }
}
