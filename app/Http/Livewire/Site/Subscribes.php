<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use App\Models\Subscribe;

class Subscribes extends Component
{


    public $email;

    public function store()
    {
        $this->validate([

            'email' => 'required|email|unique:subscribes,email',
        ]);

        $subscribe = new Subscribe();
        $subscribe->email = $this->email;


        $subscribe->save();


        session()->flash('success', 'تم الاشتراك ');

        return redirect()->route('home');
    }


    public function render()
    {
        return view('livewire.'.env('THEME').'.subscribes');
    }
}
