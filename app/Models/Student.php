<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $fillable = ['name', 'email', 'age', 'school_class_id', 'user_id'];

    protected static function booted()
    {
        static::creating(function ($student) {
            $student->user_id = auth()->id();
        });
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id');
    }
}
