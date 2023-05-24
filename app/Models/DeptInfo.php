<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeptInfo extends Model
{
    use HasFactory;
    protected $fillable=[
        'dept_name',
        'dept_nameB',
        'dept_nameE',
        'dept_head_nameB',
        'dept_head_nameE',
        'dept_head_signature',
        'dept_head',
        'dept_headB',
        
    ];
    
}
