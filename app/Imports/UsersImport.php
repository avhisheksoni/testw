<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection,WithHeadingRow
{
    public function collection(Collection $rows)
    {

        //dd($rows);
        foreach ($rows as $items) {
            
            dd($items['department']);
        }
    }
}
