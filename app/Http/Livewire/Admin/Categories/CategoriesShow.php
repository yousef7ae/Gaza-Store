<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use App\Models\Store;
use Livewire\Component;

class CategoriesShow extends Component
{
    public $item;

    function mount($id)
    {
        if (auth()->user()->hasRole('Admin')) {
            $this->item = Category::findOrFail($id);
        } else {
            $store = Store::where('user_id', auth()->id())->value('id');
            $this->item = Category::where('status', 1)->where('store_id', $store)->orWhere('user_id', auth()->id())->findOrFail($id);
        }
    }

    public function render()
    {
        return view('livewire.admin.categories.categories-show')->layout('livewire.admin.app');
    }

}
