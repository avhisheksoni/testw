<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sales;
use App\job_master;
use App\Gstin;
use App\tax_gst;
use App\TaxTdsmodel;
use App\Client;
use App\Company_mast;
use App\salechq;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{


   public function __construct(){

         $this->middleware('test');
    }  

   public function index(){
      $job = job_master::all();
     return view('pages.salesform',compact('job'));	
   } 

   public function store(Request $request){
   	 $data= $request->validate([
        'job_id'=>'required',
    		'invoive_number'=>'required',
    		'sales_date'=>'required|date',
    		'gross_total_invoice_value'=>'required|numeric',
    		'invoice_type'=>'required',
    		'base_amount_taxable_value'=>'required|numeric',
    		'description'=>'required',
    		// 'cheque_date'=>'required|date',
    		// 'cheque_received_amount'=>'required|numeric',
    		'tds_amount'=>'nullable',
    		'other'=>'nullable',
    		'total_amount'=>'required|numeric',
    		'outstanding'=>'required|numeric',
    		'five_percrnt_sd_amount'=>'nullable',
        'gst_amount'=>'required|numeric',
        'comp_id'=>'required|numeric',


    	]);
      //dd($data);
     	  $user = sales::create($data);
        $lastId= $user->id;
    $array = $request->cheque_date_;
    $amount = $request->cheque_received_amount_;
    $sum = 0;
    for($count=0; $count<count($array);$count++){
       $cdate['sale_id'] = $lastId;
       $cdate['cheque_date'] = $array[$count];
       $cdate['cheque_amount'] = $amount[$count];
       $sum = $sum+$amount[$count];

       salechq::create($cdate);
    }
     $datack['cheque_date']=$cdate['cheque_date'];
    $up['cheque_received_amount'] = $sum;
    sales::where('id', $lastId)->increment('total_ck_rec', $sum);
    sales::where('id', $lastId)->update($datack);
//     Product::where('product_id', $product->id)
// ->increment('count', 1, ['last_count_increased_at' => Carbon::now()]);
    
    
        return redirect('salelist');
    	
   }

   public function salelist(){
    // return $saleslist = sales::with('job.gst')->get();
     $saleslist = sales::all();
     $sum['sum'] = sales::sum('gross_total_invoice_value');
     $sum['bamount'] = sales::sum('base_amount_taxable_value');
     $sum['cra'] = sales::sum('total_ck_rec');
     $sum['usd'] = sales::sum('outstanding');
     $sum['gst'] = sales::sum('gst_amount');
   // /return sales::with('job')->get();
     // dd($posts);
   	return view('pages.saleslist',compact('saleslist','sum'));	
   }

   public function saledetails($id){
    $edit = sales::where('id',$id)->first();
    $ckamt = sales::find($id)->checkamount;
    return view('pages.salesdetails',compact('edit','ckamt'));
   }

   public  function saleedit($id){
   
   $edit = sales::where('id',$id)->first();
   $ckamt = sales::find($id)->checkamount;
   //dd($comments);
   return view('pages.salesedit',compact('edit','ckamt'));  

   }

   public function salesupdate(Request $request ,$id){
         // $client= $request->validate([
         //    'client_id' => 'required',
         // ]);

         // $update = job_master::where('id',$request->job_id)->update($client);
         $data= $request->validate([
        'job_id'=>'required',
        'invoive_number'=>'required',
        'sales_date'=>'required|date',
        'gross_total_invoice_value'=>'required|numeric',
        'invoice_type'=>'required',
        'base_amount_taxable_value'=>'required|numeric',
        'description'=>'required',
        // 'cheque_date'=>'required|date',
        // 'cheque_received_amount'=>'required|numeric',
        'tds_amount'=>'nullable',
        'other'=>'nullable',
        'total_amount'=>'required|numeric',
        'outstanding'=>'required|numeric',
        'five_percrnt_sd_amount'=>'nullable',
        'gst_amount'=>'required|numeric',
        'comp_id'=>'required|numeric',
      ]);

        sales::where('id', $id)->update($data);
        $lastId = $request->sale_id;
        // dd($lastId);
        $array = $request->cheque_date_;
        $amount = $request->cheque_received_amount_;
        $ckamtid = $request->ckamtid;
        $sum = 0;
        // dd(count($array));
    for($count=0; $count<count($array);$count++){
       
       $udate['sale_id'] = $lastId;
       $udate['cheque_date'] = $array[$count];
       $udate['cheque_amount'] = $amount[$count];
       $sum = $sum+$amount[$count];
       if($ckamtid[$count] != ""){
      salechq::where('id',$ckamtid[$count])->where('sale_id',$lastId)->update($udate);
       }else{
      salechq::create($udate);
       }
    }
    $total_a['total_ck_rec'] = $sum;
    sales::where('id', $id)->update($total_a);
        return redirect('salelist')->with('message','Sales Details  Is Successfully Update');

   }

   public function saledelete($id){

    $dservice = sales::where('id', $id)->delete();
      return redirect()->back()->with('message','Sales Details  Is Successfully Removed From List');
   }

   public function compwisejob(Request $request){
     
     return job_master::with(['client'=>function($query){
          $query->select('name','id');
     }])->where('comp_id',$request->id)->select('id','client_id','job_code')->get();



     // = DB::table('job_master')
     //        ->join('re_client', 're_client.id', '=', 'job_master.client_id')
     //        ->where('job_master.comp_id',$request->id)
     //        ->select('re_client.name','job_master.id')
     //        ->get();

    // return job_master::with(['client'])->where('')

   }

   public function receiver(Request $request){
     
      $data = job_master::find($request->id);
      $data['gstn'] = Gstin::find($data->e_commerece_gstin);
      $data['gst'] = tax_gst::find($data->tax_gst);
      $data['tds'] = TaxTdsmodel::find($data->tax_tds);
      $data['client'] = Client::find($data->client_id);
      $data['comp'] = Company_mast::find($data->comp_id);
      return $data;

   }

   public function searchdata(Request $request){

     return $request->id;
   }

   public function deleterow(Request $request){

        salechq::where('id',$request->id)->delete();
   }

    
}
