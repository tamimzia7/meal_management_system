<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\DailyMeal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DailyMeal>
 */
class DailyMealFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'meal_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'breakfast_meal' => fake()->numberBetween(10, 100),
            'lunch_meal' => fake()->numberBetween(20, 150),
            'dinner_meal' => fake()->numberBetween(15, 120),
            'remarks' => fake()->optional()->sentence(),
        ];
    }
}
