<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\DailyMeal;
use App\Models\MealRate;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'phone' => '01712345678',
            'role' => 'super_admin',
            'status' => true,
        ]);

        User::factory()->create([
            'name' => 'Manager User',
            'email' => 'manager@admin.com',
            'password' => bcrypt('password'),
            'phone' => '01712345679',
            'role' => 'manager',
            'status' => true,
        ]);

        User::factory()->create([
            'name' => 'Staff User',
            'email' => 'staff@admin.com',
            'password' => bcrypt('password'),
            'phone' => '01712345670',
            'role' => 'staff',
            'status' => true,
        ]);

        MealRate::create([
            'rate' => 120.00,
            'created_by' => $superAdmin->id,
        ]);

        Company::factory(5)->create();

        $companies = Company::all();

        foreach ($companies as $i => $company) {
            User::factory()->create([
                'name' => "Company Person - {$company->company_name}",
                'email' => "company{$i}@admin.com",
                'password' => bcrypt('password'),
                'phone' => '0171234567'.($i + 1),
                'role' => 'company_person',
                'company_id' => $company->id,
                'status' => true,
            ]);
        }

        DailyMeal::factory(20)->create();
    }
}
