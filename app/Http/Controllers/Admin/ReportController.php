<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use  App\Http\Controllers\Admin\BaseController;
use App\Models\Department;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
/*use App\Models\Workflow;
use App\Models\Shift;
use App\Models\User_shift;*/
use App\Models\User;
use App\DataTables\UsersDataTable;
use App\Models\Branch;
/*use App\Models\Zone;
use App\Models\Holiday;
use Carbon\CarbonPeriod;
use App\Models\ExceptionHolidays;*/
use Illuminate\Support\Facades\Auth;use DateTime;
use App\Traits\Admin\Reports\MonthReport;
use App\Traits\Admin\Reports\DailyReport;

class ReportController extends BaseController
{
      use DailyReport;    
       use MonthReport;            
     public static $hol_key_day;
    public function department_report($subdomain){
      
        $company=$this->company;

        $manger_branch_id= $this->branch_id;
        $manger_department_id= $this->department_id;
        
        $departments=$this->department->getDep($company->id,$manger_department_id);
        $date1= Carbon::now();
        $date=$date1->format('Y-m-d');
        $dep_report= array();
        foreach($departments as $index=> $department){
            $dep_report[$index]['dep_name']=$department->title;
            $total=User::select(DB::raw('COUNT(users.id) as total'))
                                  ->where('users.department_id',$department->id)
                                  ->where('users.id', '!=' , Auth::user()->id)
                                  ->where('users.active',1)
                                  ->where('users.bassma',1)
                                  ->first();
            $dep_report[$index]['total']=$total['total'];
        
            $present=Attendance::select( DB::raw('COUNT(attendances.user_id) as present'))
                                            ->join('users', 'users.id', '=', 'attendances.user_id')
                                            ->where('users.department_id',$department->id)
                                            ->where('users.id', '!=' , Auth::user()->id)
                                            ->where('attendances.status','!=','absent')
                                            ->whereDate('attendances.created_at', $date)
                                            ->where('users.active',1)
                                            ->where('users.bassma',1)
                                            ->first();
            $dep_report[$index]['present']= $present['present'];
            $dep_report[$index]['absent']= $dep_report[$index]['total']-$dep_report[$index]['present'];
            $late=Attendance::select( DB::raw('COUNT(attendances.user_id) as late'))
                                                    ->join('users', 'users.id', '=', 'attendances.user_id')
                                                    ->where('attendances.description','LIKE', '%'."late".'%')
                                                    ->where('users.department_id',$department->id)
                                                     ->where('attendances.status','!=','absent')
                                                    ->where('users.id', '!=' , Auth::user()->id)
                                                    ->whereDate('attendances.created_at', $date)
                                                    ->where('users.active',1)
                                                    ->where('users.bassma',1)
                                                    ->first();
            $dep_report[$index]['late_comers']=$late['late'];
            $early=Attendance::select( DB::raw('COUNT(attendances.user_id) as early'))
                                                    ->join('users', 'users.id', '=', 'attendances.user_id')
                                                    ->where('attendances.description','LIKE', '%'."before_leave".'%')
                                                    ->where('users.department_id',$department->id)
                                                     ->where('attendances.status','!=','absent')
                                                    ->where('users.id', '!=' , Auth::user()->id)
                                                    ->whereDate('attendances.created_at', $date)
                                                     ->where('users.active',1)
                                                    ->where('users.bassma',1)
                                                    ->first();
            $dep_report[$index]['early_leave']=$early['early'];

        }
      
        
        return view('reports.department_report')->with(compact('dep_report','subdomain'));
    }
    public function dialyPrint($subdomain,$type='total',UsersDataTable $dataTable){

        return $dataTable->render('users');
    }
    public function monthlyPrint($subdomain,$type='monthly',UsersDataTable $dataTable)
    {
      
        return $dataTable->render('users');
    }
  
    public function evaluationprint($subdomain,$type='evalaution',UsersDataTable $dataTable)
    {
      
      // print_r('test');die;
        return $dataTable->render('users');
    }
  
  
    
    public function userReportPrint($subdomain,$type='userReport',UsersDataTable $dataTable)
    {
      
        return $dataTable->render('users');
    }
    public function dialyReport($subdomain,Request $request,$type="present"){
        //$company=Company::join('users','users.company_id','=','companies.id')->where(array('users.id'=>Auth::user()->id,'role_id'=>1))->first();
       // $users=User::where('company_id',$company->id)->get();
        $company=$this->company;
        $manger_branch_id= $this->branch_id;
        $manger_department_id= $this->department_id; 
        $comp_id=$company->id;
        $branchs=$this->branch->getBranch($comp_id,$manger_branch_id);
        $departments=$this->department->getDep($comp_id,$manger_department_id);
                               
          $search=$request->all();
          if(!empty($search)){

             $department= $search['department']? $search['department']:'all';
             $branch=$search['branch']??'all'; 
             $user=$search['user']? $search['user']:'all';
              if(isset($search['date_from'])&&!empty($search['date_from'])) $date_from=$search['date_from']; else $date_from='all';
              if(isset($search['date_to'])&&!empty($search['date_to']))$date_to=$search['date_to'];else $date_to='all';

               
        }else{
           // $employees=User::select('users.*','departments.title as dep_title','branches.title as branch_title')->where('users.company_id',$company->id)->join('departments', 'departments.id', '=', 'users.department_id')->join('branches', 'branches.id', '=', 'users.branch_id')->get();
            $department=$branch= $user=$date_from=$date_to='all'; 
      
        //}
        }
          $employees=User::select('users.*','departments.title as dep_title','branches.title as branch_title')
                 ->where('users.company_id',$company->id)->join('departments', 'departments.id', '=', 'users.department_id')
                 ->join('branches', 'branches.id', '=', 'users.branch_id')
                 
                 ->Where(function($query) use ($manger_branch_id,$manger_department_id,$user,$department,$branch){
                         if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                              $query->where('users.branch_id',$manger_branch_id);
                         if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                              $query->where('users.department_id',$manger_department_id);
                              
                         if($user!='all')
                              $query->where('users.id',$user);  
                         if($department!='all')  
                              $query->where('users.department_id',$department); 
                          if($branch!='all')
                              $query->where('users.branch_id',$branch);
                 })
                 ->where('users.active',1)
                 ->where('users.bassma',1)
                 ->get();

        $date1= Carbon::now();
        $date=$date1->format('Y-m-d');
        $total=User::select(DB::raw('COUNT(users.id) as total'))
                        ->where('users.company_id',$company->id)
                       ->where('users.id', '!=' , Auth::user()->id)
                        ->first();
        $search=$request->all();

        $date1=Carbon::now();
        $date=$date1->format('Y-m-d');
       if($request->ajax()){
        
            $type=$search['type'];
        
        }
                 
    if($type=="absent"){
     // DB::enableQueryLog(); 
                   $attendances=$this->getAbsent($company,$department,$branch,$user,"","",$date,$manger_branch_id,$manger_department_id,$type)
                                    ->get();

    }elseif($type=="total"){
      //if($request->ajax()){  echo $branch; exit;}
        DB::enableQueryLog(); 
                    $attendances=$this->getTotal($company,$department,$branch,$user,$date_from,$date_to,$date,$manger_branch_id,$manger_department_id,$type)
                                    ->get();
             //  $query = DB::getQueryLog();print_r($query);exit;
       
    }
    else{
   

                     $attendances=$this->getPersent($company,$department,$branch,$user,$date_from,$date_to,$date,$manger_branch_id,$manger_department_id,$type)
                                   ;

    }
    if($request->ajax()){
         return view('reports.report_ajax.dialy_ajax')->with(compact('attendances','type','subdomain'));
    }else{
         return view('reports.dialy_report')->with(compact('attendances','departments','branchs','employees','type','subdomain'));
         }
    }
    
    
   

    /*
    MONTH REPORT
    
    
    */
    public function monthReport($subdomain,Request $request){
        
        //$company=Company::join('users','users.company_id','=','companies.id')->where(array('users.id'=>Auth::user()->id,'role_id'=>1))->first();
       // $employees=User::where('company_id',$company->id)->get();
        $company=$this->company;
        $manger_branch_id= $this->branch_id;
        $manger_department_id= $this->department_id; 
        $branchs=$this->branch->getBranch($company->id,$manger_branch_id);
        $departments=$this->department->getDep($company->id,$manger_department_id);
       $employees=User::select('users.*','departments.title as dep_title','branches.title as branch_title')->where('users.company_id',$company->id)->join('departments', 'departments.id', '=', 'users.department_id')->join('branches', 'branches.id', '=', 'users.branch_id')
                        ->Where(function($query1) use ($manger_branch_id,$manger_department_id){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query1->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query1->where('users.department_id',$manger_department_id);
                                   
                         })  
                        ->where('users.active',1)
                        ->where('users.bassma',1)
                        ->where('users.id', '!=' , Auth::user()->id)->get();
        
        $now = Carbon::now();
        $search= $request->all();
        
        $month=$now->month;
        $type="not_ajax";    
        if($request->ajax()){$type="ajax";}

        if(!empty($search)){
            //$month=$search['month']; 
             $date_from=$search['date_from']??Carbon::now()->format('Y')."-".$month."-".'1'; 
             $date_to=$search['date_to']??Carbon::now();
             $department= $search['department']??'all';
             $branch=$search['branch']??'all'; 
             $user=$search['user']??'all';
            // if($search['user']=="null"){$user='all';}
             if($user!='all'||$department!='all'||$branch!='all'){
              //$employees=User::select('users.*','departments.title as dep_title','branches.title as branch_title')->where('users.company_id',$company->id)->join('departments', 'departments.id', '=', 'users.department_id')->join('branches', 'branches.id', '=', 'users.branch_id')->where('users.id',$user)->get();
            
                $employees=User::select('users.*','departments.title as dep_title','branches.title as branch_title')
                                ->where('users.company_id',$company->id)
                                ->join('departments', 'departments.id', '=', 'users.department_id')
                                ->join('branches', 'branches.id', '=', 'users.branch_id')
                                ->Where(function($query) use ($department,$branch,$user){
                                    if($user!='all')
                                       $query->where('users.id',$user);
                                    if($department!='all')
                                        $query->where('users.department_id',$department);
                                    if($branch!='all')
                                        $query->where('users.branch_id',$branch);
                                    })
                                    
                                    ->Where(function($query1) use ($manger_branch_id,$manger_department_id){
                                                            if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                                 $query1->where('users.branch_id',$manger_branch_id);
                                                            if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                                 $query1->where('users.department_id',$manger_department_id);
                                       
                                    })  
                                    
                              ->where('users.active',1)
                              ->where('users.bassma',1)
                              ->get();
            
            
            
            
             }
               
        }else{
             $date_from=Carbon::now()->format('Y')."-".$month."-".'1';
             $date_to=Carbon::now()->format('Y')."-".$month."-".Carbon::now()->day;
            
            $department=$branch= $user='all'; 
      
        }
       // echo $date_from; echo $date_to; exit;
        
        if(isset($search['year'])){
            $year =$search['year'];
        }else{
            
            $year=$now->year;
        }
        $monthly=$this->getMonthReport($employees,$company,$user,$date_from,$date_to,$month,$manger_branch_id,$manger_department_id,$type);

        if($type!="ajax"){
                return view('reports.monthly_report')->with(compact('monthly','type','departments','branchs','employees','subdomain'));  
        }else{
                return view('reports.month_ajax')->with(compact('monthly','type','departments','branchs','employees','subdomain'));
        }

    }
    
    /**
     * 
     *  user Report 
     * 
     */
    
    
    public function userReport($subdomain,$id,Request $request){
        echo $id;
        $company=$this->company;
        $now = Carbon::now();
        $search= $request->all();
        $month=$now->month;
        $type="not_ajax";   
       // print_r($request->all()); exit; 
      
       
        if($request->ajax()){ $type="ajax"; }
        if(isset($search['date_from']) || isset($search['date_to'])){
            
             $date_from=$search['date_from']? $search['date_from']:Carbon::now()->format('Y')."-".$month."-".'1'; 
             $date_to=$search['date_to']? $search['date_to']:Carbon::now(); 
   
        }else{
             $date_from=Carbon::now()->format('Y')."-".$month."-".'1';
             $date_to=Carbon::now()->format('Y')."-".$month."-".Carbon::now()->daysInMonth;
        }
        $start_date =Carbon::parse($date_from);
        $end_date =Carbon::parse($date_to);    
        $days = $start_date->diffInDays($end_date); 
       
        if(isset($search['year'])){
            $year =$search['year'];
        }else{
            
            $year=$now->year;          
        }
       
        if(isset($search['id'])){
            $user=$search['id'];
        }else{
            $user=$id;
                    
        }
       
       
        
        $attendDaymonthly=array();
        $user_data=User::where('id',$id)->first();   
     
        $day_number=$start_date->day;
        
        for($day=0; $day<=$days;$day++){
                 /*$daysinmonth=Carbon::parse($start_date)->daysInMonth;
                 if($start_date->month != $end_date->month){
                    $month=$start_date->month;
                 }
                 if($day== $daysinmonth){
                  
                   $day=1;
                   $month=$end_date->month; 
                 }
                  
                $date= $year."-".$month."-".$day;
                 */
             
                 $date=$start_date->addDays($day);
                 $start_date =Carbon::parse($date_from);
               
                 $attendDaymonthly["'".$date->format('Y-m-d')."'"]=Attendance::select('users.name','users.id','attendances.*','attendances.time_in','attendances.time_out')
                                                    ->join('users', 'users.id', '=', 'attendances.user_id')
                                                    ->whereDate('attendances.created_at', '=',$date)
                                                    ->where('users.company_id',$company->id)
                                                    ->where('users.id', '!=' , Auth::user()->id)
                                                    ->where('users.id', '=' , $user)
                                                    ->distinct((DB::raw('DATE(created_at)')))
                                                    ->get()->toArray();
                             
         }
       
     // print_r($attendDaymonthly); exit;
        
        if($type!="ajax"){
                return view('reports.userRerport')->with(compact('attendDaymonthly','day_number','user_data','date_from','date_to','subdomain'));  
        }else{
           
                
                return view('reports.userRerport_ajax')->with(compact('attendDaymonthly','day_number','user_data','subdomain'));
        }
                

 }
 function sum_the_time($time1, $time2) {
      $times = array($time1, $time2);
      $seconds = 0;
      foreach ($times as $time)
      {
        list($hour,$minute,$second) = explode(':', $time);
        $seconds += $hour*3600;
        $seconds += $minute*60;
        $seconds += $second;
      }
      $hours = floor($seconds/3600);
      $seconds -= $hours*3600;
      $minutes  = floor($seconds/60);
      $seconds -= $minutes*60;
      if($seconds < 9)
      {
      $seconds = "0".$seconds;
      }
      if($minutes < 9)
      {
      $minutes = "0".$minutes;
      }
        if($hours < 9)
      {
      $hours = "0".$hours;
      }
      return "{$hours}:{$minutes}:{$seconds}";
    }

    
}
