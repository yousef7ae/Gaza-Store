<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Page;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class PagesEdit extends Component
{
    use WithFileUploads;

    public $page, $image, $imageTemp;

    function mount($id)
    {
        $this->page = Page::findOrFail($id);
        $this->page = $this->page->toArray();
        $this->image = $this->page['image'];
    }

    public function update()
    {

        $this->validate([
            'page.title' => 'required|array',
            'page.description' => '',
            'page.image' => '',

        ]);

        if ($this->page['order']) {
            $this->validate([
                'page.order' => 'numeric',
            ]);
        }

        if ($this->page['image']) {
            $this->validate([
                'image' => ''
            ]);

        }

        if ($this->imageTemp) {
            $this->page['image'] = $this->imageTemp->store('pages');
        } else {
            unset($this->page['image']);
        }

        $page = Page::findOrFail($this->page['id']);

        $this->page['slug'] = $page->slug ? $page->slug : Str::slug($this->page['title']['en']).'-'.time();

        $page->update($this->page);
        $this->emit('success', __('Page successfully update.'));

    }

    public function render()
    {
        return view('livewire.admin.pages.pages-edit')->layout('livewire.admin.app');
    }

}
