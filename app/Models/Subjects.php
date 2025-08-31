<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    
    protected $fillable = [
        'course_name',
        'course_code',
        'course_description',
    ];



    public function class()
    {
        return $this->belongsTo(ClassCourse::class);
    }
}
