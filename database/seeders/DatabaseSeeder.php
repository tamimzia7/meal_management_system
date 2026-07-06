<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\DailyMeal;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'phone' => '01712345678',
            'role' => 'admin',
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

        Company::factory(5)->create();

        DailyMeal::factory(20)->create();
    }
}
