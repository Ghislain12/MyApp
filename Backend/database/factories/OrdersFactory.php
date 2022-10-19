<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\ModelImage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class OrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => Str::uuid(),
            'order_date' => $this->faker->dateTimeBetween('-2 weeks', 'now'),
            'price' => $this->faker->numerify('####'),
            'delivery_date' => $this->faker->dateTimeBetween('now', '+2 weeks'),
            'model_id' => ModelImage::all()->random()->id,
            'customer_id' => Customer::all()->random()->id
        ];
    }
}
