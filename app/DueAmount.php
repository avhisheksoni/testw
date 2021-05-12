<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DueAmount extends Model
{
   
    protected $table= 'due_amount';
    protected $guarded = [];
    public $timestamps = true;
}
