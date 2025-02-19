<?php

namespace App\Http\Livewire\Admin\DistrictLists;

use App\Models\District;
use Livewire\Component;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\State;

class CitiesListsEdit extends Component
{
    public $city, $countries, $states;

    function mount($id)
    {

        $city = District::findOrFail($id);
        $this->city = $city->toArray();

        $this->countries = Country::get();
        $this->states = State::get();

    }

    public function update()
    {
        $this->validate([
            'city.name' => 'required',
            'city.delivery_price' => 'required',
        ]);

        $city = District::findOrFail($this->city['id']);
        $city->update($this->city);
        $this->emit('success', __('City successfully Update.'));
    }

    public function render()
    {
        return view('livewire.admin.district-lists.cities-lists-edit')->layout('livewire.admin.app');
    }

}
