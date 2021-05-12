<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     // $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function loginuser(Request $request){
        //return "ewtw";
          if (Auth::attempt(['email' => $request->username, 'password' =>$request->password])) {
            //return "ryery";
             $user = Auth::user();
              return redirect()->route('home');
            }else {
               return response()->json(['error' => 'Unauthorised'], 401);
            }
         
        }

}