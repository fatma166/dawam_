<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Attendance;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\URL;
use App\Models\Workflow;
use App\Models\Shift;
use App\Models\User_shift;
use Yajra\DataTables\CollectionDataTable;
use DateTime;
use App\Models\Outdoor;
use App\Models\Branch;
use App\Models\Role;
use App\Models\Holiday;
use Carbon\CarbonPeriod;
use App\Models\ExceptionHolidays;
use App\Models\Department;
use App\Models\employee_evaluation;
use App\Traits\Admin\Reports\DailyReport;
use App\Traits\Admin\Reports\MonthReport;
use App\Traits\EvaluationEmployeTrait;

class UsersDataTable extends DataTable
{
      use DailyReport;
       use MOnthReport;   
           use EvaluationEmployeTrait;  

    //public $manger_branch_id;
    //public $manger_department_id;
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {   $date1= Carbon::now();
        $date=$date1->format('Y-m-d');
        $company=Company::select('companies.*')->join('users','users.company_id','=','companies.id')->where('users.id',Auth::user()->id)->first();
        
        
        $roles=Auth::user()->role()->first();                  
        if($roles['name']=="manger") {

          $manger_branch_id= Auth::user()->branch_id;
          
          $manger_department_id= Auth::user()->department_id;
        }else{
          $manger_branch_id= $manger_department_id='all'  ;
        }
        /*$present_array= Attendance::select('attendances.user_id')
                                    ->where('attendances.company_id',$company->id)
                                    ->whereDate('attendances.created_at', '=',$date)
                                    ->get();
        $query= Attendance::select('users.name','users.id aS EmployeeId','attendances.id as attend_id','attendances.*')->where('users.company_id',$company->id)->join('users', 'users.id', '=', 'attendances.user_id')
                          ->whereNotIn('users.id',$present_array)->orderBy('attend_id');
       
       */
        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri_segments = explode('/', $uri_path);

        
        $type= $uri_segments[3];
         $search=$_GET;
     

            //print_r($search); exit;
        if(!empty($search['date_from'])|| !empty($search['date_to'])||!empty($search['department'])||!empty($search['branch'])||!empty($search['user'])){
            //$month=$search['month']; 
             if(isset($search['date_from']))$date_from= $search['date_from'];else $date_from='all';
             if(isset($search['date_to'])) $date_to= $search['date_to']; else $date_to='all';
             if(isset($search['department'])) $department= $search['department'];else $department='all';
             if(isset($search['branch']))$branch= $search['branch']; else $branch='all'; 
             if(isset($search['user']))$user=$search['user']; else $user='all';
        }else{
            $date_from=$date_to=$user=$branch=$department='all';
        }
        if(isset($search['id'])) $user=$search['id'];
    if($type=="absent"){
         
            $query= $this->getAbsent($company,$department,$branch,$user,$date_from,$date_to,$date,$manger_branch_id,$manger_department_id,$type);
                           

    }elseif($type=="total"){
       // DB::enableQueryLog(); 
            $query= $this->getTotal($company,$department,$branch,$user,$date_from,$date_to,$date,$manger_branch_id,$manger_department_id,$type);
                            
                               
              // $query = DB::getQueryLog();print_r($query);exit;
       
    }
    elseif($type=="early"||$type=="late"||$type=="present"){
 
             $results= $this->getPersent($company,$department,$branch,$user,$date_from,$date_to,$date,$manger_branch_id,$manger_department_id,$type);
           //print_r($results);exit;
            foreach($results as $index=>$result){
                if($result['attendances_details']!=[]){
                    if (str_contains($result['attendances_details'], 'client')&& $result['attendances_details']!=[]) { 
                       $clients =json_decode($result['attendances_details']);
                       $client_arr="";
                        foreach($clients as $client){
                            $client_arr .=$client->client_name." ,";
                            
                        }
                        $results[$index]['attendances_details']=__('trans.client_attendance')."\n".$client_arr;
                        
                    }
                    elseif(str_contains($result['attendances_details'], 'branch')&& $result['attendances_details']!=[]){
                       $branches =json_decode($result['attendances_details']);
                     // echo $index."/";
                       $branch_arr="";
                        foreach($branches as $branch){
                            
                            $branch_arr .=$branch->branch_name." ,";
                            
                        }
                        $results[$index]['attendances_details']=__('trans.branch_attendance').$branch_arr;
                    }else{
                        $results[$index]['attendances_details']=__('trans.none detected')."\r".$result['address'];
                    }
                }else{
                    $results[$index]['attendances_details']=__('trans.none detected')."\r".$result['address']; 
                }
            
            }
             $collection =collect($results);
            return  DataTables::of($collection);            

    }elseif($type=="monthly"){

        
         $branchs=Branch::where('company_id',$company->id)->get();
         $departments=Department::where('company_id', $company->id)->get();
         $employees=User::select('users.*','departments.title as dep_title','branches.title as branch_title')->where('users.company_id',$company->id)->join('departments', 'departments.id', '=', 'users.department_id')->join('branches', 'branches.id', '=', 'users.branch_id')
         
                         ->where('users.id', '!=' , Auth::user()->id)
                         ->Where(function($query1) use ($manger_branch_id,$manger_department_id){
                                           if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                 $query1->where('users.branch_id',$manger_branch_id);
                                           if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                 $query1->where('users.department_id',$manger_department_id);
                                                           
                         })
                         ->where('users.active',1)
                         ->where('users.bassma',1)
                         ->get();
        
        $now = Carbon::now();
 
        $search= $_GET;
        $month=$now->month;
        $type="not_ajax";    
        if(!empty($search)){$type="ajax";}
            //print_r($search); exit;
        if(!empty($search['date_from'])|| !empty($search['date_to'])||!empty($search['department'])||!empty($search['branch'])||!empty($search['user'])){
            //$month=$search['month']; 
            $date_from=$search['date_from']? $search['date_from']:Carbon::now()->format('Y')."-".$month."-".'1'; 
             $date_to=$search['date_to']? $search['date_to']:Carbon::now();
             $department= $search['department']? $search['department']:'all';
             $branch=$search['branch']? $search['branch']:'all'; 
             $user=$search['user']? $search['user']:'all';
              if($search['user']=="null"){$user='all';}
             if($user!='all'||$department!='all'||$branchs!='all'){
               // $employees=User::select('users.*','departments.title as dep_title','branches.title as branch_title')->where('users.company_id',$company->id)->join('departments', 'departments.id', '=', 'users.department_id')->join('branches', 'branches.id', '=', 'users.branch_id')->where('users.id',$user)->get();
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
        
        //if(empty($search['date_from'])) $date_from='1'.".".$month.".".Carbon::now()->format('Y');
        //if(empty($search['date_to'])) $date_to=Carbon::now()->daysInMonth.".".$month.".".Carbon::now()->format('Y');
        if(isset($search['year'])){
            $year =$search['year'];
        }else{
            
            $year=$now->year;
        }
        $monthly=$this->getMonthReport($employees,$company,$user,$date_from,$date_to,$month,$manger_branch_id,$manger_department_id,$type);
        $collection =collect($monthly);
       return  DataTables::of($collection);
       
       
       
    }elseif($type=="visit"){
         $now = Carbon::now();
        $search= $_GET;
        $month=$now->month;
        
        $from=((isset($search['from'])&&$search['from'])==""||!isset($search['from']))?Carbon::now()->format('Y')."-".$month."-".'1':$search['from'];
        $to=((isset($search['to'])&&$search['to']=="")||!isset($search['to']))?Carbon::now():$search['to'];
       
        if(isset($search['created_by']))$created_by=$search['created_by']; else $created_by='all';
        if(isset($search['status']))$status=$search['status']; else $status='all';
        $is_registered=(isset($search['is_registered']))?$search['is_registered']:'all';
         
       if(isset($search['user_id'])) $user=$search['user_id']?$search['user_id']:'all';
       if(isset($search['user_id'])&&$search['user_id']!='null')$user=$search['user_id'];else $user='all';
       // $customer_id=$search['customer_id']??'all';
        if(isset($search['customer_id']))$client=$search['customer_id'];else $client='all';
        if($client=='null')$client='all';
        if($user=='null')$user='all';
        
       $visit_type=$search['visit_type']??'all';
      // print_r($search); exit;

             if($user!='all'){
                $employees=User::where('id',$user)->where('users.active',1)
                                                  ->where('users.bassma',1)->get();
             }else{
                $employees=User::select('users.*')->where('company_id',$company->id)
                               ->where('users.id', '!=' , Auth::user()->id)
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
            

             
             
           //  DB::enableQueryLog();
             $outdoors=/*Outdoor::select('outdoors.*','users.name as employeeName','clients.name as client_name','outdoor_attendances.*','outdoor_attendances.created_at as attendance_date','outdoors.id as outdoors_id','outdoor_attendance_attachments.outdoor_attendance_id','outdoor_attendance_attachments.avatar as outdoor_img','outdoor_attendance_attachments.lati','outdoor_attendance_attachments.longi','outdoor_attendance_attachments.type','outdoor_attendance_attachments.address','departments.title as dep_title','branches.title as branch_title','outdoors.rate','visits_types.name as visit_type_name')
                               ->join('outdoor_attendances', 'outdoor_attendances.outdoor_id', '=', 'outdoors.id')
                                ->leftjoin('outdoor_attendance_attachments', 'outdoor_attendance_attachments.outdoor_attendance_id', '=', 'outdoor_attendances.id')
                                 ->join('visits_types','visits_types.id', '=', 'outdoors.visit_type_id')
                                 
                                ->where('outdoors.company_id',$company->id)
                                ->where('outdoor_attendance_attachments.type','in')
                                ->join('users', 'users.id', '=', 'outdoors.user_id')
                                 ->leftjoin('departments', 'departments.id', '=', 'users.department_id')
                                 ->join('branches', 'branches.id', '=', 'users.branch_id') 
                                 ->leftjoin('clients','clients.id', '=','outdoors.customer_id')
                                 ->Where(function($query) use ($user,$from,$to,$visit_type,$department,$branch,$customer_id) {
                                    if($user!='all'&&$user!=null){
                                        $query->where('users.id','=' ,$user);
                                    }
                                    if($department!='all')
                                         $query->where('users.department_id',$department);
                                    if($branch!='all')
                                         $query->where('users.branch_id',$branch);
                                    if($from!='all'){
                                        $query->whereDate('outdoor_attendances.created_at','>=' ,$from);
                                    }
                                    if($to!='all'){
                                        $query->whereDate('outdoor_attendances.created_at','<=' ,$to);
                                    }
                                    if($visit_type!='all'){
                                        $query->where('outdoors.visit_type_id','>=' ,$visit_type);
                                    }
                                    if($customer_id !='all'&&$customer_id!='null')
                                        $query->where('outdoors.customer_id',$customer_id);
                                    })
                                   ->Where(function($query1) use ($manger_branch_id,$manger_department_id){
                                           if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                 $query1->where('users.branch_id',$manger_branch_id);
                                           if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                 $query1->where('users.department_id',$manger_department_id);
                                                           
                                   })
                                ->get();*/
                               
                            Outdoor::select('outdoors.*','users.name as employeeName','clients.name as client_name','outdoor_attendances.time_in','outdoor_attendances.time_out','outdoor_attendances.created_at as attendance_date','outdoors.id as outdoors_id','outdoor_attendance_attachments.outdoor_attendance_id','outdoor_attendance_attachments.avatar as outdoor_img','outdoor_attendance_attachments.lati','outdoor_attendance_attachments.longi','outdoor_attendance_attachments.type','outdoor_attendance_attachments.address','departments.title as dep_title','branches.title as branch_title','outdoors.rate','visits_types.name as visit_type_name')
                             ->join('outdoor_attendances', 'outdoor_attendances.outdoor_id', '=', 'outdoors.id')
                             ->leftjoin('outdoor_attendance_attachments', 'outdoor_attendance_attachments.outdoor_attendance_id', '=', 'outdoor_attendances.id')
                            ->join('users','users.id', '=', 'outdoors.user_id')
                            ->join('visits_types','visits_types.id', '=', 'outdoors.visit_type_id')
                             ->leftjoin('clients','clients.id', '=', 'outdoors.customer_id')
                             ->join('departments', 'departments.id', '=', 'users.department_id')
                             ->join('branches', 'branches.id', '=', 'users.branch_id') 
                            ->where('outdoors.company_id',$company->id)
                            ->Where(function($query1) use ($user) {
                                if($user!='all'){
                                    $query1->Where('users.id',$user);
                                }
                            })
                              
                            ->Where(function($query) use ($created_by,$status,$from,$to,$visit_type,$department,$branch,$client,$manger_branch_id,$manger_department_id,$month,$is_registered) {
                      
                                if($status!='all'&&!empty($status)){
                                    $query->where('outdoors.status',$status);
                                }
                                if($is_registered!='all'){
                                        $query->where('outdoors.is_registered',$is_registered);
                                }
                                if($client!='all'){
                                    $query->where('outdoors.customer_id',$client);
                                }
                                if($created_by!='all'&&!empty($created_by)){
                                    $query->where('outdoors.created_by',$created_by);
                                }
                                if($from=='all')
                                         $query->whereMonth('outdoor_attendances.created_at',$month);
                                if($from!='all'){
                                       
                                        $query->whereDate('outdoor_attendances.created_at','>=' ,$from);
                                }          
                                if($to!='all'&&!empty($to)){
                                        
                                    $query->whereDate('outdoor_attendances.created_at','<=' ,$to);
                                }
                                if($visit_type!='all'){
                                    $query->where('outdoors.visit_type_id','=' ,$visit_type);
                                }
                                if($department!='all')
                                    $query->where('users.department_id',$department);
                                if($branch!='all')
                                    $query->where('users.branch_id',$branch);
                                
                      
                                     if($from!='all'&&!empty($from)){
                                        $query->whereDate('outdoor_attendances.created_at','>=' ,$from);
                                    }
                                    if($to!='all'&&(!empty($to))){
                                        $query->whereDate('outdoor_attendances.created_at','<=' ,$to);
                                    }         
                                if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                    $query->where('users.branch_id',$manger_branch_id);
                                if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                    $query->Where('users.department_id',$manger_department_id);
                                       
                  
                                })
                               ->where('users.active',1)
                               ->where('users.bassma',1)
                             ->orderBy('outdoors.date','desc')->get();
             
          // $query= DB::getQueryLog();
                              //  print_r($query);exit; 
             $out=array();
             foreach($outdoors as $index=>$outdoor){
               
                $out_attach_data= DB::table('outdoor_attendance_attachments')->where('outdoor_attendance_id',$outdoor['outdoor_attendance_id'])->where('type','out')->first();
                 $out[$index]['Visit Title']=$outdoor['title'];
                 $out[$index]['employeeName']=$outdoor['employeeName'];
                 $out[$index]['client name']=$outdoor['client_name'];
                 $out[$index]['visit_type_name']=$outdoor['visit_type_name'];
                 $out[$index]['visitin']=$outdoor['time_in'];
                 $out[$index]['visit in location']=$outdoor['address'];
                 $out[$index]['visit out']=$outdoor['time_out'];
                 

                 if(isset($out_attach_data->address)){
                    $out[$index]['visit out location']=$out_attach_data->address;
                 }else{
                    $out[$index]['visit out location']="";
                 }
                 $out[$index]['status']=$outdoor['status'];
                 $out[$index]['is_registered']=($outdoor['is_registered']==1)?__('trans.done'):__('trans.No');
                 $out[$index]['date']=$outdoor['attendance_date'];
                 $out[$index]['dep_title']=$outdoor['dep_title'];
                 $out[$index]['branch_title']=$outdoor['branch_title'];
                 $out[$index]['rate']=$outdoor['rate']."%";
             }
                $collection =collect($out);
                return  DataTables::of($collection);
                
                
             
        
        
    }elseif($type=="visit_type"){
     
        $now = Carbon::now();
        $search= $_GET;
        $month=$now->month;

       $visit_type=$search['visit_type']??'all';
       $from=((isset($search['from'])&&$search['from'])==""||!isset($search['from']))?Carbon::now()->format('Y')."-".$month."-".'1':$search['from'];
        $to=((isset($search['to'])&&$search['to']=="")||!isset($search['to']))?Carbon::now():$search['to'];
         
        if(isset($search['user_id'])) $user=$search['user_id']?$search['user_id']:'all';
        $department_cond=$user_cond="";
        if($user!='all'&&$user!='null'){
         
            $user_cond=" and `user_id` =". $user;
       }
       if($from!='all'){
            $from_cond=" and ( `date` BETWEEN '".$from."' AND '". $to ."' )" ;
           
        }
       /**
 *  if($to!='all'){
 *             
 *              $to_cond=" and `date` <=".;
 *         }
 */
        if($department!='all'){
             $department_cond=" and `department_id`=".$department;
             $department_select=",`department_id`";
             }else{
                $department_select=$department_cond=""; 
             }
        if($branch!='all'){
             $branch_cond=" and `branch_id`=".$branch." ";
             $branch_select=$branch_group=",`branch_id`";
          
        }else{
            $branch_select=$branch_group="";
          
        }     
      // print_r($search); exit;
            $visitTypeReports=array();
             if($visit_type!='all'){
                  DB::enableQueryLog();
                //  $visitTypeReports= DB::select(DB::raw("SELECT `question_text`,`name`,`answer_value`, `question_id` ,`chose_answer`,`type`,`visit_type_id`,COUNT(chose_answer) AS COUNT_NUMBER FROM V  GROUP BY `question_id`,`chose_answer`,`type`,`visit_type_id` having `type` != 'text' AND `chose_answer` IS NOT NULL and `visit_type_id` =". $visit_type ));
                    $visitTypeReports= DB::select(DB::raw("SELECT `question_text`,`name`,`answer_value`".$branch_select.",`date`".$department_select.",concat('(',group_concat(`outdoor_id`),')' )outdoor_ids,`question_id` ,`chose_answer`,`type`,`visit_type_id`,COUNT(chose_answer) AS COUNT_NUMBER FROM V  GROUP BY `question_id`,`chose_answer`,`type`,`visit_type_id`".$branch_group." having `type` != 'text'  and `visit_type_id` =". $visit_type.$user_cond.$branch_cond.$department_cond.$from_cond ));            
                                  // $query= DB::getQueryLog();
                              //  print_r($query);exit;
             }
            
//
           //print_r($visitTypeReports); exit;   
             
     $visitquestionanswers=array();
      $answers=array();
       $i=0;
       $question=0;
     foreach($visitTypeReports as $index=>$visitTypeReport){
       
        if($visitTypeReports[$index]->question_id==$visitTypeReport->question_id){
            if($question !=$visitTypeReport->question_id)$i=0;
          $visitquestionanswers[$visitTypeReport->question_id]['question_text']=$visitTypeReports[$index]->question_text;
          $visitquestionanswers[$visitTypeReport->question_id]['name']=$visitTypeReports[$index]->name;                 
          $visitquestionanswers[$visitTypeReport->question_id]['question_answers'.$i]=$visitTypeReports[$index]->answer_value."    ".$visitTypeReports[$index]->COUNT_NUMBER;
           ++$i;
        }
          $question=$visitTypeReports[$index]->question_id;
     }
 
    
             
        
//print_r($visitquestionanswers); exit;
        $collection =collect($visitquestionanswers);
        return  DataTables::of($collection);
                
                
             
        
        
    }elseif($type=="userReport"){
            $query= Attendance::select('users.name','attendances.created_at as date','users.id aS EmployeeId','attendances.id as attend_id','attendances.time_in','attendances.time_out')
                                ->join('users', 'users.id', '=', 'attendances.user_id')
                                //->whereDate('attendances.created_at', '=',$date)
                                ->where('users.company_id',$company->id)->orderBy('attend_id')
                                ->where('attendances.status','!=','absent')
                                ->where('users.id','!=',Auth::user()->id)
                                ->Where(function($query) use ($department,$branch,$user,$date_from,$date_to,$date){
                                    if($user!='all'&& $user!='null')
                                         $query->where('users.id',$user);
                                    if($department!='all')
                                         $query->where('users.department_id',$department);
                                    if($branch!='all')
                                         $query->where('users.branch_id',$branch);
                                    if($date_from=='all'&&$date_to=='all'){
                                         $query->whereDate('attendances.created_at', '=',$date);
                                    }elseif($date_from!='all'&&$date_to=='all'){
                                         $query->whereDate('attendances.created_at','>=', $date_from);
                                         $query->whereDate('attendances.created_at','<=', $date);
                                    }elseif($date_from=='all'&&$date_to!='all'){
                                         $query->whereDate('attendances.created_at','>=', $date);
                                         $query->whereDate('attendances.created_at','<=', $date_to);
                                    }else{
                                        if($date_from!='all')
                                             $query->whereDate('attendances.created_at','>=', $date_from);
                                        if($date_to!='all')
                                             $query->whereDate('attendances.created_at','<=', $date_to);
                                    }
                                    
                                    })
                                    ->Where(function($query1) use ($manger_branch_id,$manger_department_id){
                                           if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                 $query1->where('users.branch_id',$manger_branch_id);
                                           if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                 $query1->where('users.department_id',$manger_department_id);
                                                           
                                   });

        
    }
    
    //evalaution_report
     elseif($type=="evalaution")
    {
         //strt
             $search=$_GET;
            $roles_=Role::where('company_id',$company->id)->wherein('name',['super_admin','admin','manger'])->pluck('id');
            if(isset($search['department']))$department=$search['department'];else $department='all';
             if(isset($search['branch'])) $branch=$search['branch']; else $branch='all'; 
             if(isset($search['user'])&&$search['user']!='null') $user=$search['user'];else $user='all';
             if(isset($search['from_month'])&& $search['from_month']!='NaN')$from_month=$search['from_month']; else $from_month='';
             if(isset($search['from_year']) && $search['from_year']!='NaN')  $from_year=$search['from_year']; else  $from_year='';
             if(isset($search['to_month'])&& $search['to_month']!='NaN')$to_month=$search['to_month']; else $to_month='';
             if(isset($search['to_year'])&& $search['to_year']!='NaN')  $to_year=$search['to_year']; else  $to_year='';
             $empevalu=employee_evaluation::select('employee_evaluations.*','users.name', "branches.title as branch_name"
            ,'departments.title as department_name','jobs.title as job_name','users.job_id as job_id')
            ->join("users","users.id","=","employee_evaluations.user_id")
            ->join("branches", "users.branch_id", "=", "branches.id")
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->Join("jobs","users.job_id", "=", "jobs.id")             
            
             ->Where(function($query) use($roles_,$company)
     {
               
           $query->whereNotIn('users.role_id', $roles_)
           ->orwhere('users.role_id', "=", null);
           $query->where('users.company_id',"=", $company->id);
                  
     })
     ->Where(function($query1) use ($department,$branch,$user)
     {
               if($department!='all')
                    {
                      $query1->where('users.department_id','=',$department);
                    }

                 if($branch!='all')
                  {
                       $query1->where('users.branch_id','=',$branch);
                     
                  }
                    if($user!='all')
                  {
                       $query1->where('users.id','=',$user);
                             
                  }
                  
                 })
      ->Where(function($query1) use ($from_month,$from_year,$to_month,$to_year) 
                 {

                         if($from_month !='' && $from_year !='')
                             {
                                 $query1->where('month','>=', $from_month);
                                 $query1->where('year','>=', $from_year);
                             }
                          
                          if($to_month !='' && $to_year !='')
                             {
                                 $query1->where('month','<=', $to_month);
                                 $query1->where('year','<=', $to_year);
                             }
                           
                   })
                     ->where('users.id', '!=' , Auth::user()->id)
                     ->Where(function($query1) use ($manger_branch_id,$manger_department_id){
                                       if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                             $query1->where('users.branch_id',$manger_branch_id);
                                       if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                             $query1->where('users.department_id',$manger_department_id);
                                                       
                     })
                     ->where('users.active',1)
                     ->where('users.bassma',1)

                     ->get();

  
                   $monthly=$this->evalution_report($empevalu);
                
                $collection =collect($monthly);
                return  DataTables::of($collection);  
     
    }
 //evalaution_report
    
    
    
        return datatables()
            ->eloquent($query);
         //   ->addColumn('action', 'users.action');
  
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        //Button::make('create'),
                        Button::make('export'),
                        Button::make('print')
                       // Button::make('reset'),
                       // Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {

        $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri_segments = explode('/', $uri_path);

        
        $type= $uri_segments[3];
        if($type=="visit"){
            return [
                Column::make('Visit Title'),
                Column::make('employeeName'),
                Column::make('client name'),
                Column::make('visit_type_name'),
                Column::make('visitin'),
                Column::make('visit in location'),
                Column::make('visit out'),
                Column::make('visit out location'),
                Column::make('status'),
                Column::make('is_registered'),
                Column::make('date'),
                Column::make('dep_title'),
                Column::make('branch_title'),
                Column::make('rate'),
        
            ];
       }elseif($type=="visit_type"){
            return [
         
                Column::make('question_text'),
                Column::make('name'),
                Column::make('question_answers0'),
                Column::make('question_answers1'),
                Column::make('question_answers2'),
                Column::make('question_answers3'),
               // Column::make('question_answers4'),
               // Column::make('COUNT_NUMBER'),
             
        
            ]; 
        
        }elseif($type=="userReport"){
                        return [
               /* Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),*/
                Column::make('date'),
                Column::make('name'),
                Column::make('time_in'),
                Column::make('time_out'),   
                
        
            ];
        }
        elseif($type == "absent"){
            return [
               /* Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),*/
                Column::make('EmployeeId'),
                Column::make('name'),
               
                Column::make('dep_title'),
                Column::make('branch_title'),
                
        
            ];
        }
        elseif($type=="evalaution"){
         
         //  return [
            //   Column::make('id'),
            //   Column::make('Employe_Name'),
            //   Column::make('evaluation_month'),
             //  Column::make('Evaluation_Year'),
             //  Column::make('job'),
            //   Column::make('department'),
             //  Column::make('branch'),
             // Column::make('evaluation_degree'),
             // Column::make('Total_Evaluation'),
          
        
           // ];
            
             return [
               
          ["name"=>"id","data"=>"id","title"=>__('trans.Employee_id')],
          ["name"=>"Employe_Name","data"=>"Employe_Name","title"=>__('trans.Employee')],
          ["name"=>"evaluation_month","data"=>"evaluation_month","title"=> __('trans.evaluation_month') ],
          ["name"=>"Evaluation_Year","data"=>"Evaluation_Year","title"=> __('trans.Evaluation_Year') ],
          ["name"=>"job","data"=>"job","title"=> __('trans.employe_job') ],
          ["name"=>"department","data"=>"department","title"=> __('trans.department') ],
          ["name"=>"branch","data"=>"branch","title"=> __('trans.branch') ],
          ["name"=>"Total_Evaluation","data"=>"Total_Evaluation","title"=> __('trans.Total_evalaution') ],
           ];
           
        }
        elseif($type != "monthly"){
            return [
               /* Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),*/
                Column::make('EmployeeId'),
                Column::make('name'),
                Column::make('time_in'),
                Column::make('time_out'),
                Column::make('Date'),
                Column::make('dep_title'),
                Column::make('branch_title'),
                Column::make('attendances_details'),
        
            ];
        }

        else{
            return [
 
         
                Column::make('employeeId'),
                Column::make('name'),
                
                Column::make('logged_time'),
                Column::make('avg_hours_daily'),
                Column::make('present'),
                Column::make('absent'),
                Column::make('fixed_holiday'),
                Column::make('exception_holiday'),
                Column::make('leave_request_count'),
                 Column::make('leave_request_hours_count'),
                
                Column::make('late_count'),
                Column::make('total_late_coming'),
                Column::make('total_early_leave'),
                Column::make('withoutBsma'),
                Column::make('department'),
                Column::make('branch'),
        
            ];
             return [
           ["name"=>"name","data"=>"user_name","title"=>__("trans.Empolyee")],
           ["name"=>"user_logs.action","data"=>"action","title"=>__('trans.process')],
           ["name"=>"user_logs.description","data"=>"description","title"=>__('trans.Description')],
           ["name"=>"user_logs.datetime","data"=>"datetime","title"=> __('trans.Time') ],
           ["data"=>"setting","title"=> __('trans.setting') ],
        ];            
        }
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
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
