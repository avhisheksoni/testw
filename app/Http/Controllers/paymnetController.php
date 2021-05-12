<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class paymnetController extends Controller
{
    

    public function payment(){

    	return view('Bank.payment');
    }

    public function pstore(){

    	return "reyey";
    }
}
