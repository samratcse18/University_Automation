<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallTotalStudent extends Model
{
    use HasFactory;
    protected $table = "hall_total_students";
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
}
