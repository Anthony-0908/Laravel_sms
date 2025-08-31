<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassCourse extends Model
{   
    protected $fillable = [ 
        'subject_id',
        'teacher_id',
        'semester',
        'year',
        'start_time',
        'end_time',
    ];
    

    public function subjects() 
    {
        return $this->hasOne(Subjects::class);
    }
}
