<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\RoleSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
            $this->call([
            RoleSeeder::class,
            StudentStatusSeeder::class,
        ]);
        // User::factory(1)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'testUser@yopmail.com',
            'password'=> Hash::make('Password@123'),
        ]);
    }
}
