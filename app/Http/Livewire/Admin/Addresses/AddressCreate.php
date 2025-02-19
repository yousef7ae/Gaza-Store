<?php

namespace App\Http\Livewire\Admin\Addresses;

use App\Models\Address;
use Livewire\Component;

class AddressCreate extends Component
{
    public $address;


    public function store()
    {
        $this->validate([
            'address.name' => 'required',
            'address.email' => 'required|email|unique:addresses,email',
            'address.mobile' => 'required|unique:addresses,mobile',
            'address.country' => '',
            'address.city' => '',
            'address.location' => '',
            'address.zip_code' => '',
            'address.note' => '',

        ]);


        $address = Address::create($this->address);

        $this->emit('success', __('Address successfully Added.'));
        $this->address = [];

    }


    public function render()
    {

        return view('livewire.admin.address.address-create')->layout('livewire.admin.app');
    }


}
