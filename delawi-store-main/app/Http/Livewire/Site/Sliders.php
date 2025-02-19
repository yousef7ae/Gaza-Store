<?php

namespace App\Http\Livewire\Site;

use App\Models\Coupon;
use App\Models\Slider;
use Livewire\Component;

class Sliders extends Component
{
    public $sliders , $copone;

    public function mount()
    {

        $this->sliders = Slider::where('status', '1')->whereNull('user_id')->limit(5)->orderBy('created_at', "DESC")->get();
        $this->copone = Coupon::get();

    }

    public function render()
    {

        return view('livewire.'.env('THEME').'.slider')->layout('livewire.'.env('THEME').'.app');
    }
}
