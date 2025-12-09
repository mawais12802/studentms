<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name','email','age','school_class_id'];

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id');
    }
}
