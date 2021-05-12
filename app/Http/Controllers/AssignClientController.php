<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssignClient;
use App\Client;
use App\job_master;

class AssignClientController extends Controller
{

    public function  index(){
       
       $acl = AssignClient::paginate();
       return view('AssignClient.index',compact('acl'));
    }

    public function create(){

       return view('AssignClient.create');
    }

    public function store(Request $request){
      
      $data = $request->validate([   
          'comp_id'=>'required', 
          'client_id'=>'required',      
          ]);
        AssignClient::create($data);
        return redirect('assign-client-list');

    }

    public function edit($id){

       $edit = AssignClient::find($id);
       return view('AssignClient.edit',compact('edit'));
    }

    public function update(Request $request,$id){
      
      $data = $request->validate([   
          'comp_id'=>'required', 
          'client_id'=>'required',      
          ]);
        AssignClient::where('id',$id)->update($data);
        return redirect('assign-client-list')->with('message','Assigned Company is Successfully Updated');


    }

    public function details($id){
       
       $edit = AssignClient::find($id);
       return view('AssignClient.details',compact('edit'));
    } 

    public function delete($id){

      $dservice = AssignClient::where('id', $id)->delete();
        return redirect()->back()->with('message','Assigned Company is Successfully Removed');
    }

    public function getclientid(Request $request){
      
      $client = AssignClient::where('comp_id',$request->id)->get();
      foreach($client as $cl){

      	$ids[] =  $cl->client_id;
      }
      
      return $client_new =  Client::wherenotIn('id',$ids)->get();

    }
    public function assignclient(Request $request){
      
      return $client = AssignClient::with(['client'=>function($query){
          $query->select('name','id');
     }])->where('comp_id',$request->id)->select('id','client_id','comp_id')->get();


    }

    public function getwork(Request $request){

      return job_master::where('comp_id',$request->cid)->where('client_id',$request->id)->get();

    }
}
