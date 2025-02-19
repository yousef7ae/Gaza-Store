<?php

namespace App\Http\Livewire\Admin;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class Contacts extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshModal'];

    public $email, $name, $subject, $message, $deleteId, $search;

    public function search()
    {

    }

    public function refreshModal()
    {

    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {

        $brands = Contact::findOrFail($this->deleteId);

        if (!auth()->user()->can('contacts delete')) {
            $this->emit('error', __('Contact does not have the right permissions.'));
            return false;
        }

        $brands->delete();
        $this->emit('success', __('Contact successfully Deleted.'));

    }

    public function render()
    {
        $contacts = Contact::query();

        if ($this->name) {
            $contacts = $contacts->where('name', 'LIKE', '%' . $this->name . '%');
        }

        if ($this->email) {
            $contacts = $contacts->where('email', 'LIKE', '%' . $this->email . '%');
        }

        if ($this->subject) {
            $contacts = $contacts->where('subject', 'LIKE', '%' . $this->subject . '%');
        }

        if ($this->message) {
            $contacts = $contacts->where('message', 'LIKE', '%' . $this->message . '%');
        }

        $contacts = $contacts->orderBy('created_at', "DESC")->paginate(20);

        return view('livewire.admin.contacts', compact('contacts'))->layout('livewire.admin.app');
    }

}
