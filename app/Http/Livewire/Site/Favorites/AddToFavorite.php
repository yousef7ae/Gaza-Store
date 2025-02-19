<?php

namespace App\Http\Livewire\Site\Favorites;

use App\Models\Favorite;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class AddToFavorite extends Component
{

    public $product, $is_favorite,$string;

    function mount($product_id,$string = false)
    {
        $this->string = $string;

        if (is_object($product_id)) {
            $this->product = $product_id;
        } else {
            $this->product = Product::find($product_id);
        }

    }

    function add($product_id)
    {
        $product = Product::find($product_id);

        if (auth()->check() or auth('sanctum')->check()) {
            if (auth('sanctum')->check()) {
                Favorite::updateOrCreate(['product_id' => $product->id, 'user_id' => auth('sanctum')->id()]);
            } else {
                Favorite::updateOrCreate(['product_id' => $product->id, 'user_id' => auth()->id()]);
            }
        } else {
            if(request()->header('device_id')) {
                Favorite::updateOrCreate(['product_id' => $product->id, 'device_id' => request()->header('device_id')]);
            }else{
                Favorite::updateOrCreate(['product_id' => $product->id, 'device_id' => session()->getId()]);
            }
        }

        $this->emit('success', __('Product Successfully Added To Favorites'));
        $this->emit('refreshFavoriteShow');
        $this->emit('refreshFavorites');
    }

    public function delete()
    {

        if (auth()->check() or auth('sanctum')->check()) {
            if (auth('sanctum')->check()) {
                Favorite::where(['product_id' => $this->product['id'], 'user_id' => auth('sanctum')->id()])->forceDelete();
            } else {
                Favorite::where(['product_id' => $this->product['id'], 'user_id' => auth()->id()])->forceDelete();
            }
        } else {
            if(request()->header('device_id')) {
                Favorite::where(['product_id' => $this->product['id'], 'device_id' => request()->header('device_id')])->forceDelete();
            }else{
                Favorite::where(['product_id' => $this->product['id'], 'device_id' => session()->getId()])->forceDelete();
            }
        }

        $this->emit('success', __('Product Successfully Remove From Favorites.'));

        return $this->redirect(route('favorites'));

    }

    public function render()
    {
        $this->is_favorite = $this->product->is_favorite;
        return view('livewire.'.env('THEME').'.favorites.add-to-favorite')->layout('livewire.'.env('THEME').'.app');
    }

}
