<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    
    public $timestamps = false; // keep only if timestamps not present
    protected $fillable = ['name', 'email', 'age', 'city'];
}

