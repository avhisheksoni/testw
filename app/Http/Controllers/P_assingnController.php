<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PassignClient;
use App\PurchaseClient;

class P_assingnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $passign = PassignClient::paginate(10);
        return view('Passign.index',compact('passign'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Passign.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([   
          'comp_id'=>'required', 
          'client_id'=>'required',      
          ]);
        PassignClient::create($data);
        return redirect('Passingn')->with('message','P-client is stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $edit= PassignClient::find($id);
        return view('Passign.details',compact('edit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit= PassignClient::find($id);
        return view('Passign.edit',compact('edit'));
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
          'comp_id'=>'required', 
          'client_id'=>'required',      
          ]);
        PassignClient::where('id',$id)->update($data);
        return redirect('Passingn')->with('message','P-client is Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dservice = PassignClient::where('id', $id)->delete();
        return redirect()->back()->with('message','P-Assigned Company is Successfully Removed');
    }

    public function getpclient(Request $request){
      
      $client = PassignClient::where('comp_id',$request->id)->get();
      foreach($client as $cl){

        $ids[] =  $cl->client_id;
      }
      
      return $client_new =  PurchaseClient::wherenotIn('id',$ids)->get();
    }

    public function Passignclient(Request $request){

      return  PassignClient::with(['Pclient'=>function($query){
          $query->select('name','id');
       }])->where('comp_id',$request->id)->select('id','client_id','comp_id')->get();
    }
}
