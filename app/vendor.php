<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vendor extends Model
{
     protected $table= 'vendor';
    protected $guarded = [];
    public $timestamps = true;

    function vendorname()
    {

    	return $this->hasmany('App\Expense','vendor_id','id');
    }
}
