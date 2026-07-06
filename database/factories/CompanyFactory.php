<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company_name' => fake()->company(),
            'address' => fake()->address(),
            'contact_person' => fake()->name(),
            'phone_number' => fake()->phoneNumber(),
            'email' => fake()->companyEmail(),
            'status' => true,
        ];
    }
}
