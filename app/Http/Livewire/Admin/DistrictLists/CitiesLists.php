<?php

namespace App\Http\Livewire\Admin\DistrictLists;

use App\Models\District;
use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;
use Nnjeim\World\Models\City;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\State;

class CitiesLists extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $name, $phone_code, $deleteId, $city_id, $create_city, $status, $Status, $country_id, $countries, $state_id, $states;

    public function search()
    {

    }

    function mount()
    {

        $this->countries = Country::get();
        if (array_key_exists(request('status'), Slider::statusList(false))) {
            $this->status = request('status');
        }
    }


    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditCity($id)
    {
        $this->city_id = $id;
    }

    public function CreateCity()
    {
        $this->create_city = rand(0, 10000);
    }

    public function Status($id)
    {
        $this->Status = $id;
    }

    public function active()
    {
        $status = '1';
        $cities = District::findOrFail($this->Status);
        $cities->status = $status;
        $cities->save();
        $this->emit('success', __('City successfully Active'));
    }

    public function inactive()
    {

        $status = '0';
        $cities = District::findOrFail($this->Status);
        $cities->status = $status;
        $cities->save();
        $this->emit('success', __('City successfully Inactive'));

    }

    public function refreshModal()
    {
        $this->city_id = "";
        $this->create_city = "";
    }


    public function delete()
    {

        $cities = District::findOrFail($this->deleteId);

        if (!auth()->user()->can('cities delete')) {
            $this->emit('error', __('City does not have the right permissions.'));
            return false;
        }

        $cities->delete();
        $this->emit('success', __('City successfully Deleted.'));

    }

    public function render()
    {

        $cities = District::query();

        if ($this->name) {
            $cities = $cities->where('name', 'LIKE', '%' . $this->name . '%');
        }
        if ($this->country_id) {
            $cities = $cities->where('country_id', 'LIKE', '%' . $this->country_id . '%');
        }
        if (array_key_exists($this->status, Slider::statusList(false))) {
            $cities = $cities->where('status', $this->status);
        }

        $cities = $cities->orderBy('name', "ASC")->paginate(10);
        return view('livewire.admin.district-lists.cities-lists', compact('cities'))->layout('livewire.admin.app');
    }

}
