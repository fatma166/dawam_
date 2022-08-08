<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Visits_type;
use App\Models\Company;
use App\Models\User;
use Validator;
class VisitTypeController extends BaseController
{
    //
        //
        function index($subdomain){
            $company=$this->company;
            $users=User::where('company_id',$company->id)->where('role_id','!=',1)->orWhereNull('role_id')->get();
            $visit_types=Visits_type::where('company_id',$company->id)->get();
            return view('outdoors.visittype',['visit_types'=>$visit_types,'subdomain'=>$subdomain]);
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
  
              ]);
              
              
              if ($validator->passes()) {
                $outdoor_type=$request->all(); 
                $company=$this->company;
                $visit_type=Visits_type::create(array('company_id'=>$company->id,'name'=>$outdoor_type['name']))->get();

                if(!is_null($visit_type)) {
                    
                  return response()->json(['success'=>'Added new records.']);
                }
              }
              // else return with error message
              else {
                  
                return response()->json(['error'=>$validator->errors()->all()]);
              }
       
      
          }
        
          public function edit($subdomain,$id){
            $outdoor_type=visits_type::where('id',$id)->get();
           
            return response()->json($outdoor_type);
          }
          
          
          
          public function update($subdomain,Request $request, $id){
            $validator = Validator::make($request->all(), [
              'name' => 'required',
 
             ]);
            
             
            if ($validator->passes()) {
              $company=$this->company;
              $outdoor_type=$request->all();
              $visit_types=array('company_id'=>$company->id,'name'=> $outdoor_type['name']);
           
              Visits_type::where('id',$id)->update($visit_types);
              return response()->json(['success'=>'Added new records.']);
            }else{
               return response()->json(['error'=>$validator->errors()->all()]);
            }
      
          }
          
          
          public function delete($subdomain,Request $request)
          {
            Visits_type::where('id',$request->id)->delete();
            return back()->with('success', 'Delete successfully.');
             
          }
}
