<?php

namespace App\Http\Livewire\Admin\StoresCategories;

use Livewire\Component;
use App\Models\StoreCategory;

class StoresCategoriesShow extends Component
{
    public $item;

    function mount($id)
    {
        $this->item = StoreCategory::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.stores-categories.stores-categories-show')->layout('livewire.admin.app');
    }
}
