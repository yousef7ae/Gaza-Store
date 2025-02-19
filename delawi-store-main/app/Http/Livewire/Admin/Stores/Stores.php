<?php

namespace App\Http\Livewire\Admin\Stores;

use App\Models\Store;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;

class Stores extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $name, $phone, $email, $address, $image, $deleteId, $store_id, $status, $Status, $user_id;
    public $imageTemp, $countries, $cities;

    public function mount()
    {
        if (env('STORE') == 'single') {
            $store = Store::first();
            return $this->redirect(route('admin.stores.show', $store->id));
        }

        if (array_key_exists(request('status'), Store::statusList(false))) {
            $this->status = request('status');
        }

        if (!auth()->user()->hasRole("Admin")) {
            $store = Store::where('user_id', auth()->id())->first();
            if ($store) {
                return $this->redirect(route('admin.stores.show', $store->id));
            }
        }

        if(request('user_id')){
            $this->user_id = request('user_id');
        }
    }

    public function search()
    {

    }

    public function Status($id)
    {
        $this->Status = $id;
    }

    public function active()
    {
        $status = '1';

        $stores = Store::findOrFail($this->Status);
        $stores->status = $status;

        $stores->save();
        $this->emit('success', __('Store successfully Active'));
    }

    public function inactive()
    {
        $status = '0';

        $stores = Store::findOrFail($this->Status);
        $stores->status = $status;

        $stores->save();
        $this->emit('success', __('Store successfully Inactive'));
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditStore($id)
    {
        $this->store_id = $id;
    }

    public function refreshModal()
    {
        $this->store_id = "";
    }

    public function delete()
    {
        $stores = Store::findOrFail($this->deleteId);

        if (!auth()->guard('web')->user()->can('stores delete')) {
            $this->emit('success', __('Store does not have the right permissions.'));
            return false;
        }

        $stores->delete();
        $this->emit('success', __('Category successfully deleted.'));
    }

    public function render()
    {
        $stores = Store::query();
        if (!auth()->user()->hasRole('Admin')) {
            $stores = $stores->where('user_id', auth()->id());
        }

        if ($this->name) {
            $stores = $stores->where("name", 'LIKE', "%" . $this->name . "%");
        }

        if ($this->user_id) {
            $user = User::where('id', $this->user_id)->first();
            if ($user) {
                $stores = $stores->whereIn('id', $user->stores()->pluck('id')->toArray());
            } else {
                $stores = $stores->whereIn('id', [0]);
            }
        }

        if ($this->address) {
            $stores = $stores->where("address", 'LIKE', "%" . $this->address . "%");
        }
        if ($this->phone) {
            $stores = $stores->where("phone", 'LIKE', "%" . $this->phone . "%");
        }
        if ($this->email) {
            $stores = $stores->where("email", 'LIKE', "%" . $this->email . "%");
        }

        if (array_key_exists($this->status, Store::statusList(false))) {
            $stores = $stores->where('status', $this->status);
        }

        $stores = $stores->orderBy('created_at', "DESC")->paginate(10);

        return view('livewire.admin.stores.stores', compact('stores'))->layout('livewire.admin.app');
    }
}
