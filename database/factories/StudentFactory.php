<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'student_id' => $this->faker->unique()->numerify('STU###'),
            'grade' => $this->faker->randomElement(['7', '8', '9', '10']),
            'section' => $this->faker->randomLetter(),
            'enrollment_date' => $this->faker->date(),
            'status_id'=> 1,
            // Assuming 'user_id' is a foreign key to the 'users' table
            'user_id' => \App\Models\User::factory(), 
        ];
    }
}
