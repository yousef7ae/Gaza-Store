<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
//            'name' => $this->faker->text(20),
            'value'  => $this->faker->numberBetween(1,99),
            'price'  => $this->faker->numberBetween(1,999),
            'unit'  => $this->faker->numberBetween(1,600),
            'user_id' => function () {
                return User::factory()->create()->id;

            },
            'product_id' => function () {
                return Product::factory()->create()->id;

            },

        ];
    }
}
