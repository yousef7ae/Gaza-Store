<?php

namespace App\Http\Livewire\Admin\DeliveryMethods;

use App\Models\DeliveryMethod;
use Livewire\Component;

class DeliveryMethodsShow extends Component
{
    public $item;

    function mount($id)
    {
        $this->item = DeliveryMethod::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.delivery-methods.delivery-methods-show')->layout('livewire.admin.app');
    }

}
