<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PJobMast extends Model
{
    use SoftDeletes;
    protected $table= 'p_job_mast';
    protected $guarded = [];
    public $timestamps = true;

    function Pgst(){

    	return $this->belongsTo('App\tax_gst','tax_gst');
    }

    function Ptds(){

    	return $this->belongsTo('App\TaxTdsmodel','tax_tds');
    }

    function Pgstin(){

    	return $this->belongsTo('App\Gstin','e_commerece_gstin');
    }

    function Pcompany(){

        return $this->belongsTo('App\Company_mast','comp_id');
    }

    function Pclient(){

        return $this->belongsTo('App\PurchaseClient','client_id');
    }

}
