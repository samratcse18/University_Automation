<?php

namespace App\Imports;

use App\Models\AdmissionRoll;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\SkipsOnError;

class admissionRollImport implements ToModel,SkipsOnError
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AdmissionRoll([
            "admission_roll"=>$row[0],
            "email"=>$row[1],
        ]);

    }
    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }
}
