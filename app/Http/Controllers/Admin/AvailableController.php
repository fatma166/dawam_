<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Role;
use App\Models\Company;
use App\Models\Client;
use App\Models\Outdoor;
use App\Models\Attendance;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class AvailableController extends BaseController
{
    /**
     *  Available EMPLOYEE 
     */

    public function index($subdomain,Request $request,$type){
       $company_check=$this->company;
       $manger_branch_id= $this->branch_id;
       $manger_department_id= $this->department_id;
       
       $users= User::join('branches','branches.id','=','branch_id')->join('jobs','jobs.id','=','users.job_id')
                   ->select('users.*','branches.id as branch_id','branches.title as branch_title','jobs.id as job_id','jobs.title as job_title')
                   ->where('users.id', '!=' , Auth::user()->id)
                                     
                   ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query->where('users.department_id',$manger_department_id);
                                       
                    })->where('users.company_id',$company_check->id)
                   ->get(); 
  
       $branchs=Branch::where('company_id', $company_check->id)->get();

       $date=Carbon::now();
       $clients=Client::where('company_id',$company_check->id)->get();
       $branch=$request->branch??'all';
       $employee=$request->employee_name??'all';
       $client=$request->client??'all';
       $attendance= Attendance::select('users.*',
            'branches.id as branch_id', 'branches.title as branch_title', 'attendances.*',
            'attendances.id as attendance_id', 'attendance_attachments.avatar as attend_img',
         
            'attendance_attachments.type', 'attendance_attachments.address')->join('attendance_attachments',
            'attendance_attachments.attendance_id', '=', 'attendances.id')->join('branches',
            'branches.id', '=', 'attendances.branch_id')->join('users', 'users.id', '=','attendances.user_id')
          
            ->whereDate('attendances.created_at',$date)
            ->where('attendance_attachments.type',"in")
            ->Where(function($query) use ($type,$branch,$client,$employee){
                if($type=="branch"){
                    $query->Where('attendances.attendances_details', 'like', '%' . "branch". '%');
                }
                if($type=="client"){
                    $query->Where('attendances.attendances_details', 'like', '%' . "client". '%');
                }
                if($type=="not_dected"){
                    $query->Where('attendances.attendances_details', 'not like', '%' . "client". '%');
                     $query->Where('attendances.attendances_details', 'not like', '%' . "branch". '%');
                }
                if($branch!='all')
                 $query->Where('attendances.branch_id',$branch);
                if($client!='all')
                 $query->Where('attendances.attendances_details', 'like', '%' .$client);
               if($employee!='all'&&$employee!=null)
                 $query->Where('attendances.user_id',$employee);
                
            })->where('users.company_id',$company_check->id)
                
           ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query->where('users.department_id',$manger_department_id);
                                       
           })
            ->orderBy('attendances.created_at', 'asc')->distinct('attendances.user_id')/*->distinct((DB::raw('DATE(attendances.created_at)')))*/
            ->paginate(8);
     
        if($request->ajax()){
             return view('available_employee.search',array('users'=>$users,'branchs'=>$branchs,'attendances'=>$attendance,'clients'=>$clients,'type'=>$type,'subdomain'=>$subdomain));
        }else{
             return view('available_employee.available',array('users'=>$users,'branchs'=>$branchs,'attendances'=>$attendance,'clients'=>$clients,'type'=>$type,'subdomain'=>$subdomain));
        }
    }
  
   
}
