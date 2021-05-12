<?php

namespace App\Exports;

use App\Comp;
use Maatwebsite\Excel\Concerns\FromCollection;

class CompExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Comp::all();
    }
}
