<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CentralParty extends Model
{
    use SoftDeletes;
    protected $table= 'central_party';
    protected $guarded = [];
    public $timestamps = true;
}
