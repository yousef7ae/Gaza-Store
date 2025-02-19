<?php

namespace App\Http\Livewire\Admin\Faqs;

use App\Models\Faq;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class FaqsEdit extends Component
{
    use WithFileUploads;

    public $page;

    function mount($id)
    {
        $this->page = Faq::findOrFail($id);
        $this->page = $this->page->toArray();
    }

    public function update()
    {

        $this->validate([
            'page.title' => 'required|array',
            'page.description' => '',

        ]);

        if ($this->page['order']) {
            $this->validate([
                'page.order' => 'numeric',
            ]);
        }


        $page = Faq::findOrFail($this->page['id']);

        $this->page['slug'] = $page->slug ? $page->slug : Str::slug($this->page['title']['en']).'-'.time();

        $page->update($this->page);
        $this->emit('success', __('Page successfully update.'));

    }

    public function render()
    {
        return view('livewire.admin.faqs.faqs-edit')->layout('livewire.admin.app');
    }

}
