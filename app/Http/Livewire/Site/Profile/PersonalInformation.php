<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Page;
use App\Models\User;
use Livewire\Component;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;

class PersonalInformation extends Component
{
    public $user = ['country_id' => 0, 'city_id' => 0], $cities, $countries, $page, $user_country_code, $mobile_country_code;

    function mount()
    {

        $user = User::findOrFail(auth()->id());
        $this->user_country_code = $user->country ? strtolower($user->country->iso2) : "";
        $this->mobile_country_code = $user->country ? strtolower($user->country->iso2) : "";

        $this->user = $user->toArray();
        $this->page = Page::where('slug', 'Profile')->first();


    }

    public function update()
    {

        $this->validate([
            'user.name' => 'required',
            'user.email' => 'required|email|max:255|unique:users,id,' . auth()->id(),
            'user.mobile' => 'required|numeric|digits_between:5,12|unique:users,mobile,' . auth()->id(),
            'user.country_id' => 'required|exists:countries,id',
            'user.city_id' => 'required|exists:cities,id',
            'user.address' => 'required|max:255',
            'user.postal_code' => 'required|numeric|digits_between:3,12',

        ]);

        $user = User::findOrFail(auth()->id());


        if (!empty($this->user['password']) and $this->user['password'] != "") {
            $this->validate([
                'user.password' => 'required|min:6',
            ]);
            $user->password = bcrypt($this->user['password']);
            $user->save();
            unset($this->user['password']);
        }
        unset($this->user['image']);
        $user->update($this->user);
        $this->emit('alertSuccess', __("Data has been updated successfully"));

    }


    public function render()
    {
        $this->countries = Country::where('status', '1')->get();
        $this->cities = City::where('status', '1')->where('country_id', $this->user['country_id'])->get();
        $country = Country::where('status', '1')->where('id', $this->user['country_id'])->first();
        $this->user_country_code = $country ? strtolower($country->iso2) : "";
        $this->mobile_country_code = $country ? strtolower($country->iso2) : "";

        return view('livewire.'.env('THEME').'.profile.personal-information')->layout('livewire.'.env('THEME').'.app');
    }

}
