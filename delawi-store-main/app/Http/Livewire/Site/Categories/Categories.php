<?php

namespace App\Http\Livewire\Site\Categories;

use App\Models\Category;
use App\Models\Page;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $categories, $user = ['country_id' => 0, 'city_id' => 0, 'category_id' => 0, 'brand_id' => 0], $countries = [], $cities, $user_country_code , $brands = [], $rate = 0, $page_data;

    public function changeRate($rate)
    {
        $this->rate = $rate;
    }

    public function mount()
    {
        $this->page_data = Page::where('slug', 'categories')->first();
    }

    public function render()
    {

        $categories = Category::where('status', '1');

        $this->categories = $categories->orderBy('created_at', "DESC")->get();

        return view('livewire.' . env('THEME') . '.categories.categories')->layout('livewire.' . env('THEME') . '.app');
    }

}
