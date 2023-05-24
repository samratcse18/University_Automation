<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admission;

class Admission extends Model
{
    use HasFactory;
    public static function getAllData($session)
    {
        $select=Admission::where([['Session', '=', $session],['status', '=', 'active']])
        ->select('id','RollNumber','Subject','Session')
        ->get()->toArray();
        return $select;
    }
}
