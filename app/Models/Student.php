<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

      protected $fillable = [
        'student_id',
        'grade',
        'section',
        'enrollment_date',
        'status_id',
        'gender',
        'user_id',
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status() 
    {
        return $this->belongsTo(StudentStatus::class);
    }
}
