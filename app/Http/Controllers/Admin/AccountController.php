<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\payments_logs;
class AccontController extends BaseController

{
    
    function index($subdomain){
        $company=$this->company;
     
        $banks=Bank::get();

        return view('banks.index',['banks'=>$banks,'subdomain'=>$subdomain]);
    }
 
    /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store ($subdomain,Request $request)
      {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'account_number'=>'required|unique:banks',
            'balance'=>'required',
           ]);
          
           
        if ($validator->passes()) {
            $bank_requests=$request->all(); 

                $bank=Bank::create(array('name'=>$bank_requests['name'],'account_number'=>$bank_requests['account_number'],'balance'=>$bank_requests['balance']))->get();
                
             
                        
                return response()->json(['success'=> 'added successfully.']);
        
      
        }else{
            return response()->json(['error'=>$validator->errors()->all()]);
        } 
  
      }
      
      
      
    public function edit($subdomain,$id){
      $bank=Bank::where('id',$id)->get();
     
      return response()->json($bank);
    }
    
    
    public function update($subdomain,Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'account_number'=>'required|unique:banks,account_number,'.$id,
             
            'balance'=>'required',
           ]);
          
         
        if ($validator->passes()) {
            $bank_requests=$request->all(); 
           
            $bank=array('name'=>$bank_requests['name'],'account_number'=>$bank_requests['account_number'],'balance'=>$bank_requests['balance']);
            Bank::where('id',$id)->update($bank);
            return response()->json(['success'=> ' updated successfully.']);
        }else{
            return response()->json(['error'=>$validator->errors()->all()]);
        }

    }
   public function delete($subdomain,Request $request)
    {
        Bank::where('id',$request->id)->delete();
        return back()->with('success', 'Delete successfully.');
       
    }
    
    public function status($subdomain,Request $request){
    
        $bank= Bank::where('id',$request->id)->update(array('status'=>$request->status));
        if($client>0){
        return back()->with('success', ' status changed successfully.');
        }else{
        return back()->with('error','messages.error'); 
        }

    }


    
}