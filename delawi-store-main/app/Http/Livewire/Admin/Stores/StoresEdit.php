<?php

namespace App\Http\Livewire\Admin\Stores;

use App\Models\User;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use App\Models\Store;
use App\Models\StoreType;
use App\Models\StoreCategory;
use Livewire\Component;
use Livewire\WithFileUploads;

class StoresEdit extends Component
{
    use WithFileUploads;

    public $store, $image, $imageTemp, $user_id, $store_id, $countries, $cities, $active, $store_categories, $selected_store_type , $store_types, $users = [];

    function mount($id)
    {
        $store = Store::findOrFail($id);
        $this->store = $store->toArray();

        if (auth()->user()->hasRole('Admin')) {
            $this->users = User::role(['Admin', 'Merchant'])->get();
        }

        $this->selected_store_type = StoreType::where('id', $this->store['store_type_id'])->first();
        $this->store_types = StoreType::query()->get();

        $this->store_categories = StoreCategory::where('store_type_id', $this->selected_store_type->id)->get();
        $this->countries = Country::where('status', 1)->get();
        $this->cities = City::where('status', 1)->where('country_id', $this->store['country_id'])->get();
    }

    public function ActiveTab($id)
    {
        $this->active = $id;
    }

    public function update()
    {
        $store = Store::findOrFail($this->store['id']);

        $this->validate([
            'store.name' => 'required',
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

        if ($this->image) {
            $this->validate([
                'image' => 'image'
            ]);
        }

        if ($this->imageTemp) {
            $this->store['image'] = $this->imageTemp->store('stores');
        } else {
            unset($this->store['image']);
        }

        $store->update($this->store);
        return redirect()->route('admin.stores');
//        $this->emit('success','Store successfully updated.');
    }

    function render()
    {
        return view('livewire.admin.stores.stores-edit')->layout('livewire.admin.app');
    }
}
