<?php
namespace App\Traits\Admin\Reports;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Workflow;
use App\Models\Shift;
use App\Models\User_shift;
use App\Models\Zone;
use App\Models\Holiday;
use App\Models\Client;
use App\Models\Leave_request;
use App\Models\ExceptionHolidays;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateTime;
trait MonthReport
{

    public function getMonthReport($employees,$company,$user,$date_from,$date_to,$month,$manger_branch_id,$manger_department_id,$type)
    {

       $monthly=array();
        foreach($employees as $employee){
                $monthly[$employee->id]['employeeId']=$employee->id;
                $monthly[$employee->id]['name']=$employee->name;
                DB::enableQueryLog();


                $logged=Attendance::select(DB::raw("SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(time_out, time_in)))) as total_log"))
                                  ->join('users','users.id','attendances.user_id')
                                  ->where('user_id',$employee->id)
                                  ->distinct((DB::raw('DATE(created_at)')))
                                  ->Where(function($query) use (/*$department,$branch,*/$user,$date_from,$date_to,$month,$manger_branch_id,$manger_department_id) {
                                    
                                  /*if($department!='all')
                                        $query->where('users.department_id',$department);
                                    if($branch!='all'){
                                        $query->where('users.branch_id',$branch);
                                    }*/
                                    if($date_from=='all'){
                                        $query->whereMonth('attendances.created_at', '=', $month);
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
                                  })->where('attendances.status','!=','absent')
                                
                                
                                
                                ->get();
                               

                $monthly[$employee->id]['withoutBsma']=Attendance::where('attendances.time_out',null)->where('user_id',$employee->id)
                                                                 ->Where(function($query) use (/*$department,$branch,*/$user,$date_from,$date_to,$month,$manger_branch_id,$manger_department_id)
                                                                  { if($date_from=='all'){$query->whereMonth('attendances.created_at', '=', $month);
                                                                   }else{ if($date_from!='all')$query->whereDate('attendances.created_at','>=', $date_from);
                                                                        if($date_to!='all')
                                                                             $query->whereDate('attendances.created_at','<=', $date_to);
                                                                   }
                                      
                                                                })->distinct((DB::raw('DATE(created_at)')))->count();
              if(isset($logged[0]->total_log)){
                $monthly[$employee->id]['logged_time']=$logged[0]->total_log;
                }else{
                     $monthly[$employee->id]['logged_time']='00:00:00';
                }
               // DB::enableQueryLog();
                $monthly[$employee->id]['present']= Attendance::where('user_id',$employee->id)->distinct((DB::raw('DATE(created_at)')))
                                                               ->Where(function($query) use (/*$department,$branch,*/$user,$date_from,$date_to,$month,$manger_branch_id,$manger_department_id) {
                                    
                                                                   /* if($department!='all')
                                                                        $query->where('users.department_id',$department);
                                                                    if($branch!='all'){
                                                                        $query->where('users.branch_id',$branch);
                                                                    }*/
                                                                    if($date_from=='all'){
                                                                        $query->whereMonth('attendances.created_at', '=', $month);
                                                                    }else{
                                                                        if($date_from!='all')
                                                                             $query->whereDate('attendances.created_at','>=', $date_from);
                                                                    
                                                                        if($date_to!='all')
                                                                             $query->whereDate('attendances.created_at','<=', $date_to);
                                                                   }
                           
                                                                })
                                                            ->where('status','!=','absent')->count();
                                      //$query = DB::getQueryLog();
//print_r($query);exit; 
                 $logged1=Attendance::select(DB::raw("SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(time_out, time_in)))) as avg_log"))
                                  ->join('users','users.id','attendances.user_id')
                                  ->where('user_id',$employee->id)
                                  ->distinct((DB::raw('DATE(created_at)')))
                                  ->Where(function($query) use (/*$department,$branch,*/$user,$date_from,$date_to,$month,$manger_branch_id,$manger_department_id) {
                                    
                                  /*if($department!='all')
                                        $query->where('users.department_id',$department);
                                    if($branch!='all'){
                                        $query->where('users.branch_id',$branch);
                                    }*/
                                    if($date_from=='all'){
                                        $query->whereMonth('attendances.created_at', '=', $month);
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
                                    })->where('attendances.status','!=','absent')
                                
                                
                                
                                ->get();
                if(isset($logged1[0]->avg_log)){
                    $monthly[$employee->id]['avg_hours_daily']=Carbon::parse($logged1[0]->avg_log)->format('h:i:s');
                }else{
                     $monthly[$employee->id]['avg_hours_daily']='00:00:00';
                }
                           
                $holiday=Holiday::where('company_id',$company->id)->first();
              
                if(isset($holiday->day)) {
                    $holiday_array=json_decode($holiday->day);
                  
                    $exception_holiday=0;
                        $holiday_=[];
                        foreach($holiday_array as $hol_key => $val){
                           
                           
                            $hol_key1 = [];
                            if($hol_key=="saturday")
                                $startDate= Carbon::parse($date_from)->next(Carbon::SATURDAY); // Get the first friday.
                            elseif($hol_key=="sunday"){
                                 $startDate= Carbon::parse($date_from)->next(Carbon::SUNDAY); // Get the first friday.
                            }
                             elseif($hol_key=="monday"){
                                 $startDate= Carbon::parse($date_from)->next(Carbon::MONDAY); // Get the first friday.
                            }
                            elseif($hol_key=="thursday"){
                                 $startDate= Carbon::parse($date_from)->next(Carbon::THURSDAY); // Get the first friday.
                            }
                            elseif($hol_key=="wednsday"){
                                 $startDate= Carbon::parse($date_from)->next(Carbon::WEDNSDAY); // Get the first friday.
                            }
                            elseif($hol_key=="tuesday"){
                            
                               
                                 $startDate= Carbon::parse($date_from)->next(Carbon::TUESDAY); // Get the first friday.
                       
                            }
                            elseif($hol_key=="friday"){
                                 $startDate= Carbon::parse($date_from)->next(Carbon::FRIDAY); // Get the first friday.
                            }
                           
                            $endDate = Carbon::parse($date_to);
                             
                            for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {
                                $hol_key1[] = $date->format('Y-m-d');
                            }
                             
                            $holiday_=array_merge($hol_key1,$holiday_);
                        }
                       
                } else{
                        $holiday_= array();
                }
              //print_r(count($holiday_)); exit;
                    $exception_holiday_array=ExceptionHolidays::whereDate('date_from','>=',$date_from)->whereDate('date_to','<=',$date_to)->where('company_id',$company->id)->get()->toarray();
                  
                   $exception_holiday_days=0;
                   foreach($exception_holiday_array as $ex_array){
                        $exception_holiday_days+=(Carbon::parse($ex_array['date_from'])->diffInDays(Carbon::parse($ex_array['date_to']))+1);
                   }
                   $leave_request_counts=Leave_request::join('leave_types','leave_types.id','=','leave_requests.leave_type_id')->where('leave_requests.company_id',$company->id)->where('leave_requests.status','accepted')->where('user_id',$employee->id)->where('leave_types.name','!=','Hours')->Where(function($query) use ($date_from,$date_to,$month) {
                                    
                                                                     
                                                                        if($date_from=='all'){
                                                                            $query->whereMonth('leave_requests.created_at', '=', $month);
                                                                        }else{
                                                                            if($date_from!='all')
                                                                                 $query->whereDate('leave_requests.leave_from','>=',$date_from);
                                                                                 
                                                                            if($date_to!='all')
                                                                                  $query->whereDate('leave_requests.leave_to','<=',$date_to);
                                                                       }
                                           
                                                     })->get()->toarray();
                
                   $leave_request_count=0;
                   foreach($leave_request_counts as $leave_count){
                        $leave_request_count+=(Carbon::parse($leave_count['leave_from'])->diffInDays(Carbon::parse($leave_count['leave_to']))+1);
                   }
                  
                  $monthly[$employee->id]['leave_request_count']=$leave_request_count;
                  $monthly[$employee->id]['leave_request_hours_count']=Leave_request::join('leave_types','leave_types.id','=','leave_requests.leave_type_id')->where('leave_requests.company_id',$company->id)->where('leave_requests.status','accepted')->where('user_id',$employee->id)->where('leave_types.name','=','Hours')->Where(function($query) use ($date_from,$date_to,$month) {
                                    
                                                                     
                                                                        if($date_from=='all'){
                                                                            $query->whereMonth('leave_requests.created_at', '=', $month);
                                                                        }else{
                                                                            if($date_from!='all')
                                                                                 $query->whereDate('leave_requests.leave_from','>=',$date_from);
                                                                                 
                                                                            if($date_to!='all')
                                                                                  $query->whereDate('leave_requests.leave_to','<=',$date_to);
                                                                       }
                                            })->count();
                 
                    $monthly[$employee->id]['fixed_holiday']= count($holiday_);
                    $monthly[$employee->id]['exception_holiday']= $exception_holiday_days;
                    if($type=="not_ajax"){
                         $start_date =Carbon::parse($date_from);
                         $end_date =Carbon::parse($date_to);
                         $days = $start_date->diffInDays($end_date);
                         $monthly[$employee->id]['absent']= ($days+1)- $monthly[$employee->id]['present']-$exception_holiday_days-count($holiday_);
                    }   
                    else{
                                           // $days = CarbonPeriod::create($date_from, $date_to);
                         $start_date =Carbon::parse($date_from);
                         $end_date =Carbon::parse($date_to);
                         $days = $start_date->diffInDays($end_date); 
                        // echo  $days;exit;
                        $monthly[$employee->id]['absent']=($days+1)- $monthly[$employee->id]['present']-$exception_holiday_days-count($holiday_);
                        // $exception_holiday=count(ExceptionHolidays::whereDate('created_at','>=',$date_from)->whereMonth('created_at', '=', $month)->get());

                    }
               
                $monthly[$employee->id]['late_count']= Attendance::where('user_id',$employee->id)->where('status','Attendance_discount')->distinct((DB::raw('DATE(created_at)')))
                                                                 ->Where(function($query) use (/*$department,$branch,*/$user,$date_from,$date_to,$month,$manger_branch_id,$manger_department_id) {
                                    
                                                                      /*  if($department!='all')
                                                                            $query->where('users.department_id',$department);
                                                                        if($branch!='all'){
                                                                            $query->where('users.branch_id',$branch);
                                                                        }*/
                                                                        if($date_from=='all'){
                                                                            $query->whereMonth('attendances.created_at', '=', $month);
                                                                        }else{
                                                                            if($date_from!='all')
                                                                                 $query->whereDate('attendances.created_at','>=', $date_from);
                                                                            if($date_to!='all')
                                                                                 $query->whereDate('attendances.created_at','<=', $date_to);
                                                                       }
                                           
                                                                    })
                                                                 ->where('attendances.description','LIKE', '%'."late".'%')->where('status','Attendance_discount')->count();
                
                $monthly[$employee->id]['clients']= Client::where('user_id',$employee->id)->distinct((DB::raw('DATE(created_at)')))
                                                          ->Where(function($query) use ($user,$date_from,$date_to,$month,$manger_branch_id,$manger_department_id) {
                                                                if($date_from=='all'){
                                                                    $query->whereMonth('clients.created_at', '=', $month);
                                                                }else{
                                                                    if($date_from!='all')
                                                                         $query->whereDate('clients.created_at','>=', $date_from);
                                                                    if($date_to!='all')
                                                                         $query->whereDate('clients.created_at','<=', $date_to);
                                                               }
                                   
                                                            })->count();
                
                $lates= Attendance::where('user_id',$employee->id)->where('status','Attendance_discount')->distinct((DB::raw('DATE(created_at)')))
                               ->Where(function($query) use (/*$department,$branch,*/$user,$date_from,$date_to,$month,$manger_branch_id,$manger_department_id) {
                                    
                                  /*  if($department!='all')
                                        $query->where('users.department_id',$department);
                                    if($branch!='all'){
                                        $query->where('users.branch_id',$branch);
                                    }*/
                                    if($date_from=='all'){
                                        $query->whereMonth('attendances.created_at', '=', $month);
                                    }else{
                                        if($date_from!='all')
                                             $query->whereDate('attendances.created_at','>=', $date_from);
                                        if($date_to!='all')
                                             $query->whereDate('attendances.created_at','<=', $date_to);
                                   }
                        
                                })->where('attendances.description','LIKE', '%'."late".'%')->get();
                $workflow_allowed_late=Workflow::where('company_id',$company->id)->where('type','late')->first();
               if(!empty($workflow_allowed_late)){
                $allowedlate=$workflow_allowed_late['hours'].':'.$workflow_allowed_late['minutes'].':'.'00';
                }else{  
                    $allowedlate='00:00:00';
                }
                $custom_shift=array();
                $late_day='00:00:00';
                //print_r($lates); exit;
                if(!empty($lates)){
                    foreach($lates as $late){
                        $custom_shift=User_shift::where('user_shifts.user_id',$employee->id)->whereDate('date',$late->created_at)->first();
                        if(!empty($custom_shift)){
                     
                            $total_allow= new DateTime($this->sum_the_time($custom_shift['time_in'], $allowedlate));
                           
                            $diff=$total_allow->diff(new DateTime($late->time_in))->format('%H:%I:%S');
                            
                            $late_day=$this->sum_the_time($diff,$late_day); 
                            
                        }else{
                            $shift=Shift::where('shifts.id',$employee->shift_id)->first();  
                           // print_r($shift); exit;
                            $total_allow=new DateTime( $this->sum_the_time($shift['time_from'], $allowedlate));
                            $diff=$total_allow->diff(new DateTime($late->time_in))->format('%H:%I:%S');
                            $late_day=$this->sum_the_time($diff,$late_day); 

                        }
                    }
                }
              
                $monthly[$employee->id]['total_late_coming']= $late_day; 
                
                $monthly[$employee->id]['total_early_leave_count']= Attendance::where('user_id',$employee->id)->distinct((DB::raw('DATE(created_at)')))
                                                                              ->Where(function($query) use (/*$department,$branch,*/$user,$date_from,$date_to,$month,$manger_branch_id,$manger_department_id) {
                                    
                                                                                   /* if($department!='all')
                                                                                        $query->where('users.department_id',$department);
                                                                                    if($branch!='all'){
                                                                                        $query->where('users.branch_id',$branch);
                                                                                     }*/
                                                                                    if($date_from=='all'){
                                                                                     $query->whereMonth('attendances.created_at', '=', $month);
                                                                                        }else{
                                                                                            if($date_from!='all')
                                                                                                 $query->whereDate('attendances.created_at','>=', $date_from);
                                                                                            if($date_to!='all')
                                                                                                 $query->whereDate('attendances.created_at','<=', $date_to);
                                                                                   }
                                                                     
                                                                                })->where('attendances.description','LIKE', '%'."before_leave".'%')->where('status','Attendance_discount')->count();
                
                $beforleaves=Attendance::where('user_id',$employee->id)->where('status','Attendance_discount')->distinct((DB::raw('DATE(created_at)')))
                                                ->Where(function($query) use (/*$department,$branch,*/$user,$date_from,$date_to,$month,$manger_branch_id,$manger_department_id) {
                                                
                                                /*if($department!='all')
                                                    $query->where('users.department_id',$department);
                                                if($branch!='all'){
                                                    $query->where('users.branch_id',$branch);
                                                }*/
                                                if($date_from=='all'){
                                                    $query->whereMonth('attendances.created_at', '=', $month);
                                                }else{
                                                    if($date_from!='all')
                                                         $query->whereDate('attendances.created_at','>=', $date_from);
                                                    if($date_to!='all')
                                                         $query->whereDate('attendances.created_at','<=', $date_to);
                                               }
                                   
                                            })
                                        ->where('attendances.description','LIKE', '%'."before_leave".'%')->where('status','Attendance_discount')->get();
                $workflow_allowed_before_leave=Workflow::where('company_id',$company->id)->where('type','before_leave')->first();
                if(!empty($workflow_allowed_before_leave)){
                    $allowedbeforleave=new DateTime($workflow_allowed_before_leave['hours'].':'.$workflow_allowed_before_leave['minutes'].':'.'00');
                }else{
                    $allowedbeforleave=new DateTime('00:00:00');
                }
                $custom_shiftbefore_leave=array();
                $beforleaves_day='00:00:00';
                if(!empty($beforleaves)){
                    foreach($beforleaves as $beforleave){
                        $custom_shiftbefore_leave=User_shift::where('user_shifts.user_id',$employee->id)->whereDate('date',$beforleave->created_at)->first();
                    if(!empty($custom_shiftbefore_leave)){
                        
                         $total_allow_before = $allowedbeforleave->diff(new DateTime($custom_shiftbefore_leave['time_out']))->format('%H:%I:%S');
         
                         $log_out=new DateTime($beforleave->time_out);
                         $diff=$log_out->diff(new DateTime($total_allow_before))->format('%H:%I:%S');
                  
                         $beforleaves_day=$this->sum_the_time($diff,$beforleaves_day); 
                    }else{
                         $shift=Shift::where('shifts.id',$employee->shift_id)->first();  
                          $total_allow_before = $allowedbeforleave->diff(new DateTime($shift['time_to']))->format('%H:%I:%S');
         
                         $log_out=new DateTime($beforleave->time_out);
                         $diff=$log_out->diff(new DateTime($total_allow_before))->format('%H:%I:%S');
                  
                        $beforleaves_day=$this->sum_the_time($diff,$beforleaves_day); 
                       
                    }
                 }
                }
                
                $monthly[$employee->id]['total_early_leave']=$beforleaves_day;
                  $monthly[$employee->id]['department']=$employee->dep_title;
                 $monthly[$employee->id]['branch']=$employee->branch_title;

            /* $total_logged[$employee->id]= Sale::select(
                            DB::raw('commissioned_total as total - commission')
                        )
                        ->sum('commissioned_total');*/
        }
     return( $monthly);

}

}
