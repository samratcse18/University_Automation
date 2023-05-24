<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoutine extends Model
{
    use HasFactory;
    protected $fillable = [
        'routine_info_id',
        'routine_day',
        'class_room',
        'class_end_time',
        'class_time',
    ];
}
