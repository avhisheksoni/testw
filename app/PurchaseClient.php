<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseClient extends Model
{
    use SoftDeletes;
    protected $table= 'purchase_client';
    protected $guarded = [];
    public $timestamps = true;

    
}
