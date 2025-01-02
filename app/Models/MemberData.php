<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberData extends Model
{
    /** @use HasFactory<\Database\Factories\MemberDataFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'gender',
        'school',
        'belt',
        'medal',
        'photo',
    ];
}
