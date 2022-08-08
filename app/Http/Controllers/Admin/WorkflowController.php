<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use  App\Models\Workflow;
use App\Models\ExceptionHolidays;
use App\Models\User;
use App\Models\Company;
use App\Models\Shift;
use Illuminate\Support\Facades\Auth;

class WorkflowController extends BaseController
{
    //
    function index($subdomain){
        $company=$this->company;
        $workflow=Workflow::where('company_id',$company->id)->get()->groupBy('shift_id');

        $shift=Shift::where('company_id',$company->id)->get();
       
        return view('workflow.index',['shifts'=>$shift,'workflows'=>$workflow,'subdomain'=>$subdomain]);
    }
    function create($subdomain){
      
        return view('workflow.add',compact('subdomain'));

    }
    /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
      public function store ($subdomain, Request $request)
      {
        $workflow_requests=$request->all(); 
        $company=$this->company;
        $work_=Workflow::where(array('company_id'=>$company->id,'shift_id'=>$workflow_requests['shift_id']))->get();
       
        if(!empty($work_)){
          
            foreach($workflow_requests['mints'] as $index=>$workflow_request){
                $workflow=array('minutes'=>$workflow_request?$workflow_request:0,'shift_id'=>$workflow_requests['shift_id'],'hours'=>$workflow_requests['hours'][$index]?$workflow_requests['hours'][$index]:0,'description'=>$workflow_requests['desc'][$index]?$workflow_requests['desc'][$index]:'','type'=>$workflow_requests['type'][$index],'company_id'=>$company->id);
                $workflow=Workflow::create($workflow);
            }
        
            if(!is_null($workflow)) {
                
                return back()->with('success', ' added successfully.');
            }
            // else return with error message
            else {
                
                return back()->with('error','messages.error');
            }
        }else{
         
            return back()->with('error', ' shift added before');
        }
 
  
      }

    public function edit($subdomain,$shift_id){
      $workflow=Workflow::select('workflows.*','shifts.title as shift_title')->where('shift_id',$shift_id)->join('shifts','shifts.id','=','workflows.shift_id')->get();
     
      return response()->json($workflow);
    }
    public function update($subdomain,Request $request, $id){
        Workflow::where('shift_id',$id)->delete();
        $company=$this->company;
        $request_flow=$request->all();
        //print_r($request_flow);
        foreach($request_flow['type'] as $index=>$type){
            $workflow['shift_id']=$id;
            $workflow['company_id']=$company->id;
            $workflow['minutes']=$request_flow['mints'][$index]?$request_flow['mints'][$index]:0;
            $workflow['hours']=$request_flow['hours'][$index]?$request_flow['hours'][$index]:0;
            $workflow['description']=$request_flow['desc'][$index]?$request_flow['desc'][$index]:"";
            $workflow['type']=$type;
            Workflow::create($workflow);

        }
 
        return redirect()->route('workflow'); 
    }
    public function delete($subdomain,Request $request)
    {
        Workflow::where('shift_id',$request->id)->delete();
       
    }
}
