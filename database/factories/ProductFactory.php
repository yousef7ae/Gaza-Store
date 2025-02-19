<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(20),
            'description'  => $this->faker->text(50),
            'price'  => $this->faker->numberBetween(1,999),
            'code'  => $this->faker->numberBetween(10000,99999999),
            'user_id' => function () {
                return User::factory()->create()->id;


            },
        ];
    }
}
