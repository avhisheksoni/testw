<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DueAmount;

class DueAmountController extends Controller
{
    

    public function index(){

           $amut= DueAmount::paginate(10);
    	  return view('DueAmouunt.index',compact('amut'));
    }

    public function create(){

    	return view('DueAmouunt.create');
    } 
}
