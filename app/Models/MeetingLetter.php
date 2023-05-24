<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingLetter extends Model
{
    use HasFactory;
    protected $fillable=[
        'm_name','m_date','m_time','m_building_name','m_room_number','dept_name',
    ];
}
