<?php

namespace App\Http\Livewire\Admin\Addresses;

use App\Models\Address;
use Livewire\Component;

class AddressShow extends Component
{
    public $item;

    function mount($id)
    {
        $this->item = Address::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.address.address-show')->layout('livewire.admin.app');
    }

}
