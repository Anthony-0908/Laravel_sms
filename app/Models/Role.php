<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Spatie
{
    protected $fillable = ['name'];
    public function users() 
    {
        return $this->hasMany(users::class);
    }
}
