<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderdetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Orderdetail::class;

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
            'discount'  => $this->faker->numberBetween(1,99),
            'total'  => $this->faker->numberBetween(1,9999),
            'user_id' => function () {
                return User::factory()->create()->id;

            },
            'order_id' => function () {
                return Order::factory()->create()->id;

            },
            'product_name' => function () {
                return Product::factory()->create()->name;

            },



        ];
    }
}
