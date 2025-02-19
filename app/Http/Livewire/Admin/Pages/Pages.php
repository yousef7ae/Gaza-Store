<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithPagination;

class Pages extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];


    public $search, $title, $description, $deleteId, $page_id, $image, $imageTemp;

    public function search()
    {

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditPage($id)
    {
        $this->page_id = $id;
    }

    public function refreshModal()
    {
        $this->page_id = "";
    }


    public function delete()
    {

        $pages = Page::findOrFail($this->deleteId);

        if (!auth()->user()->can('pages delete')) {
            $this->emit('error', __('Page does not have the right permissions.'));
            return false;
        }
        $pages->delete();
        $this->emit('success', __('Page successfully Deleted.'));
    }

    public function render()
    {
        $pages = Page::query();

        if ($this->title) {
            $pages = $pages->where('title', 'LIKE', '%' . $this->title . '%');
        }

        if ($this->description) {
            $pages = $pages->where('description', 'LIKE', '%' . $this->description . '%');
        }

        $pages = $pages->orderBy('order', "ASC")->paginate(10);
        return view('livewire.admin.pages.pages', compact('pages'))->layout('livewire.admin.app');
    }

}
