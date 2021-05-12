<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseClient;
use App\PassignClient;
use App\PJobMast;
use App\Gstin;
use App\tax_gst;
use App\TaxTdsmodel;
use Illuminate\Support\Facades\DB;

class PJobMastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        $Pcl  = PJobMast::paginate(10);
        return view('PJobMast.index',compact('Pcl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
        $Pclient = PurchaseClient::all();
         return view('PJobMast.create',compact('Pclient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $last_id  = DB::table('p_job_mast')->max('id');
        $add= $last_id+1;
        $data = $request->validate([  
          'name'=>'required',                           
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
        $data['job_code'] = "PJWN-000-".$add; 
        PJobMast::create($data);
        return redirect('PJobMast')->with('message','P-job/work-name Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $edit = PJobMast::find($id);
        return view('PJobMast.details',compact('edit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = PJobMast::find($id);
        return view('PJobMast.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $data = $request->validate([  
          'name'=>'required',                           
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
        PJobMast::where('id',$id)->update($data);
        return redirect('PJobMast')->with('message','P-job/work-name Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dservice = PJobMast::where('id', $id)->delete();
      return redirect()->back()->with('message','P-Client Is Successfully Removed From List');

    }

    public function getPclientgstin(Request $request){
      
      $data['Pgsin']= PurchaseClient::find($request->id);
      $data['Pac']= PassignClient::with(['company'=>function($query){
        $query->select('name','id');

      }])->where('client_id',$request->id)->select('id','comp_id','client_id')->get();

      return $data;

    }

    public function purchasework(Request $request){
       
       return PJobMast::where('comp_id',$request->cid)->where('client_id',$request->id)->get();

    }

    public function getpreceiver(Request $request){

      $data = PJobMast::find($request->id);
      $data['gstin'] = Gstin::find($data->e_commerece_gstin);
      $data['gst'] = tax_gst::find($data->tax_gst);
      $data['tds'] = TaxTdsmodel::find($data->tax_tds);
      $data['client'] = PurchaseClient::find($data->client_id);

      return $data;
    }
}
