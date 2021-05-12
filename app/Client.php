<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Client extends Model
{
    
	use SoftDeletes;
    protected $table= 're_client';
    protected $guarded = [];
    public $timestamps = true;

    public function citycode(){

    	return $this->belongsTo('App\City','city_code');
    }

    public function statecode(){

    	return $this->belongsTo('App\state','state_code');
    }
}

