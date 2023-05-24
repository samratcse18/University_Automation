<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterSend extends Model
{
    use HasFactory;
    protected $fillable=[
        'send_by','letter_id',
    ];
}
