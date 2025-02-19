<?php

namespace App\Http\Livewire\Admin\CountriesLists;

use Livewire\Component;
use Nnjeim\World\Models\Country;

class CountriesListsCreate extends Component
{
    public $country;


    public function store()
    {
        $this->validate([
            'country.name' => 'required',
            'country.iso2' => 'required',
            'country.iso3' => 'required',
            'country.phone_code' => 'numeric',
            'country.region' => 'required',
            'country.sub_region' => 'required',
        ]);

        $country = Country::create($this->country);

        $this->emit('success', __('Country successfully Added.'));
        $this->country = [];

    }


    public function render()
    {
        return view('livewire.admin.countries-lists.countries-lists-create')->layout('livewire.admin.app');
    }

}
