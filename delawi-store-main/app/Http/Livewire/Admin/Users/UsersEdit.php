<?php

namespace App\Http\Livewire\Admin\Users;
;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use Spatie\Permission\Models\Role;

class UsersEdit extends Component
{

    use WithFileUploads;

    public $user, $name, $image, $imageTemp, $role_id, $roles = [], $user_id, $cities, $countries;

    function mount($id)
    {
        $user = User::findOrFail($id);
        $this->user = $user->toArray();
        $this->user['role_id'] = ($user->roles->count() > 0) ? $user->roles->first()->id : 0;

        $this->roles = Role::get();
    }

    public function update()
    {
        $this->validate([
            'user.name' => 'required',
            'user.email' => 'required|email|unique:users,email,' . $this->user['id'],
            'user.mobile' => 'required|unique:users,mobile,' . $this->user['id'],
            'user.role_id' => 'required|exists:roles,id',
            'user.country_id' => 'required|exists:countries,id',
            'user.city_id' => 'required|exists:cities,id',
            'user.address' => 'required|max:255',
            'user.postal_code' => 'required|numeric|digits_between:3,12',
            'user.status' => '',
            'user.image' => '',
        ]);

        $this->user['user_id'] = auth()->user()->id;

        $user = User::findOrFail($this->user['id']);

        if ($this->user['role_id'] == 2) {
            $this->user['status_merchant'] = $this->user['status'];
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

        if (!empty($this->user['password']) and $this->user['password'] != "") {
            $this->validate([
                'user.password' => 'required|min:6',
            ]);
            $user->password = bcrypt($this->user['password']);
            $user->save();
            unset($this->user['password']);
        } else {
            unset($this->user['password']);
        }

        $user->syncRoles($this->user['role_id']);
        $user->update($this->user);
        $this->emit('success', __('User successfully updated.'));
    }

    public function render()
    {
        $this->countries = Country::where('status', '1')->get();
        $this->cities = City::where('status', '1')->where('country_id', $this->user['country_id'])->get();
        return view('livewire.admin.users.users-edit')->layout('livewire.admin.app');
    }
}
