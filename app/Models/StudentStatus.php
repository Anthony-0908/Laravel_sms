<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentStatus extends Model
{
    public function students() 
    {
        return $this->hasMany(student::class, 'status_id');
    }
}
