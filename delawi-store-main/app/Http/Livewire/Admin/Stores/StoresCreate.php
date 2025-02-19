<?php

namespace App\Http\Livewire\Admin\Stores;

use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use App\Models\Store;
use App\Models\StoreType;
use App\Models\StoreCategory;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class StoresCreate extends Component
{
    use WithFileUploads;

    public $store = ['store_type_id' => 0, 'country_id' => 0, 'store_category_id' => 0, 'city_id' => 0, 'user_id' => ""], $stores, $store_categories, $image, $user_id, $store_id, $imageTemp, $types, $countries, $cities, $active = 1, $users = [];

    function mount()
    {
        $this->stores = Store::get();
        if (auth()->user()->hasRole('Admin')) {
            $this->users = User::role(['Admin', 'Merchant'])->get();
        }
    }

    public function ActiveTab($id)
    {
        $this->active = $id;
    }

    public function store()
    {
        $this->validate([
            'store.name' => 'required|string',
//            'store.user_id' => 'required,exists:' . User::class . ',id',
            'store.description' => '',
            'store.phone' => '',
            'store.mobile' => '',
            'store.email' => '',
            'store.address' => '',
            'store.store_type_id' => 'required|exists:store_types,id',
            'store.country_id' => 'required|exists:countries,id',
            'store.city_id' => 'required|exists:cities,id',
            'store.lat' => '',
            'store.lng' => '',
        ]);

        if ($this->store['store_type_id'] == 1) {
            $this->validate([
                'store.store_category_id' => 'required|exists:store_categories,id',
            ]);
        }

        $this->store['user_id'] = $this->store['user_id'] ? $this->store['user_id'] : auth()->user()->id;

        if ($this->imageTemp) {
            $this->store['image'] = $this->imageTemp->store('stores');
        } else {
            unset($this->store['image']);
        }

        $store = Store::create($this->store);
//        $this->emit('success','Store  successfully Added.');
        return redirect()->route('admin.stores');
    }

    public function render()
    {
        $this->types = StoreType::query()->get();
        $this->store_categories = StoreCategory::where('status', '1')->where('store_type_id', $this->store['store_type_id'])->get();
        $this->countries = Country::where('status', '1')->get();
        $this->cities = City::where('status', '1')->where('country_id', $this->store['country_id'])->get();

        if ($this->store['user_id']) {
            $user = User::find($this->store['user_id']);
            $this->stores = Store::where('user_id',$this->store['user_id'])->get();

            if ($user) {
                $this->store['email'] = $user->email;
                $this->store['phone'] = $user->phone;
                $this->store['mobile'] = $user->mobile;
                $this->store['country_id'] = $user->country_id;
                $this->store['city_id'] = $user->city_id;
            }
        }

        return view('livewire.admin.stores.stores-create')->layout('livewire.admin.app');
    }
}
