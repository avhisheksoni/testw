<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseModel;
use App\PJobMast;
use App\Gstin;
use App\tax_gst;
use App\TaxTdsmodel;
use App\Purchasechq;

class PurchaseController extends Controller
{
    public function index(){
      $job = PJobMast::all();
     return view('pages.purchaseform',compact('job'));	
   } 

   public function purchase_store(Request $request){
  
   	 $data= $request->validate([
    		'job_id'=>'required',
        'invoive_number'=>'required',
        'sales_date'=>'required|date',
        'gross_total_invoice_value'=>'required|numeric',
        'invoice_type'=>'required',
        'base_amount_taxable_value'=>'required|numeric',
        'description'=>'required',
        //'cheque_date'=>'required|date',
        //'cheque_received_amount'=>'required|numeric',
        'tds_amount'=>'nullable',
        'other'=>'nullable',
        'total_amount'=>'required|numeric',
        'outstanding'=>'required|numeric',
        'five_percrnt_sd_amount'=>'nullable',
        'gst_amount'=>'required|numeric',
        'comp_id'=>'required|numeric',

    	]);

     	  $user = PurchaseModel::create($data);
        $lastId= $user->id;
         $array = $request->cheque_date_;
         $camot = $request->cheque_received_amount_;
         $sum = 0;
         for($count=0;  $count<count($array); $count++){
            $pdata['purchase_id'] = $lastId;
            $pdata['cheque_date'] = $array[$count];
            $pdata['cheque_amount'] = $camot[$count];
            $sum = $sum+$camot[$count];

            Purchasechq::create($pdata);


         }
    $datack['cheque_date']=$pdata['cheque_date'];
    $up['cheque_received_amount'] = $sum;
    PurchaseModel::where('id', $lastId)->increment('total_ck_rec', $sum);
    PurchaseModel::where('id', $lastId)->update($datack);
         
         return redirect('purchaselist');
    	
   }

   public function purchaselist(){
    $purchaselist = PurchaseModel::all();
     //dd($posts);
    $data['gross'] = PurchaseModel::sum('gross_total_invoice_value');
    $data['bamt'] = PurchaseModel::sum('base_amount_taxable_value');
    $data['cra']  = PurchaseModel::sum('total_ck_rec');
    $data['usd']  = PurchaseModel::sum('outstanding');
    $data['gst']  = PurchaseModel::sum('gst_amount');
   	return view('pages.purchaselist',compact('purchaselist','data'));	
   }

   public function purchasedetails($id){


    $edit = PurchaseModel::where('id',$id)->first();
    $ckamt = PurchaseModel::find($id)->checkamount;
    return view('pages.purchasedetails',compact('edit','ckamt'));
   }

   public function purchaseedit($id){
  $edit = PurchaseModel::where('id',$id)->first();
  $ckamt = PurchaseModel::find($id)->checkamount;
    return view('pages.purchase_edit',compact('edit','ckamt'));

   }

   public function update_purchase(Request $request ,$id){

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
        PurchaseModel::where('id', $id)->update($data);
        $lastId = $request->purchase_id;
        // dd($lastId);
        $array = $request->cheque_date_;
        $amount = $request->cheque_received_amount_;
        $ckamtid = $request->ckamtid;
        $sum = 0;
        // dd(count($array));
    for($count=0; $count<count($array);$count++){
       
       $udate['purchase_id'] = $lastId;
       $udate['cheque_date'] = $array[$count];
       $udate['cheque_amount'] = $amount[$count];
       $sum = $sum+$amount[$count];
       if($ckamtid[$count] != ""){
      Purchasechq::where('id',$ckamtid[$count])->where('purchase_id',$lastId)->update($udate);
       }else{
      Purchasechq::create($udate);
       }
    }
    $total_a['total_ck_rec'] = $sum;
    PurchaseModel::where('id', $id)->update($total_a);
        return redirect('purchaselist')->with('message','Purchase Details  Is Successfully Update');
   }

   public function purchasedelete($id){
    
     $dservice = PurchaseModel::where('id', $id)->delete();
      return redirect()->back()->with('message','Purchase Details  Is Successfully Removed From List');
   }

   public function deletecheck(Request $request){

      Purchasechq::where('id',$request->id)->delete();
   }

}
