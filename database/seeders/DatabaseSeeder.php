<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            StudentStatusSeeder::class,
        ]);

        // Create an admin/test user manually
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'testUser@yopmail.com',
            'password'=> Hash::make('Password@123'),
        ]);

        // Create 20 students, each with their own user
        Student::factory()->count(20)->create();
    }
}
