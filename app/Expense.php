<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table= 'expenses';
    protected $guarded = [];
    public $timestamps = true;
}
