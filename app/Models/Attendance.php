<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable  = [
        'date',
        'status',
        'student_id',
    ];
}
