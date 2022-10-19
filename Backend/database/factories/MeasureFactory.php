<?php

namespace Database\Factories;

use App\Models\Orders;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Measure>
 */
class MeasureFactory extends Factory
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
            'shoulder' => $this->faker->numberBetween(10, 100),
            'lengtmh_sleeve' => $this->faker->numberBetween(10, 100),
            'round_sleeve' => $this->faker->numberBetween(10, 100),
            'chest' => $this->faker->numberBetween(10, 100),
            'length_dress' => $this->faker->numberBetween(10, 100),
            'neckline' => $this->faker->numberBetween(10, 100),
            'middle_front' => $this->faker->numberBetween(10, 100),
            'broad_back' => $this->faker->numberBetween(10, 100),
            'breast_gap' => $this->faker->numberBetween(10, 100),
            'waist_size' => $this->faker->numberBetween(10, 100),
            'waist_circumference' => $this->faker->numberBetween(10, 100),
            'buttock_circumference' => $this->faker->numberBetween(10, 100),
            'chest_height' => $this->faker->numberBetween(10, 100),
            'length_waist' => $this->faker->numberBetween(10, 100),
            'bodice_length' => $this->faker->numberBetween(10, 100),
            'dress_length' => $this->faker->numberBetween(10, 100),
            'knee_length' => $this->faker->numberBetween(10, 100),
            'skirt_length' => $this->faker->numberBetween(10, 100),
            'pants_length' => $this->faker->numberBetween(10, 100),
            'thighs' => $this->faker->numberBetween(10, 100),
            'knee_circumference' => $this->faker->numberBetween(10, 100),
            'down' => $this->faker->numberBetween(10, 100),
            'order_id' => Orders::all()->random()->id,
        ];
    }
}
