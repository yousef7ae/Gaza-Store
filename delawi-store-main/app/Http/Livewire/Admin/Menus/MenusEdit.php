<?php

namespace App\Http\Livewire\Admin\Menus;

use App\Models\Submenu;
use App\Models\Menu;
use Livewire\Component;
use Livewire\WithFileUploads;

class MenusEdit extends Component
{
    use WithFileUploads;

    public $menu, $image, $imageTemp, $submenus = [], $q_deletes = [], $submenusList = [];

    function mount($id)
    {

        $menu = Menu::findOrFail($id);
        $this->menu = $menu->toArray();
    }

    public function removeSubmenu($submenu_id)
    {
        unset($this->menu['submenus'][$submenu_id]);
    }

    function addSubmenu()
    {

        $this->menu['submenus'][] = [
            'name' => "",
            'url' => "",
            'order' => "",
        ];

    }

    public function update()
    {
        $this->validate([
            'menu.title.*' => 'required',
        ]);

        $menu = Menu::findOrFail($this->menu['id']);

        $menu->title = $this->menu['title'];
        $menu->submenus = $this->menu['submenus'];
        $menu->order = $this->menu['order'];
        $menu->save();

        $this->emit('success', __('Menu successfully update.'));

    }


    public function render()
    {

        return view('livewire.admin.menus.menus-edit')->layout('livewire.admin.app');
    }

}
