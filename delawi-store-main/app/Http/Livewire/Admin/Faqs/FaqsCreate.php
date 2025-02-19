<?php

namespace App\Http\Livewire\Admin\Faqs;

use App\Models\Faq;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class FaqsCreate extends Component
{
    use WithFileUploads;

    public $page;


    public function store()
    {
        $this->validate([
            'page.order' => 'numeric',
        ]);

        $this->page['slug'] = Str::slug($this->page['title']['en']).'-'.time();

        $page = Faq::create($this->page);

        $this->emit('success', __('Page successfully Added.'));
        $this->page = [];
    }


    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');

        return view('livewire.admin.faqs.faqs-create')->layout('livewire.admin.app');
    }


}
