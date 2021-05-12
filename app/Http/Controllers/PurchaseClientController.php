<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseClient;
use App\PassignClient;
use App\PJobMast;
use App\PurchaseModel;

class PurchaseClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $pclient = PurchaseClient::paginate(10);
        return view('PurchaseClient.index',compact('pclient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('PurchaseClient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $data= $request->validate([
            'name'=>'required|min:2|max:30',
            'gstin'=>'required|max:15|min:15|unique:re_client',


    ]);
          PurchaseClient::create($data);
        return redirect('PurchaseClient')->with('message','Purchase-Client Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 

         $edit = PurchaseClient::find($id);
         return view('PurchaseClient.details',compact('edit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $edit = PurchaseClient::find($id);
         return view('PurchaseClient.edit',compact('edit'));

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
        $data= $request->validate([
            'name'=>'required|min:2|max:30',
            'gstin'=>'required|max:15|min:15|unique:purchase_client',
$id,

    ]);
          PurchaseClient::where('id',$id)->update($data);
        return redirect('PurchaseClient')->with('message','P-Company Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dservice = PurchaseClient::where('id', $id)->delete();
      return redirect()->back()->with('message','P-Company  Is Successfully Removed From List');
    }

    public function get_r_company(Request $request){
       
          return PassignClient::with(['Pclient'=>function($query){
            $query->select('id','name');
          }])->where('comp_id',$request->id)->select('comp_id','client_id','id')->get();
    }

    public function get_c_work(Request $request){
         return PJobMast::where('client_id',$request->id)->where('comp_id',$request->cid)->get();

    }

    public function get_w_details(Request $request){

        $purchaselist = PurchaseModel::where('job_id',$request->id)->where('comp_id',$request->cid)->get();
        $data['gross'] = PurchaseModel::where('job_id',$request->id)->where('comp_id',$request->cid)->get()->sum('gross_total_invoice_value');
        $data['bamt'] = PurchaseModel::where('job_id',$request->id)->where('comp_id',$request->cid)->get()->sum('base_amount_taxable_value');
        $data['cra'] = PurchaseModel::where('job_id',$request->id)->where('comp_id',$request->cid)->get()->sum('total_ck_rec');
        $data['gst'] = PurchaseModel::where('job_id',$request->id)->where('comp_id',$request->cid)->get()->sum('gst_amount');
        $data['usd'] = PurchaseModel::where('job_id',$request->id)->where('comp_id',$request->cid)->get()->sum('outstanding');

        return view('pages.purchase_table',compact('purchaselist','data'));

    }
}
