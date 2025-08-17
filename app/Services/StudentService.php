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
}
?>