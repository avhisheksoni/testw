<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundRequest extends Model
{
    protected $table= 'fund_request';
    protected $guarded = [];
    public $timestamps = true;
}
