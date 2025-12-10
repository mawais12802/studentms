<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $fillable = ['name','email','age','school_class_id'];

    public function schoolClass(): BelongsTo
    {
        // 'school_class_id' is the foreign key by default
        return $this->belongsTo(SchoolClass::class);
    }
}
