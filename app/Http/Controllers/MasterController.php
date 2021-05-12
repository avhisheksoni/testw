<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\job_master;
use App\tax_gst;
use App\TaxTdsmodel;
use App\Gstin;
use App\Client;
use App\Company_mast;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
    public function index(){
        
       
    	return view('Master.index');
    }

    public function joblist(){

        $job = job_master::paginate(10);
       return view("Master.job-list",compact('job'));
    }

    public function jobcreate(){
      
      $gst = tax_gst::all();
      $tds = TaxTdsmodel::all();
      $gstin = Gstin::all();
      $client = Client::all();
      $comp = Company_mast::all();
      return view('Master.createjob',compact('gst','tds','gstin','client','comp'));

    }

    public function jobstore(Request $request){
      
      $last_id  = DB::table('job_master')->max('id');
    	$add= $last_id+1;
      $data = $request->validate([  
          'job_describe'=>'required',                           
          'tender_no'=>'required',                           
          'location'=>'required',                           
          'tax_gst'=>'required|numeric',                           
          'tax_tds'=>'required|numeric',                           
          'sd_percentage'=>'required|numeric',                           
          'place_of_supply'=>'required',                           
          'client_id'=>'required',                           
          'comp_id'=>'required',                           
          'e_commerece_gstin'=>'required',                   
          ]);
        $data['job_code'] = "JWN-000-".$add; 
        job_master::create($data);
    	return redirect()->route('job-list');
      

    }

    public function jobedit($id){
      
      $edit = job_master::find($id);
      // dd($edit);
      return view('Master.job-edit',compact('edit'));

    }

    public function jobupdate(Request $request,$id){

      $data = $request->validate([  
          'job_describe'=>'required',                           
          'tender_no'=>'required',                           
          'location'=>'required',                           
          'tax_gst'=>'required|numeric',                           
          'tax_tds'=>'required|numeric',                           
          'sd_percentage'=>'required|numeric',                           
          'place_of_supply'=>'required',                           
          'client_id'=>'required',                           
          'comp_id'=>'required',                           
          'e_commerece_gstin'=>'required',          
          ]);                                                  
        job_master::where('id',$id)->update($data);
      return redirect()->route('job-list');
    }

    public function jobdelete($id){
       
        $dservice = job_master::where('id', $id)->delete();
      return redirect()->back()->with('message','Job/Work Name  Is Successfully Removed');
    }

    public function details($id){

       $edit = job_master::find($id);
      return view('Master.job-details',compact('edit'));
    }
}
