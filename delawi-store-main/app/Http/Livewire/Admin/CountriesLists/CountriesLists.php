<?php

namespace App\Http\Livewire\Admin\CountriesLists;


use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;
use Nnjeim\World\Models\Country;

class CountriesLists extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $name, $phone_code, $deleteId, $country_id, $create_country, $status, $Status, $iso2, $iso3, $region, $sub_region;

    public function search()
    {

    }

    function mount()
    {

        if (array_key_exists(request('status'), Slider::statusList(false))) {
            $this->status = request('status');
        }

    }


    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditCountry($id)
    {
        $this->country_id = $id;
    }

    public function CreateCountry()
    {
        $this->create_country = rand(0, 10000);
    }

    public function Status($id)
    {
        $this->Status = $id;
    }

    public function active()
    {
        $status = '1';
        $countries = Country::findOrFail($this->Status);
        $countries->status = $status;
        $countries->save();
        $this->emit('success', __('Country successfully Active'));
    }

    public function inactive()
    {

        $status = '0';
        $countries = Country::findOrFail($this->Status);
        $countries->status = $status;
        $countries->save();
        $this->emit('success', __('Country successfully Inactive'));

    }

    public function refreshModal()
    {
        $this->country_id = "";
        $this->create_country = "";
    }


    public function delete()
    {

        $countries = Country::findOrFail($this->deleteId);

        if (!auth()->user()->can('countries delete')) {
            $this->emit('error', __('Country does not have the right permissions.'));
            return false;
        }

        $countries->delete();
        $this->emit('success', __('Country successfully Deleted.'));

    }

    public function render()
    {

        $countries = Country::query();

        if ($this->name) {
            $countries = $countries->where('name', 'LIKE', '%' . $this->name . '%');
        }

        if (array_key_exists($this->status, Slider::statusList(false))) {
            $countries = $countries->where('status', $this->status);
        }

        $countries = $countries->orderBy('name', "ASC")->paginate(10);
        return view('livewire.admin.countries-lists.countries-lists', compact('countries'))->layout('livewire.admin.app');
    }


}
