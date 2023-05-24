<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Student extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable,HasRoles;

    protected $fillable = [
        'fname','lname',  'email','dept','student_id','admission_roll','session','phone','password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = "students";
    public function HallTotalStudent()
    {
        return $this->hasOne('App\Models\HallTotalStudent');
    }
}