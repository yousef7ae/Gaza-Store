<?php

namespace App\Http\Livewire\Site\Auth;

use App\Models\Page;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;

class Register extends Component
{

    public $user = ['country_id' => 0, 'city_id' => 0 , 'role_id' => '4' ,'check' => false], $cities, $countries, $page, $user_country_code, $mobile_country_code;

    public function mount()
    {
        $this->page = Page::where('slug', 'CREATE A NEW ACCOUNT')->first();
    }

    public function changeRole($id = null)
    {
        $this->user['role_id'] = $id;
    }

    public function register()
    {
        $this->validate([
                'user.name' => 'required|min:3|max:70',
                'user.email' => 'required|email|max:255|unique:users,email',
                'user.mobile' => 'required|digits_between:5,12|unique:users,mobile',
                'user.postal_code' => 'required|numeric|digits_between:3,12',
                'user.address' => 'required|max:255',
                'user.country_id' => 'required|exists:countries,id',
                'user.city_id' => 'required|exists:cities,id',
//                'user.check' => 'required|boolean',
//                'user.password' => 'required',
            ]);

        if(strlen($this->user['password']) < 6 ){
            $this->addError('user.password',__("Password is weak"));
            return false;
        }

        if(strlen($this->user['password']) < 6 and $this->user['password'] != $this->user['password_confirmation']){
            $this->addError('user.password',__("Password not matches"));
            return false;
        }

        if(!$this->user['check']){
            $this->addError('user.check',__("plaese check approved"));
            return false;
        }

//        if (env('THEME') == "fedi") {
//        } else {
//
//            $this->validate([
//                'user.name' => 'required|min:3|max:70',
//                'user.email' => 'required|email|max:255|unique:users,email',
//                'user.mobile' => 'required|digits_between:5,12|unique:users,mobile',
//                'user.postal_code' => 'required|numeric|digits_between:3,12',
//                'user.address' => 'required|max:255',
//                'user.country_id' => 'required|exists:countries,id',
//                'user.city_id' => 'required|exists:cities,id',
//                'user.check' => 'required|boolean',
//                'user.password' => ['required', 'confirmed', Password::min(6)->numbers()],
//            ]);
//        }

        $this->user['password'] = bcrypt($this->user['password']);
        $this->user['status'] = $this->user['role_id'] == 4 ?  1 : 0;

        $user = User::create($this->user);
        $user->syncRoles($this->user['role_id']); //Customer
        $this->emit('alertSuccess', "You have been successfully registered");
        auth()->login($user);
        return redirect()->route('home');
    }


    public function render()
    {
        $this->countries = Country::where('status', '1')->get();
        $this->cities = City::where('status', '1')->where('country_id', $this->user['country_id'])->get();

        $country = Country::where('status', '1')->where('id', $this->user['country_id'])->first();
        $this->user_country_code = $country ? strtolower($country->iso2) : "";
        $this->mobile_country_code = $country ? strtolower($country->iso2) : "";

        return view('livewire.' . env('THEME') . '.auth.register')->layout('livewire.' . env('THEME') . '.app');
    }
}
