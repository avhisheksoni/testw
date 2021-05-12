<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PassignClient extends Model
{   
	use softdeletes;
    protected $table= 'p_assign_client';
    protected $guarded = [];
    public $timestamps = true;

    public function company(){

    	return $this->belongsTo('App\Company_mast','comp_id');
    } 

    public function Pclient(){

    	return $this->belongsTo('App\PurchaseClient','client_id');
    } 
}
