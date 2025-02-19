<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cart::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'qty'  => $this->faker->numberBetween(1,99),
            'price'  => $this->faker->numberBetween(1,999),
            'total'  => $this->faker->numberBetween(1,9999),
            'user_id' => function () {
                return User::factory()->create()->id;

            },
            'product_id' => function () {
                return Product::factory()->create()->id;

            },

        ];
    }
}
