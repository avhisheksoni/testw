<?php

use Illuminate\Database\Seeder;

class company_party extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_party')->insert([
            'company_id' => '1',
            'company_party' => 'Central-Party',
            'party_code' => 'CP1111',
            
        ]);
    }
}
