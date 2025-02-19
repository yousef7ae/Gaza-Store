<?php

namespace App\Http\Livewire\Admin\Addresses;

use App\Models\Address;
use Livewire\Component;

class AddressEdit extends Component
{
    public $address;


    function mount($id)
    {

        $address = Address::findOrFail($id);
        $this->address = $address->toArray();

    }

    public function update()
    {
        $this->validate([
            'address.name' => 'required',
            'address.email' => 'required|email|unique:addresses,email,' . $this->address['id'],
            'address.mobile' => 'required|unique:addresses,mobile,' . $this->address['id'],
            'address.country' => '',
            'address.city' => '',
            'address.location' => '',
            'address.zip_code' => '',
            'address.note' => '',

        ]);

        $address = Address::findOrFail($this->address['id']);


        $address->update($this->address);
        $this->emit('success', __('Address successfully updated.'));
    }


    public function render()
    {
        return view('livewire.admin.address.address-edit')->layout('livewire.admin.app');
    }

}
