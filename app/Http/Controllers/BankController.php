<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;

class BankController extends Controller
{
    
    public function index(){
        $bank= Bank::paginate(10);
    	return view('Bank.bank-list',compact('bank'));
    }

    public function create(){

    	return view('Bank.bank-add');
    }

    public function store(Request $request){
        
          $data = $request->validate([   
          'name'=>'required', 
          'bank_code'=>'required|max:5|Min:5',      
          'branch'=>'required',       
          'contact'=>'required',      
          'ifsc_code'=>'required',      
          'account_no'=>'required',      
          'contact_person'=>'required',      
          'email'=>'required|email',      
          ]);
        Bank::create($data);
        return redirect('bank-list');
    }


    public function edit($id){

       $edit = Bank::find($id);
       return view('Bank.bank-edit',compact('edit'));
    }

    public function update(Request $request,$id){
            
              $data = $request->validate([   
          'name'=>'required',      
          'bank_code'=>'required|max:5|Min:5',      
          'branch'=>'required',       
          'contact'=>'required',      
          'ifsc_code'=>'required',      
          'account_no'=>'required',      
          'contact_person'=>'required',      
          'email'=>'required|email',      
          ]);
          
          Bank::where('id',$id)->update($data);
          return redirect('bank-list')->with('message','Bank Details  Is Successfully updated');;
    }

    public function delete($id){
      
      $dservice = Bank::where('id', $id)->delete();
      return redirect()->back()->with('message','Bank Details  Is Successfully Removed From List');

    }

    public function detailsview($id){
     
      $edit = Bank::find($id);
       return view('Bank.bank-details-view',compact('edit'));

    }
}
