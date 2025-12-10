<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
   protected static function booted()
    {
        static::creating(function ($class) {
            $class->user_id = auth()->id();
        });
    }

}