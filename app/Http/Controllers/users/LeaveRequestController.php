<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Leave_request;
use App\Models\Leave_type;
use App\Library\NotificationManager;
USE App\Contracts\ErrorMessages;
class LeaveRequestController extends Controller
{
    public function Index(Request $request,$id=null){



        if($id){
         return   $request->user()->leaveRequests()->with("leave_type")->find($id);
        }

       return $request->user()->LeaveRequests()->with("leave_type")->orderBy('created_at','desc')->get();
    }


    public function ViewTypes(Request $request){
        

           $company= $request->user()->company;
      return $company->leaveTypes;
    //    return leave_type::all(); return Leave_type::all();
    }
    
    public function checkExistRequestBefore($request,$from,$to){
        
      return($request->user()->LeaveRequests()->where('leave_from','>=',$from)->where('leave_to','<=',$to)->get()->toArray());
        
    }

    public function Request(Request $request){


        $req = Validator::make($request->all(), [

            'type_id' => 'required|exists:leave_types,id',
            'from'=>'required|after:yesterday|date_format:Y-m-d H:i:s',
            'to'=>'required|after_or_equal:from|date_format:Y-m-d H:i:s',
            'reason'=>'required',

        ]);
       

        if ($req->fails()) {
            return response()->json(['msg' => ErrorMessages::LEAVE_REQUEST_VALIDATION_ERROR], 422);
        }

        $leave_time=Leave_type::find($request->type_id);
        $requested_leave_time=date_diff(date_create($request->from),date_create($request->to));
        $requested_leave_days=$requested_leave_time->d+1;//$requested_leave_time->d==0?
        $requested_leave_hours=$requested_leave_time->h;
            

        if(($requested_leave_days > $leave_time->num_days&&$leave_time->name!='Hours') || ($requested_leave_hours > $leave_time->num_hours&&$leave_time->name=='Hours')){

            $data["msg"]="dates is not valid";
            // $data["required_date"]=$requested_leave_days.' '.$requested_leave_hours.'   '.$leave_time->num_days.'.'.$leave_time->num_hours;
            return response()->json(['msg' => ErrorMessages::LEAVE_REQUEST_DATES_IS_NOT_VALID_ERROR], 422);

        }
        
        


        $leaveRequest=new Leave_request();
        $leaveRequest->company_id= $request->user()->company_id;
        $leaveRequest->leave_from=$request->from;
        $leaveRequest->leave_to=$request->to;
        $leaveRequest->leave_type_id=$request->type_id;
        $leaveRequest->leave_reson=$request->reason;
        $leaveRequest->days=$requested_leave_days;
        $leaveRequest->num_hours=$requested_leave_hours;

        $check_exist=$this->checkExistRequestBefore($request,$leaveRequest->leave_from,$leaveRequest->leave_to);
      
        if(!empty($check_exist))return response()->json(['msg' => ErrorMessages::LEAVE_REQUEST_EXIST_BEFORE], 422);
        $leaveRequest=$request->user()->LeaveRequests()->save($leaveRequest);

        $NotificationManager=new NotificationManager();
        $NotificationManager->build($leaveRequest->id,"make_leave",$request);
        $NotificationManager->commit();

        $data["msg"]="sucess";
        return   $data;

    }
}

