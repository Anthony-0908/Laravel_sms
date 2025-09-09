<?php

namespace App\Services;

use App\Models\StudentStatus;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class StudentService
{
    protected $studentStatus;
    protected $student;
    protected $user;
    /**
     * Create a new class instance.
     */
    public function __construct(Studentstatus $studentStatus, Student $student , User $user) 
    {
        $this->studentstatus = $studentStatus;
        $this->student = $student;
        $this->user = $user;
    }

    public function getAllStudents()
    {
        return $this->student->with('user', 'status')->get();   
    }

    public function getStudentStatus()
    {
        return $this->studentstatus->pluck('name', 'id');
    }

    public function studentCreate(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Create user
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'address'  => $data['address'] ?? null,
                'phone_no' => $data['phone_no'] ?? null,
                'birthdate'=> $data['birthdate'],
                'password' => bcrypt($data['password']),
            ]);

            // Create student
            $student = Student::create([
                'user_id'    => $user->id,
                'student_id' => $data['student_id'],
                'grade'      => $data['grade'],
                'section'    => $data['section'],
                'enrollment_date' => $data['enrollment_date'],
                'status_id'  => $data['status_id'],
            ]);

            return [$user, $student];
        });
    }
}
?>