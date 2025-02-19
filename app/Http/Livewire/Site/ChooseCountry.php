<?php

namespace App\Http\Livewire\Site;

use App\Models\Page;
use Livewire\Component;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;

class ChooseCountry extends Component
{
    public $user = ['country_id' => 0, 'city_id' => 0], $cities, $countries, $page, $user_country_code;

    public function mount()
    {
        $this->page = Page::where('slug', 'CHOOSE COUNTRY')->first();

        $this->user['country_id'] = session('country_id');
        $this->user['city_id'] = session('city_id');
    }

    public function select_country()
    {
        session()->put('country_id', $this->user['country_id']);
        session()->put('city_id', $this->user['city_id']);

        if ($this->user['country_id'] and $this->user['city_id']) {
            $this->dispatchBrowserEvent('close-modal');
            return $this->redirect('/');
        }

    }

    public function render()
    {
        $this->countries = Country::where('status', '1')->get();
        $this->cities = City::where('status', '1')->where('country_id', $this->user['country_id'])->orderBy('name', 'ASC')->get();
        $country = Country::where('status', '1')->where('id', $this->user['country_id'])->first();
        $this->user_country_code = $country ? strtolower($country->iso2) : "";

        return view('livewire.'.env('THEME').'.choose-country')->layout('livewire.'.env('THEME').'.app');
    }
}
