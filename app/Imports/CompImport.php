<?php

namespace App\Imports;

use App\Companyexcel;
use Maatwebsite\Excel\Concerns\ToModel;

class CompImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Companyexcel([
            //
        ]);
    }
}
php artisan make:import CompImport --model=Companyexcel
