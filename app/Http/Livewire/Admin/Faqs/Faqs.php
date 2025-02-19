<?php

namespace App\Http\Livewire\Admin\Faqs;

use App\Models\Faq;
use Livewire\Component;
use Livewire\WithPagination;

class Faqs extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];


    public $search, $title, $description, $deleteId, $faq_id, $image, $imageTemp;

    public function search()
    {

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditFaq($id)
    {
        $this->faq_id = $id;
    }

    public function refreshModal()
    {
        $this->faq_id = "";
    }


    public function delete()
    {

        $pages = Faq::findOrFail($this->deleteId);

        if (!auth()->user()->can('pages delete')) {
            $this->emit('error', __('Page does not have the right permissions.'));
            return false;
        }
        $pages->delete();
        $this->emit('success', __('Page successfully Deleted.'));
    }

    public function render()
    {
        $pages = Faq::query();

        if ($this->title) {
            $pages = $pages->where('title', 'LIKE', '%' . $this->title . '%');
        }

        if ($this->description) {
            $pages = $pages->where('description', 'LIKE', '%' . $this->description . '%');
        }

        $pages = $pages->orderBy('order', "ASC")->paginate(10);
        return view('livewire.admin.faqs.faqs', compact('pages'))->layout('livewire.admin.app');
    }

}
