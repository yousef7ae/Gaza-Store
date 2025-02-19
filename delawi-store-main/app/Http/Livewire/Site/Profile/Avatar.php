<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Avatar extends Component
{
    use WithFileUploads;

    protected $listeners = ['refreshAvatar' => '$refresh'];

    public $photo, $imageTemp;


    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|mimes:jpeg,png',
        ]);

        $path = $this->photo->store('users/images/' . $this->id);

        $user = User::where('id', auth()->id())->first();
        $user->image = $path;
        $user->save();
        $this->emit('refreshAvatar');

    }

    public function render()
    {
        return view('livewire.'.env('THEME').'.profile.avatar')->layout('livewire.'.env('THEME').'.app');
    }
}
