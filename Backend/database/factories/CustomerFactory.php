<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
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
            'name' => $this->faker->lastName(),
            'firstname' => $this->faker->firstname(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->city(),
            'sex' => $this->faker->randomElement([0, 1]),
            'user_id' => User::all()->random()->id,
        ];
    }
}
