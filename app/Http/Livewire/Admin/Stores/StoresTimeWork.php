<?php

namespace App\Http\Livewire\Admin\Stores;

use App\Models\StoreTimeWork;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use App\Models\Store;
use Livewire\Component;
use Livewire\WithFileUploads;

class StoresTimeWork extends Component
{
    use WithFileUploads;

    public $store, $store_time_works = [];

    function mount($store_id)
    {
        $this->store = Store::findOrFail($store_id);

        foreach (StoreTimeWork::days() as $day) {
            if (!StoreTimeWork::where(['day' => $day, "store_id" => $this->store->id])->first()) {

                StoreTimeWork::create([
                    'day' => $day,
                    "store_id" => $this->store->id,
                    'status' => 1,
                    'from' => "00:00:00",
                    'to' => "23:23:59"
                ]);
            }
        }

        $store_time_works = $this->store->store_time_works()->select('day', 'from', 'to', 'status')->get()->toArray();
        foreach ($store_time_works as $store_time_work) {
            $this->store_time_works[$store_time_work['day']] = $store_time_work;
        }
    }

    public function update()
    {
        foreach (StoreTimeWork::days() as $day) {
            $StoreTimeWork = StoreTimeWork::where('store_id', $this->store->id)->where('day', $day)->first();
            if (!$StoreTimeWork) {
                $StoreTimeWork = StoreTimeWork::insert(['store_id' => $this->store->id, 'day' => $day]);
            }
            if (!empty($this->store_time_works[$day]) and !empty($this->store_time_works[$day]['status']) and $this->store_time_works[$day]['status']) {
                $StoreTimeWork->update(['status' => 1, 'from' => $this->store_time_works[$day]['from'], 'to' => $this->store_time_works[$day]['to']]);
            } else {
                StoreTimeWork::where('store_id', $this->store->id)->where('day', $day)->update(['status' => 0]);
            }
        }

        $this->store = Store::findOrFail($this->store->id);

        $this->emit('success', __('Store successfully updated.'));

    }


    function render()
    {
        return view('livewire.admin.stores.stores-time-work')->layout('livewire.admin.app');
    }


}
