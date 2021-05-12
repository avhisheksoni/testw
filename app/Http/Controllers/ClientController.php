<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\job_master;
use App\AssignClient;
use App\sales;
use App\City;
use App\state;
use App\beneficiary_add;
use App\BeneficiaryRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    
    // public function __construct(){

    //      $this->middleware('test');
    // }    

  public function __construct()
{
    $this->middleware('auth');
}

    public function index(){
          // return Auth::user()->name;
        $cli = Client::paginate();
    	return view('Client.index',compact('cli'));
    }

     public function create(){
         
       
    	return view('Client.create');
    }

    public function store(Request $request){
      //dd($request->correspondence_address);
       $data= $request->validate([
    		'name'=>'required|min:2|max:30',
    		'gstin'=>'required|max:15|min:15|unique:re_client',
        'pan_no'=>'required|max:10|min:10',
        'email'=>'nullable',
        'state_code'=>'required|',
        'city_code'=>'required|',
        'correspondence_address'=>'nullable',
        'Registered_address'=>'nullable',
        'note'=>'nullable',
        'contact'=>'nullable|max:10|min:10'

    ]);
     	  Client::create($data);
        return redirect('client-list')->with('message','Client Add successfully');

    }

    public function details($id){
         $details = Client::find($id);
    	return view('Client.details',compact('details'));
    }

    public function edit($id){

       $details = Client::find($id);
    	return view('Client.edit',compact('details'));
    }

    public function update(Request $request,$id){
        $data= $request->validate([
        'name'=>'required|min:2|max:30',
        'gstin'=>'required|max:15|min:15|unique:gstin,gstin,'.$id,
        'pan_no'=>'required|max:10|min:10',
        'email'=>'nullable',
        'state_code'=>'required|',
        'city_code'=>'required|',
        'correspondence_address'=>'nullable',
        'Registered_address'=>'nullable',
        'note'=>'nullable',
        'contact'=>'nullable|max:10|min:10'

    ]);
           Client::where('id',$id)->update($data);
        return redirect('client-list')->with('message','Client Info Updated successfully');

    }

    public function delete($id){

       $dservice = Client::where('id', $id)->delete();
        return redirect()->back()->with('message','Client Is Successfully Removed From List');
    }

    public function getclient(Request $request){

        $data['rec'] = Client::find($request->id);
        $data['job'] = job_master::where('client_id',$request->id)->get();
        // $data['ac'] =DB::table('assign_client')
        //     ->join('company_mast', 'company_mast.id', '=', 'assign_client.comp_id')
        //     ->select('company_mast.*')
        //     ->get();
        $data['ac']=AssignClient::with(['company'=>function($query){
          $query->select('name','id');
     }])->where('client_id',$request->id)->select('id','client_id','comp_id')->get();
        return $data;

    }

    public function get_c_client(Request $request){

       return AssignClient::with(['client'=>function($query){
        $query->select('name','id');
       }])->where('comp_id',$request->id)->select('id','client_id','comp_id')->get();
    }

    public function get_c_work(Request $request){

            return job_master::where('client_id',$request->id)->where('comp_id',$request->cid)->get();
    }

    public function get_s_details(Request $request){
          
          $saleslist = sales::where('job_id',$request->id)->where('comp_id',$request->cid)->get();
          $sum['sum'] = sales::where('job_id',$request->id)->where('comp_id',$request->cid)->get()->sum('gross_total_invoice_value');
          $sum['bamount'] = sales::where('job_id',$request->id)->where('comp_id',$request->cid)->get()->sum('base_amount_taxable_value');
          $sum['gst'] = sales::where('job_id',$request->id)->where('comp_id',$request->cid)->get()->sum('gst_amount');
          $sum['usd'] = sales::where('job_id',$request->id)->where('comp_id',$request->cid)->get()->sum('outstanding');
          $sum['cra'] = sales::where('job_id',$request->id)->where('comp_id',$request->cid)->get()->sum('total_ck_rec');


          return view('pages.sales_table',compact('saleslist','sum'));

    }

    public function getcityname(Request $request){

       return $city = City::where('city_code',$request->id)->first();


    }

    public function getclientbene(Request $request){
           $clients = beneficiary_add::all();
               
                foreach($clients as $cl){

                  $ids[] =  $cl->bg_request_id;
                }
                $array[] = ['Approved'];
        return BeneficiaryRequest::with('client')->whereNotIn('request_code',$ids)->where('status','Approved')->get();
       

       }

    public function getbenfijob(Request $request){
       
       $bg = explode("||",$request->id);
       $jobid = BeneficiaryRequest::where('request_code',$bg[1])->first();
                return job_master::find($jobid->job_id);       


    }
       public function getbenfidetails(Request $request){

         $bg = explode("||",$request->id);
       $jobid = BeneficiaryRequest::where('request_code',$bg[1])->first();
        $data['job'] = job_master::find($jobid->job_id); 

       $data['bg'] = $bg[1];
       $data['client'] = Client::find($bg[0]);
       //return job_master::where('client_id',$request->id)->get();
       //$data['job'] = job_master::where('id',BeneficiaryRequest::find($request->id)->id)->first();
       $data['city'] =   City::where('city_code',Client::find($bg[0])->city_code)->first();
       $data['state'] = state::where('state_code',Client::find($bg[0])->state_code)->first();
       //$data['client'] = Client::find($request->id);
       return  $data;
    }



}
