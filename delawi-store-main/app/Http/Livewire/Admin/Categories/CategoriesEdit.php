<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use App\Models\CategoryStore;
use App\Models\Store;
use Livewire\Component;
use Livewire\WithFileUploads;

class CategoriesEdit extends Component
{
    use WithFileUploads;

    public $category, $categories, $stores, $image, $imageTemp, $user_id, $category_id;

    function mount($id)
    {
        if (auth()->user()->hasRole('Admin')) {
            $category = Category::where('id', $id)->find($id);
        } else {
            $category = Category::where('user_id', auth()->id())->where('id', $id)->find($id);
        }

        if (!$category) {
            abort('404');
        }
        $this->category = $category->toArray();
    }

    public function update()
    {
        $this->validate([
            'category.name' => 'required|string|min:1|max:150',
            'category.description' => 'nullable|max:2000',
        ]);

//        if (auth()->user()->hasRole('Admin')) {
//            $this->validate(['category.store_id' => 'required|exists:stores,id']);
//        }

//        if ($this->category['category_id'] === "other" or !auth()->user()->hasRole('Admin')) {
//            $this->validate(['category.name' => 'required|string|min:1|max:150']);

//            if (auth()->user()->hasRole('Admin')) {
//                $name = Category::where('store_id', $this->category['store_id'])->where('name', $this->category['name'])->value('name');
//            } else {
//                $name = Category::where('store_id', auth()->user()->stores()->value('id'))->where('name', $this->category['name'])->value('name');
//            }
//
//            if ($name) {
//                $this->addError('category.name', 'Category exists.');
//                unset($this->category['name']);
////                return false;
//            } else {
//                $this->category['category_id'] = null;
//            }
//        }
//        else {
//            if (empty($this->category['name'])) {
//                $this->validate(['category.category_id' => 'required|exists:categories,id']);
//            }
//            $category2 = Category::where('store_id', $this->category['store_id'])->where('id', $this->category['category_id'])->first();
//            if ($category2) {
//                $this->addError('category.name', 'Category Store exists.');
//                $this->addError('category.category_id', 'Category Store exists.');
//                return false;
//            }
//        }

        $category = Category::findOrFail($this->category['id']);

        if ($this->imageTemp) {
            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
            $this->category['image'] = $this->imageTemp->store('categories');
        } else {
            unset($this->category['image']);
        }

        $category->update($this->category);

        $this->emit('success', __('Category successfully updated.'));
    }


    function render()
    {
//        if (auth()->user()->hasRole('Admin')) {
//            $this->stores = Store::where('status', 1)->get();
//            $this->categories = Category::where('store_id', $this->category['store_id'])->get();
//        }

        return view('livewire.admin.categories.categories-edit')->layout('livewire.admin.app');
    }
}
