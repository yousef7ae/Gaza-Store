<?php

namespace App\Http\Livewire\Admin\CitiesLists;

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
            'city.country_code' => '',
            'city.country_id' => 'required|exists:countries,id',
            'city.state_id' => 'nullable|exists:states,id',
        ]);

        $city = City::create($this->city);

        $this->emit('success', __('City successfully Added.'));
        $this->city = [];

    }

    public function render()
    {
        return view('livewire.admin.cities-lists.cities-lists-create')->layout('livewire.admin.app');
    }

}
