<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionRoll extends Model
{
    use HasFactory;
    protected $table="admission_rolls";
    protected $fillable =['admission_roll','email'];
}
