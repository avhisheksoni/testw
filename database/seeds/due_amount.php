<?php

use Illuminate\Database\Seeder;

class due_amount extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('due_amount')->insert([
            'company_id' => '1',
            'tender_no' => '4',
            'tender_date' => '2020-04-13',
            'name_of_work' => 'yryr',
            'tender_emd_fdr' => 12113,
            'maturity_amount' => 1000,
            'date_of_fdr' => '2020-04-13',
            'fdr_interest_rate' => '10',
            'place' => 'sector-765 bhavnagar',
            'division' => 'BL-123 Vijay Nagar Indore',
            'value_of_work' => 100000,
            'acceptance_letter_no' => '9865',
            'accepted_rate' => 100,
            'period_of_contract' => '2',
            'bg_no' => '9865744152',
            'bg_expiry_date' => '2020-04-29',
            'bg_fdr_no' => '44',
            'bg_fdr_date' => '2020-04-26',
            'bg_fdr_amount' => 100000,
            
        ]);
    }
}
