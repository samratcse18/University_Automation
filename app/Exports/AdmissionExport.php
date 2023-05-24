<?php

namespace App\Exports;

use App\Models\Admission;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AdmissionExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $session;
    function __construct($sess)
    {
        $this->session=$sess;
    }

    public function collection()
    {
        return collect(Admission::getAllData($this->session));
    }

    public function headings():array{
        return[
            'Id',
            'Roll_No',
            'Department',
            'Session',
        ];
    }
}
