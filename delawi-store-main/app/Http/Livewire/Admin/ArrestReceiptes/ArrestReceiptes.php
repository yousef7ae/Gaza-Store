<?php

namespace App\Http\Livewire\Admin\ArrestReceiptes;

use App\Models\ArrestReceipt;
use Livewire\Component;

class ArrestReceiptes extends Component
{
    public $create_id , $edit_id , $deleteId;

    protected $listeners = ['refreshModal'];

    public function mount(){
    }

    public function CreateArrestReceipt(){
        $this->create_id = rand(0,10000);
    }

    public function EditArrestReceipt($id){
        $this->edit_id = $id;
    }

    public function deleteId($id){
        $this->deleteId = $id;
    }

    public function delete(){
        $arrest_receipt = ArrestReceipt::findOrFail($this->deleteId);
        $arrest_receipt->delete();
        $this->emit('success', __('Arrest Receipt successfully Deleted.'));
    }

    public function refreshModal(){
        $this->edit_id = "";
        $this->create_id = "";
    }


    public function render()
    {
        $arrest_receipts =  ArrestReceipt::get();
        return view('livewire.admin.arrest-receiptes.arrest-receiptes',compact('arrest_receipts'))
            ->layout('livewire.admin.app');
    }

}
