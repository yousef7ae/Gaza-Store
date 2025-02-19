<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Page;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class PagesCreate extends Component
{
    use WithFileUploads;

    public $page, $image, $imageTemp;


    public function store()
    {
        $this->validate([
            'page.image' => '',
            'page.order' => 'numeric',
        ]);


        if ($this->imageTemp) {
            $this->page['image'] = $this->imageTemp->store('pages');
        } else {
            unset($this->page['image']);
        }

        $this->page['slug'] = Str::slug($this->page['title']['en']).'-'.time();

        $page = Page::create($this->page);

        $this->emit('success', __('Page successfully Added.'));
        $this->page = [];
    }


    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');

        return view('livewire.admin.pages.pages-create')->layout('livewire.admin.app');
    }


}
