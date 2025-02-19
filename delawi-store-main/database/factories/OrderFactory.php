<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_number'  => $this->faker->numberBetween(1,99),
            'note'  => $this->faker->text(15),
            'coupon'  => $this->faker->numberBetween(1,99),
            'discount'  => $this->faker->numberBetween(1,99),
            'total'  => $this->faker->numberBetween(1,9999),
            'user_id' => function () {
                return User::factory()->create()->id;

            },


        ];
    }
}
