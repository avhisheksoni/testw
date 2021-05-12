<?php

use Illuminate\Database\Seeder;

class company extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('company_mast')->insert([
            'code' => 'LEL-121',
            'name' => 'Laxyo Energy',
            
        ]);
       DB::table('company_mast')->insert([
            'code' => 'LEL-122',
            'name' => 'Yolax Infranergy',
            
        ]);
      
    }
}
