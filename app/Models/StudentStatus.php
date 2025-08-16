<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentStatus extends Model
{
      protected $fillable = [
         'name'
    ];

    public function students() 
    {
        return $this->hasMany(student::class);
    }
}
