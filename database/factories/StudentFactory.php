<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Student; // 👈 import the model

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'student_id' => $this->faker->unique()->numerify('STU###'),
            'grade' => $this->faker->randomElement(['7', '8', '9', '10']),
            'section' => $this->faker->randomLetter(),
            'enrollment_date' => $this->faker->date(),
            'status_id' => 1,
            'user_id' => User::factory(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Student $student) {
            $student->user->assignRole('student');
        });
    }
}