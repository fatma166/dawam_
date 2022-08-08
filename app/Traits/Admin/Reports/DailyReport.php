<?php
namespace App\Traits\Admin\Reports;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
trait DailyReport
{

    public function getPersent($company,$department,$branch,$user,$date_from,$date_to,$date,$manger_branch_id,$manger_department_id,$type)
    {
        

      return(  Attendance::select('users.name','users.id aS EmployeeId','attendance_attachments.address','attendances.id as attend_id','attendances.time_in','attendances.time_out','attendances.attendances_details','attendances.created_at as Date','departments.title as dep_title','branches.title as branch_title')
                                ->join('users', 'users.id', '=', 'attendances.user_id')
                                 ->join('departments', 'departments.id', '=', 'users.department_id')
                                 ->join('branches', 'branches.id', '=', 'users.branch_id')
                                 
                                
                                
                               ->join('attendance_attachments', 'attendance_attachments.attendance_id', '=', 'attendances.id')
                               ->where('attendance_attachments.type',"in")
                                //->whereDate('attendances.created_at', '=',$date)
                                ->where('users.company_id',$company->id)->orderBy('attend_id')
                                ->where('attendances.status','!=','absent')
                                ->where('users.id','!=',Auth::user()->id)
                                ->Where(function($query) use ($department,$branch,$user,$date_from,$date_to,$date,$manger_branch_id,$manger_department_id,$type){
                                   if($type=="late")
                                         $query->where('attendances.description','LIKE', '%'."late".'%');
                                   
                                   if($type=="early")
                                         $query->where('attendances.description','LIKE', '%'."before_leave".'%');
                                   
                                    if($user!='all'&& $user!='null'&&!empty($user))
                                         $query->where('users.id',$user);
                                    if($department!='all')  
                                         $query->where('users.department_id',$department);
                                    if($branch!='all')
                                   
                                         $query->where('users.branch_id',$branch);
                                       
                                       if($date_from!='all'&&$date_from!="")
                                             $query->whereDate('attendances.created_at','>=', $date_from);
                                            
                                        if($date_to!='all'&&$date_to!="")
                                            
                                           $query->whereDate('attendances.created_at','<=', $date_to);
                                    
                                        if($date_from=='all'&&$date_to=='all')
                                           $query->whereDate('attendances.created_at', '=',$date);
                                        if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                           $query->where('users.branch_id',$manger_branch_id);
                                        if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                           $query->where('users.department_id',$manger_department_id);
                                    })
                                    ->where('users.active',1)
                                    ->where('users.bassma',1)->get()->toArray());

    }
  public function getTotal($company,$department,$branch,$user,$date_from,$date_to,$date,$manger_branch_id,$manger_department_id,$type){
       return( Attendance::select('users.name','users.id aS EmployeeId','attendances.id as attend_id','attendances.time_in','attendances.time_out','attendances.created_at as Date','departments.title as dep_title','branches.title as branch_title')
                                ->join('users', 'users.id', '=', 'attendances.user_id')
                                ->join('departments', 'departments.id', '=', 'users.department_id')
                                ->join('branches', 'branches.id', '=', 'users.branch_id')
                                //->whereDate('attendances.created_at', '=',$date)
                                ->where('users.company_id',$company->id)
                                ->where('users.id','<>',Auth::user()->id)
                                ->Where(function($query) use ($department,$branch,$user,$date_from,$date_to,$date,$manger_branch_id,$manger_department_id,$type){
              
                                    if($user!='all'&& $user!='null'&&!empty($user))
                                         $query->where('users.id',$user);
                                    if($department!='all')
                                         $query->where('users.department_id',$department);
                                    if($branch!='all')
                                         $query->where('users.branch_id',$branch);
                                         
                                    if($date_from=='all'&&$date_to=='all'){
                                           $query->whereDate('attendances.created_at', '=',$date);
                                    }else{
                                       if($date_from!='all')
                                             $query->whereDate('attendances.created_at','>=', $date_from);
                                            
                                        if($date_to!='all')
                                            
                                           $query->whereDate('attendances.created_at','<=', $date_to);
                                    }
                                        
                                   if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                       $query->where('users.branch_id',$manger_branch_id);
                                    if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                           $query->where('users.department_id',$manger_department_id);
                                         
                                    })
                                    
                                ->orderBy('attend_id')
                                ->where('users.active',1)
                                ->where('users.bassma',1)); 
    }
    public function getAbsent($company,$department,$branch,$user,$date_from,$date_to,$date,$manger_branch_id,$manger_department_id,$type){
        $present_array= Attendance::select('attendances.user_id')
                                    ->join('users', 'users.id', '=', 'attendances.user_id')
                                                                        
                                    ->where('attendances.company_id',$company->id)
                                    //
                                    ->where('users.company_id',$company->id)
                                    ->where('users.id', '!=', Auth::user()->id)
                                    ->where('status','!=','absent')
                                    ->where('users.active',1)
                                    ->where('users.bassma',1)
                                    
                                    ->get();
           // $query = DB::getQueryLog();print_r($query);exit;
                               //    print_r($present_array);
                 //  DB::enableQueryLog();                   
           return( User::select('users.name','users.id aS EmployeeId','departments.title as dep_title','branches.title as branch_title')
                                   ->join('departments', 'departments.id', '=', 'users.department_id')
                                   ->join('branches', 'branches.id', '=', 'users.branch_id')
                                   ->where('users.id', '!=', Auth::user()->id)
                                   ->where('users.company_id',$company->id)
                                   ->where('users.active',1)
                                   ->where('users.bassma',1)
                                   ->Where(function($query) use ($department,$branch,$user,$date_from,$date_to,$date){
                                        
                                        if($user!='all'&& $user!='null')
                                         $query->where('users.id',$user);
                                        if($department!='all')
                                             $query->where('users.department_id',$department);
                                        if($branch!='all')
                                        $query->where('users.branch_id',$branch);
                                       
                                     })
                                   ->whereNotIn('users.id',$present_array));
      
      
        
        
    }

}
