<?php

namespace App\Http\Livewire\Site\Profile;

use Illuminate\Support\Facades\Hash;
use App\Models\Page;
use Livewire\Component;

class Settings extends Component
{
    public $page, $user;

    public function update()
    {
//        dd($this->user['password']);
        $this->validate([
            'user.password' => 'required',
            'user.new_password' => 'required|max:255',
        ]);

        if(Hash::check($this->user['password'],auth()->user()->password)){
            if($this->user['password'] == $this->user['new_password']){
                $this->emit('alertSuccess', __("يجب أن تكون كلمة المرور الجديدة مختلفة عن كلمة المرور الحالية"));
            }
            $user = auth()->user();
            $user->password = bcrypt($this->user['new_password']);
            $user->save();
            $this->emit('alertSuccess', __("Password changed successfully"));
        }else{
            $this->emit('alertSuccess', __("كلمة المرور الحالية ليست صحيحة .. يُرجى المحاولة مرة أخرى"));
        }



//        dd("dd");
    }

    public function mount()
    {
        $this->page = Page::where('slug', 'Profile')->first();
    }

    public function render()
    {
        return view('livewire.'.env('THEME').'.profile.settings')->layout('livewire.'.env('THEME').'.app');
    }
}
