<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected static function booted()
    {
        static::creating(function ($student) {
            $student->user_id = auth()->id();
        });
    }

}
