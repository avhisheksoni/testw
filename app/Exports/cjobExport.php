<?php

namespace App\Exports;

use App\cjob;
use Maatwebsite\Excel\Concerns\FromCollection;

class cjobExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return cjob::all();
    }
}
