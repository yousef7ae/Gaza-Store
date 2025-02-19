<?php

namespace App\Http\Livewire\Admin\CitiesLists;

use Livewire\Component;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\State;

class CitiesListsEdit extends Component
{
    public $city, $countries, $states;

    function mount($id)
    {

        $city = City::findOrFail($id);
        $this->city = $city->toArray();

        $this->countries = Country::get();
        $this->states = State::get();

    }

    public function update()
    {
        $this->validate([
            'city.name' => 'required',
            'city.country_id' => 'required|exists:countries,id',
            'city.state_id' => 'required|exists:states,id',
        ]);

        $city = City::findOrFail($this->city['id']);
        $city->update($this->city);
        $this->emit('success', __('City successfully Update.'));
    }

    public function render()
    {
        return view('livewire.admin.cities-lists.cities-lists-edit')->layout('livewire.admin.app');
    }

}
