<?php

namespace App\Http\Livewire\Site;

use App\Models\ProductImage;
use Livewire\Component;

class BannerShow extends Component
{
    public function render()
    {
        $product_images = ProductImage::orderBy('created_at', "DESC")->paginate(2);

        return view('livewire.'.env('THEME').'.banner-show', compact('product_images'))->layout('livewire.'.env('THEME').'.app');
    }
}
