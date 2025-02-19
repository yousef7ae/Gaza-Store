<?php

namespace App\Http\Livewire\Admin\Menus;

use App\Models\Menu;
use Livewire\Component;
use Livewire\WithPagination;

class Menus extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $search, $title, $deleteId, $menu_id, $image, $imageTemp;

    public function search()
    {

    }

    function mount()
    {

    }


    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function EditMenu($id)
    {
        $this->menu_id = $id;
    }


    public function refreshModal()
    {
        $this->menu_id = "";
    }


    public function delete()
    {
        $menus = Menu::findOrFail($this->deleteId);

        if (!auth()->user()->can('menus delete')) {
            $this->emit('error', __('Menu does not have the right permissions.'));
            return false;
        }

        $menus->delete();
        $this->emit('success', __('Menu successfully Deleted.'));
    }

    public function render()
    {
        $menus = Menu::query();

        if ($this->title) {
            $menus = $menus->where('title', 'LIKE', '%' . $this->title . '%');
        }

        $menus = $menus->orderBy('created_at', "DESC")->paginate(10);
        return view('livewire.admin.menus.menus', compact('menus'))->layout('livewire.admin.app');
    }

}
