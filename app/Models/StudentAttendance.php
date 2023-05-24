<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'dept_name',
        'course_id',
        'attendance_status',
        'teacher_id',
    ];
}
