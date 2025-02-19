<?php

namespace App\Http\Livewire\Admin\Addresses;

use Livewire\Component;
use App\Models\Address;
use Livewire\WithPagination;

class Addresses extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $address, $deleteId, $name, $email, $country, $mobile, $city, $address_id, $zip_code, $note;

    public function search()
    {

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditAddress($id)
    {
        $this->address_id = $id;
    }

    public function refreshModal()
    {
        $this->address_id = "";
    }


    public function delete()
    {

        $address = Address::findOrFail($this->deleteId);

        if (!auth()->guard('web')->user()->can('address delete')) {
            session()->flash('danger', __('address does not have the right permissions.'));
            return redirect()->route('admin.address');
        }

        $address->delete();
        session()->flash('success', __('address successfully Deleted.'));
        return redirect()->route('admin.address');

    }


    public function render()
    {
        $addresses = Address::query();

        if ($this->name) {
            $addresses = $addresses->where("name", 'LIKE', "%" . $this->name . "%");
        }

        if ($this->email) {
            $addresses = $addresses->where("email", 'LIKE', "%" . $this->email . "%");
        }

        if ($this->mobile) {

            $addresses = $addresses->where("mobile", 'LIKE', "%" . $this->mobile . "%");
        }
        if ($this->country) {

            $addresses = $addresses->where("country", 'LIKE', "%" . $this->country . "%");
        }

        if ($this->city) {

            $addresses = $addresses->where("city", 'LIKE', "%" . $this->city . "%");
        }

        if ($this->address) {

            $addresses = $addresses->where("address", 'LIKE', "%" . $this->address . "%");
        }
        if ($this->zip_code) {

            $addresses = $addresses->where("zip_code", 'LIKE', "%" . $this->zip_code . "%");
        }
        if ($this->note) {

            $addresses = $addresses->where("note", 'LIKE', "%" . $this->note . "%");
        }


        $addresses = $addresses->orderBy('created_at', "DESC")->paginate(10);

        return view('livewire.admin.address.address', compact('addresses'))->layout('livewire.admin.app');
    }

}
