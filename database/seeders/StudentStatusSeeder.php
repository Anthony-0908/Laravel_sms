<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ✅ Import DB facade

class StudentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('student_statuses')->insert([
            ['name' => 'Enrolled'],
            ['name' => 'Graduated'],
            ['name' => 'Transferred'],
            ['name' => 'Dropped Out'],
        ]);
    }
}
