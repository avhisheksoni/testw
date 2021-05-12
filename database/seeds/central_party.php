<?php

use Illuminate\Database\Seeder;

class central_party extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('central_party')->insert([
            'party_name' => 'Suresh',
            'company_name' => 'Laxyo Pvt. Ltd.',
            'email' => 'tata@gmail.com',
            'gstin_no' => '35AABCS1429B1ZX',
            'pan_no' => 'ABCDE1234F',
            'city_code' => 16,
            'state_code' => 17,
            'postal_address' => 'sector-765 bhavnagar',
            'registered_address' => 'BL-123 Vijay Nagar Indore',
            'contact' => '9865744152',
            
        ]);
       DB::table('central_party')->insert([
            'party_name' => 'Ravindra',
            'company_name' => 'Laxyo Pvt. Ltd.',
            'email' => 'ravi@gmail.com',
            'gstin_no' => '35AABCS1429B1ZX',
            'pan_no' => 'ABCDE1234F',
            'city_code' => 13,
            'state_code' => 15,
            'postal_address' => 'sector-A876 Surat',
            'registered_address' => 'BL-123 Vijay Nagar Indore',
            'contact' => '9865744152',
            
        ]);
    }
}
