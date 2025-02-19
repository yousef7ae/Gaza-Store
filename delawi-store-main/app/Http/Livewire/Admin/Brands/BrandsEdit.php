<?php

namespace App\Http\Livewire\Admin\Brands;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithFileUploads;

class BrandsEdit extends Component
{
    use WithFileUploads;

    public $brand, $users, $image, $imageTemp, $brands;

    function mount($id)
    {

        $brand = Brand::findOrFail($id);
        $this->brand = $brand->toArray();

        if (!auth()->user()->hasRole('Admin')) {
            $this->brands = Brand::whereNotNull('name')->whereNull('user_id')->where('status', 1)->get();
        }

    }

    public function update()
    {
        $this->validate([
            'brand.description' => 'string|max:2000',
            'brand.image' => '',
        ]);


        if (auth()->user()->hasRole('Admin')) {
            $this->validate(['brand.name' => 'required|string',]);
        }


        if ($this->brand['image']) {
            $this->validate([
                'image' => ''
            ]);
        }

        if ($this->imageTemp) {
            $this->brand['image'] = $this->imageTemp->store('Brands');
        } else {
            unset($this->brand['image']);
        }


        if (!auth()->user()->hasRole('Admin')) {
            $this->brand['user_id'] = auth()->id();
        }
        $brand = Brand::findOrFail($this->brand['id']);
        $brand->update($this->brand);
        $this->emit('success', __('Brand successfully Update.'));
    }


    public function render()
    {
        return view('livewire.admin.brands.brands-edit')->layout('livewire.admin.app');
    }
}
