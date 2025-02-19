<?php

namespace App\Http\Livewire\Admin\Users;
;

use App\Models\Type;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use Spatie\Permission\Models\Role;

class UsersCreate extends Component
{
    use WithFileUploads;

    public $user = ['country_id' => 0, 'city_id' => 0, 'role_id' => 0], $image, $imageTemp, $role_id, $roles = [], $cities, $countries, $user_id, $store_id;

    function mount($user_id, $store_id)
    {
        $this->user_id = $user_id;
        $this->store_id = $store_id;
        $this->roles = Role::get();
    }

    public function store()
    {
        $this->validate([
            'user.name' => 'required',
            'user.email' => 'required|email|unique:users,email',
            'user.mobile' => 'required|unique:users,mobile',
            'user.password' => 'required|min:6',
            'user.role_id' => 'required|exists:roles,id',
            'user.country_id' => 'required|exists:countries,id',
            'user.city_id' => 'required|exists:cities,id',
            'user.address' => 'required|max:255',
            'user.postal_code' => 'required|numeric|digits_between:3,12',
            'user.image' => '',
        ]);

        $this->user['user_id'] = auth()->user()->id;

        if ($this->store_id) {
            $this->user['store_id'] = $this->store_id;
        }

        if ($this->user['role_id'] == 2) {
            $this->validate(['user.status_merchant' => 'required|in:0,1,2',]);
        } else {
            $this->user['status_merchant'] = null;
        }

        if ($this->imageTemp) {
            $this->validate(['imageTemp' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
            $this->user['image'] = $this->imageTemp->store('users/images');
        } else {
            unset($this->user['image']);
        }

        if ($this->user['password']) {
            $this->user['password'] = bcrypt($this->user['password']);
        }

        $user = User::create($this->user);

        $user->syncRoles($this->user['role_id']);

        $this->emit('success', __('User successfully Added.'));
        $this->user = ['country_id' => 0, 'city_id' => 0, 'role_id' => 0];
    }

    public function render()
    {
        $this->countries = Country::where('status', '1')->get();
        $this->cities = City::where('status', '1')->where('country_id', $this->user['country_id'])->get();
        return view('livewire.admin.users.users-create')->layout('livewire.admin.app');
    }
}
