<?php

namespace App\Http\Livewire\Admin\DistrictLists;

use App\Models\District;
use Livewire\Component;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\State;

class CitiesListsCreate extends Component
{
    public $city, $countries, $states;

    function mount()
    {

        $this->countries = Country::get();
        $this->states = State::get();
    }

    public function store()
    {
        $this->validate([
            'city.name' => 'required',
            'city.delivery_price' => 'required',
        ]);

        $city = District::create([
            'name'=>$this->city['name'],
            'delivery_price'=>$this->city['delivery_price'],
        ]);

        $this->emit('success', __('City successfully Added.'));
        $this->city = [];

    }

    public function render()
    {
        return view('livewire.admin.district-lists.cities-lists-create')->layout('livewire.admin.app');
    }

}
