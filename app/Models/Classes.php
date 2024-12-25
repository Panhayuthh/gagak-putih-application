<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    /** @use HasFactory<\Database\Factories\ClassesFactory> */
    use HasFactory;

    protected $guarded = [];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
