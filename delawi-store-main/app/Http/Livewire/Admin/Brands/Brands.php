<?php

namespace App\Http\Livewire\Admin\Brands;

use App\Models\Brand;
use App\Models\Store;
use Livewire\Component;
use Livewire\WithPagination;

class Brands extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $store_id, $name, $description, $deleteId, $brand_id, $image, $imageTemp, $status, $Status, $create_brand;

    public function mount($store_id = null)
    {
        $this->store_id = $store_id;
    }

    public function search()
    {
        $this->page = 1;
        if (array_key_exists(request('status'), Brand::statusList(false))) {
            $this->status = request('status');
        }
    }

    public function Status($id)
    {
        $this->Status = $id;
    }

    public function active()
    {
        $status = '1';

        $brands = Brand::findOrFail($this->Status);
        $brands->status = $status;

        $brands->save();

        session()->flash('success', __('brand successfully Active'));

    }

    public function inactive()
    {

        $status = '0';

        $brands = Brand::findOrFail($this->Status);
        $brands->status = $status;

        $brands->save();

        session()->flash('success', __('brand successfully Inactive'));

    }


    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditBrand($id)
    {
        $this->brand_id = $id;
    }

    public function CreateBrand()
    {
        $this->create_brand = rand(0, 10000);
    }

    public function refreshModal()
    {
        $this->brand_id = "";
        $this->create_brand = "";
    }


    public function delete()
    {

        $brands = Brand::findOrFail($this->deleteId);

        if (!auth()->user()->can('brands delete')) {
            $this->emit('error', __('Brand does not have the right permissions.'));
            return false;
        }

        $brands->delete();
        $this->emit('success', __('Brand successfully Deleted.'));

    }

    public function render()
    {
        $brands = Brand::query();


        if (!auth()->user()->hasRole('Admin')) {
            $brands = $brands->whereHas('brands_stores', function ($q) {
                return $q->whereIn('store_id', auth()->user()->stores()->pluck('id')->toArray());
            });
        }

        if ($this->store_id) {
            $brands = $brands->whereHas('brands_stores', function ($q) {
                return $q->where('store_id', $this->store_id);
            });
        }

        if ($this->name) {
            $brands = $brands->where('name', 'LIKE', '%' . $this->name . '%');
        }
        if ($this->description) {
            $brands = $brands->where('description', 'LIKE', '%' . $this->description . '%');
        }

        if (array_key_exists($this->status, Brand::statusList(false))) {
            $brands = $brands->where('status', $this->status);
        }


        $brands = $brands->orderBy('created_at', "DESC")->paginate(10);
        return view('livewire.admin.brands.brands', compact('brands'))->layout('livewire.admin.app');
    }

}
