<?php

namespace App\Http\Livewire\Admin\Ads;

use App\Models\Ad;
use App\Models\Store;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Ads extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];


    public $search, $store_id, $title, $description, $deleteId, $ad_id, $image, $imageTemp, $Status, $status, $create_ad;

    public function search()
    {

    }
    public function mount($store_id = null)
    {
        $this->store_id = $store_id;
        if (array_key_exists(request('status'), Ad::statusList(false))) {
            $this->status = request('status');
        }

    }


    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditAd($id)
    {
        $this->ad_id = $id;
    }

    public function CreateAd()
    {
        $this->create_ad = rand(0, 10000);
    }

    public function Status($id)
    {
        $this->Status = $id;
    }


    public function refreshModal()
    {
        $this->ad_id = "";
        $this->create_ad = "";
    }


    public function delete()
    {

        $ads = Ad::findOrFail($this->deleteId);

        if (!auth()->user()->can('ads delete')) {
            $this->emit('error', __('Ad does not have the right permissions.'));
            return false;
        }

        $ads->delete();
        $this->emit('success', __('Ad successfully Deleted.'));

    }

    public function acceptable()
    {
        $status = '1';

        $ads = Ad::findOrFail($this->Status);
        $ads->status = $status;

        $ads->save();
        session()->flash('success', __('Ad successfully Accepted'));

    }

    public function disabled()
    {

        $status = '2';

        $ads = Ad::findOrFail($this->Status);
        $ads->status = $status;

        $ads->save();

        session()->flash('success', __('Ad successfully Disabled'));

    }

    public function render()
    {
        $ads = Ad::query();

        if ($this->store_id) {
            $ads = $ads->whereHas('store', function ($q) {
                return $q->where('id', $this->store_id);
            });
        }
        if ($this->title) {
            $ads = $ads->where('title', 'LIKE', '%' . $this->title . '%');
        }

        if ($this->description) {
            $ads = $ads->where('description', 'LIKE', '%' . $this->description . '%');
        }

        if (array_key_exists($this->status, Ad::statusList(false))) {
            $ads = $ads->where('status', $this->status);
        }


        if (!auth()->user()->hasRole('Admin')) {
            $ads = $ads->whereHas('store', function ($q) {
                return $q->whereIn('store_id', auth()->user()->stores()->pluck('id')->toArray());
            });
        }

        $ads = $ads->orderBy('created_at', "DESC")->paginate(10);
        return view('livewire.admin.ads.ads', compact('ads'))->layout('livewire.admin.app');
    }

}
