<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $fillable = ['name', 'capacity', 'user_id'];

    protected static function booted()
    {
        static::creating(function ($class) {
            $class->user_id = auth()->id();
        });
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'school_class_id');
    }
}