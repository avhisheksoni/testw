<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guarantee;
use App\job_master;
use App\Beneficiary;
use App\BeneficiaryRequest;
use App\beneficiary_add;
use App\bg_type_mast;
use App\Bank;
use App\bg_set_status;
use App\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GuaranteeController extends Controller
{
    
    public function index(){
           
        $gurt=Guarantee::paginate(10);
        // dd($gurt);
        //$job=job_master::all();
        $beneficiary=beneficiary_add::all();
        $rer= beneficiary_add::selectRaw('count("client_id")')->select('client_id')->groupBy('client_id')->get();
        
        //$bank=Bank::all();
        $bg_type=bg_type_mast::where('status_lc', '!=' , 'False')->get();
        //dd($bg_type);
    	return view("Guarantee.guarantee-list",compact('job','beneficiary','bg_type','gurt','rer'));
    }

    public function store(Request $request){
           
           //dd($request->all());in
          $data = $request->validate([  
          'job_code'=>'required',      
          'job_name'=>'required',      
          'beneficiary_id'=>'required',                       
          'bg_code'=>'required',                       
          'comp_id'=>'required',                       
          ]);
        $insert = Guarantee::create($data);
        $insert->id;
    	 return redirect()->route('guarantee-request-edit',['id'=>$insert->id]);
    }

    public function edit($id){
         $edit['bg_code']=Guarantee::find($id);
         $code = $edit['bg_code']->bg_code;
         $edit['req'] = BeneficiaryRequest::where('request_code',$code)->first();
         // return $edit;
         return view('Guarantee.guarantee-edit',compact('edit'));
    }

    public  function  getbranch(Request $request){

    	 $bank_id=$request->id;

        return $branch=Bank::find($bank_id)->branch;
        
    }

    public function update(Request $request ,$id){
    //dd($request->tender_no);
       $data = $request->validate([  
          // 'job_code'=>'required',      
          'beneficiary_id'=>'required',                       
          'bank_code'=>'required',                       
          'bank_branch'=>'required',                       
          'bg_code'=>'nullable',                       
          'amended_from_bg_code'=>'nullable',                       
          'amended_by_bg_no'=>'nullable',                       
          'bg_no'=>'nullable',                       
          'bg_date'=>'required',                       
          'application_no'=>'required',                       
          'application_note'=>'nullable',                       
          'bg_note'=>'required',                       
          //'job_code'=>'required',                       
          'job_name'=>'required',                       
          //'beneficiary_address'=>'required',                       
          'bg_value'=>'required',                       
          'exchange_rate'=>'required',                       
          'expiry_date'=>'required',                       
          'claim_expiry_date'=>'required',                       
          'status'=>'required',                       
          'tender_no'=>'required',                       
          //'file'=>'nullable',                       
          ]);
       if($request->file == ""){
        $data['file'] =  $request->old_file;
       }else{
       $data['file'] =  storage::putfile('public/guarantee',$request->file('file'));
       }
         //dd($data);

       // $request->file->store('public/guarantee');
       //                 storage::putfile('public/guarantee',$request->file('file'));
      //dd($data);
        Guarantee::where('id',$id)->update($data);
        return redirect('guarantee-list')->with('message','Request Is Successfully Updated'); 

    }

    public function details($id){
         
         //$edit = Guarantee::find($id);
        // return view('Guarantee.guarantee-details',compact('edit'));
       $edit['bg_code']=Guarantee::find($id);
         $code = $edit['bg_code']->bg_code;
         $edit['req'] = BeneficiaryRequest::where('request_code',$code)->first();
         // return $edit;
         return view('Guarantee.guarantee-details',compact('edit'));
      
    }


  public function delete($id){
   
   $dservice = Guarantee::where('id', $id)->delete();
      return redirect()->back()->with('message','Guarantee Request  Is Successfully Removed From List');

  }

  public function approval($id){
     
     $data['status'] = "Requested";
     $appr = Guarantee::where('id',$id)->update($data);
     return redirect('guarantee-list')->with('message','Request Send For Approval');
  }

  public function approvallist(){
           
        $gurt=Guarantee::where('status','Requested')->orwhere('status','Approved-level-1')->paginate(10);
        $job=job_master::all();
        $beneficiary=Beneficiary::all();
        $bg_type=bg_type_mast::all();

           return view('Guarantee.guarantee-requested-list',compact('job','beneficiary','bg_type','gurt'));
  }

  public function sadminapproval($id){

      $data['status'] = "Approved-level-1";
     $appr = Guarantee::where('id',$id)->update($data);
     return redirect('guarantee-approval-list')->with('message','Request Approved By Super Admin');
  }

  public function download($file){
  
     return "ryerye";
  }

  public function getcmpg(Request $request){

     $bgname = beneficiary_add::selectRaw('count("client_id")')->select('client_id')->where('comp_id',$request->id)->groupBy('client_id')->get()->pluck('client_id');
     return Client::whereIN('id',$bgname)->get();
  }

  public function getbgcode(Request $request){
      $gua = Guarantee::all()->pluck('bg_code');
      //return $gua;
       $data = beneficiary_add::where('client_id',$request->id)->whereNotIN('bg_request_id',$gua)->get();
      //$bgcode[] = '';
      foreach($data as $bg){

        $bgcode[] = $bg->bg_request_id;
      }

     

      return $jobname = BeneficiaryRequest::whereIn('request_code',$bgcode)->where('beneficiary_id',$request->id)->where('status','Approved')->get();
    //  foreach($jobname as $name){
        
    //      $jobid[] = $name->request_code;
    //      // $jobid[] = $name->job_id.||.$name->request_code;
    //  }
    // return $jobid;
    //     return job_master::whereIn('id',$jobid)->get();
  }

  public function getbgshow(Request $request){

    $job_id = BeneficiaryRequest::select('job_id')->where('request_code',$request->id)->first();
    
    return job_master::find($job_id['job_id']);
  }
}
