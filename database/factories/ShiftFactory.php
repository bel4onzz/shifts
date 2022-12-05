<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shift>
 */
class ShiftFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date' => fake()->dateTime(),
            'employee' => fake()->name(),
            'employer' => fake()->name(),
            'hours' => fake()->randomNumber(),
            'rate_per_hours' => "£20.00",
            'shift_type' => 'Day',
            'taxable' => 'Yes',
            'status' => 'Complete',
            'paid_at' => fake()->dateTime(),
        ];
    }
}
