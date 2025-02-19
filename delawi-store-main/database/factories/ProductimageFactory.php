<?php

namespace Database\Factories;

use App\Models\Productimage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductimageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Productimage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(10),
            'image' => $this->faker->image('public/storage/ProductImages',640,480, null, false),

        ];
    }
}
