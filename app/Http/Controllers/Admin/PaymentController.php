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
use App\Models\Method;
class PaymentController extends BaseController

{
    
    function index($subdomain){
        $company=$this->company;
     
        $methods=Method::get();

        return view('methods.index',['methods'=>$methods,'subdomain'=>$subdomain]);
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
            'title' => 'required',
            'status'=>'required',
            'type'=>'required'
           ]);
          
           
        if ($validator->passes()) {
            $method_requests=$request->all(); 

                $method=Method::create(array('title'=>$method_requests['title'],'status'=>$method_requests['status'],'number_convert'=>$method_requests['number_convert'],'type'=>$method_requests['paymethodtype']))->get();
                
             
                        
                return response()->json(['success'=> 'added successfully.']);
        
      
        }else{
                return response()->json(['error'=>$validator->errors()->all()]);
        } 
  
      }
      
      
      
    public function edit($subdomain,$id){
      $method=Method::where('id',$id)->get();
     
      return response()->json($method);
    }
    
    
    public function update($subdomain,Request $request, $id){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'status'=>'required',
            'type'=>'required'
           ]);
          
          
         
        if ($validator->passes()) {
            $method_requests=$request->all(); 
            $method=array('title'=>$method_requests['title'],'status'=>$method_requests['status'],'number_convert'=>$method_requests['number_convert'],'type'=>$method_requests['paymethodtype']);
                
             
            Method::where('id',$id)->update($method);
            return response()->json(['success'=> ' updated successfully.']);
        }else{
            return response()->json(['error'=>$validator->errors()->all()]);
        }

    }
   public function delete($subdomain,Request $request)
    {
        Method::where('id',$request->id)->delete();
        return back()->with('success', 'Delete successfully.');
       
    }
    
    public function status($subdomain,Request $request){
    
        $method=Method::where('id',$request->id)->update(array('status'=>$request->status));
        if($method>0){
            return back()->with('success', ' status changed successfully.');
        }else{
             return back()->with('error','messages.error'); 
        }

    }


    
}