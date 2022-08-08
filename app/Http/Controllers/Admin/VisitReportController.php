<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Outdoor;
use App\Models\Visits_type;
use App\Models\Visit_report;
use App\Models\Visits_question;
use App\Models\Company; 
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\DataTables\UsersDataTable;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Client; 
use App\Models\QuestionReeportAnswer;
use Illuminate\Support\Facades\DB;
class VisitReportController extends BaseController
{
    //
    public function index($subdomain,Request $request){
        $company=$this->company;
        $branchs=Branch::where('company_id', $company->id)->get();
        
        $manger_branch_id= $this->branch_id;
        $manger_department_id= $this->department_id;
  
        $departments=Department::where('company_id',$company->id)
        
                                ->Where(function($query) use ($manger_department_id){
                                       
                                        if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                             $query->where('departments.id',$manger_department_id);
                                       
                                  })
                               ->get();
        $branchs=Branch::where('company_id', $company->id)
                       ->Where(function($query) use ($manger_branch_id){
                                       
                          if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                              $query->Where('branches.id',$manger_branch_id);
                                       
                        })
        
                       ->get();
      
        
        //$users=User::where('company_id',$company->id)->where('users.id', '!=' , Auth::user()->id)->get();
        $visit_types=Visits_type::where('company_id',$company->id)->get();
        $now = Carbon::now();
        $month=$now->month;
        $outdoor=array();
        $answer=array();
        $now = Carbon::now();
        $month=$now->month;
        
        $search=$request->all();
      
         if(isset($search['user_id'])&&$search['user_id']!='null')$user_id=$search['user_id'];else $user_id='all';
         if(isset($search['customer_id'])&&$search['customer_id']!='null')$customer_id=$search['customer_id']; else $customer_id='all';
         $from=$search['from']??Carbon::now()->format('Y')."-".$month."-".'1';
         $to=$search['to']??Carbon::now();
                    
         if(isset($search['visit_type']))$visit_type=$search['visit_type'];else $visit_type='all';
         if(isset($search['department'])) $department=$search['department'];else $department='all';
         if(isset($search['branch']))  $branch=$search['branch']; else $branch='all'; 
         if(isset($search['created_by']))$created_by=$search['created_by']; else $created_by='all';
         if(isset($search['status']))$status=$search['status']; else $status='all';
         if(isset($search['is_registered']))$is_registered=$search['is_registered']; else $is_registered='all';
         $outdoor_ids=array();
         if(isset($search['outdoor_ids'])) {$outdoor_ids= substr($search['outdoor_ids'], 1, -1); $outdoor_ids= explode(',',$outdoor_ids); } else $outdoor_ids='all'; //foreach($outdoor_ids as $id){ $outdoor_ids[]=$id;} }//;
    
        $company=$this->company;   
        if($user_id!='all'){
            $users=User::where(array('company_id'=>$company->id,'id'=>$user_id))->where('users.id', '!=' , Auth::user()->id) ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                        if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                             $query->where('users.branch_id',$manger_branch_id);
                                        if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                             $query->where('users.department_id',$manger_department_id);
                                       
                            })->get();
        }else{
            $users=User::where('company_id',$company->id)->where('users.id', '!=' , Auth::user()->id) ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                        if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                             $query->where('users.branch_id',$manger_branch_id);
                                        if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                             $query->where('users.department_id',$manger_department_id);
                                       
                            })->get();
        }
          $outdoors=array();
      //  foreach($users as $user){
            /*$outdoor=Outdoor::select('clients.name as client_name','clients.address as client_address','clients.contact_phone','users.*','users.name as user_name','outdoors.id as leave_id','outdoors.*','outdoor_attendances.created_at as visit_date','outdoor_attendances.time_out','departments.title as dep_title','branches.title as branch_title')
                                ->join('outdoor_attendances', 'outdoor_attendances.outdoor_id', '=', 'outdoors.id')
                                ->join('users', 'users.id', '=', 'outdoor_attendances.user_id')
                                ->join('departments', 'departments.id', '=', 'users.department_id')
                                ->join('branches', 'branches.id', '=', 'users.branch_id')
                                ->leftjoin('clients', 'clients.id', '=', 'outdoors.customer_id') 
                                ->where('outdoors.company_id',$company->id)
                                 ->whereMonth('outdoors.created_at',$month)
                                //->get();
                                 ->paginate(15);*/
          //   DB::enableQueryLog();
             $outdoors=Outdoor::select('users.*','users.name as user_name','outdoors.id as leave_id','outdoors.*','outdoor_attendances.created_at as visit_date','outdoor_attendances.time_in','outdoor_attendances.time_out','users.id aS EmployeeId','departments.title as dep_title','branches.title as branch_title','clients.name as client_name','clients.address as client_address','clients.contact_phone','visits_types.name as visit_type_name')
                                ->join('outdoor_attendances', 'outdoor_attendances.outdoor_id', '=', 'outdoors.id')
                                ->join('users', 'users.id', '=', 'outdoor_attendances.user_id')
                                ->join('visits_types','visits_types.id', '=', 'outdoors.visit_type_id')
                                ->join('departments', 'departments.id', '=', 'users.department_id')
                                ->join('branches', 'branches.id', '=', 'users.branch_id') 
                                ->leftJoin('clients','clients.id','=','outdoors.customer_id')
                                ->where('outdoors.company_id',$company->id)
                                // ->whereMonth('outdoors.created_at',$month)        
                                ->Where(function($query) use ($user_id,$from,$to,$status,$created_by,$visit_type,$department,$branch,$customer_id,$manger_branch_id,$manger_department_id,$is_registered,$outdoor_ids) {
                                    if($status!='all'&&!empty($status)){
                                        $query->where('outdoors.status',$status);
                                    }
                                    if($is_registered!='all'){
                                        $query->where('outdoors.is_registered','=' ,$is_registered);
                                    }
                                  
                                    if($created_by!='all'&&!empty($created_by)){
                                        $query->where('outdoors.created_by',$created_by);
                                    }
                                    if($user_id!='all'){
                                        $query->where('users.id','=' ,$user_id);
                                    }
                                    
                                  if($outdoor_ids=='all'){
                                    if($from!='all'){
                                       
                                        $query->whereDate('outdoor_attendances.created_at','>=' ,$from);
                                    }
                                    if($to!='all'){
                                        
                                        $query->whereDate('outdoor_attendances.created_at','<=' ,$to);
                                    }
                                    }
                                    if($visit_type!='all'){
                                        $query->where('outdoors.visit_type_id','=' ,$visit_type);
                                    }
                                    if($department!='all')
                                        $query->where('users.department_id',$department);
                                    if($branch!='all')
                                        $query->where('users.branch_id',$branch);
                                     if($outdoor_ids!='all')
                                        $query->wherein('outdoors.id',$outdoor_ids);
                                      
                                     if($customer_id !='all')
                                        $query->where('outdoors.customer_id',$customer_id);
                                     if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                             $query->where('users.branch_id',$manger_branch_id);
                                     if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                             $query->where('users.department_id',$manger_department_id);
                                    })
                                   ->orderBy('outdoor_attendances.created_at','desc')   
                                 ->paginate(15)->appends('search',$request->all());
                                // $query= DB::getQueryLog();
                               // print_r($query);exit; 
            
           
      //  }
        
       // print_r($outdoor);
      //  print_r($question);
      // print_r( $answer);exit;
        $clients=Client::select('clients.*','client_types.name as client_type_name')->join('client_types','client_types.id','=','clients.client_type_id')->where('clients.company_id', $company->id)->get();
       if(!$request->ajax()){
             return view('outdoor_report.index',array('outdoors'=>$outdoors,'users'=>$users,'visit_types'=>$visit_types,'branchs'=>$branchs,'departments'=> $departments,'clients'=>$clients,'search'=>$search,'subdomain'=>$subdomain));
    
       }else{
            return view('outdoor_report.search',['outdoors'=>$outdoors,'search'=>$search,'subdomain'=>$subdomain]);
       }
        
}



  public function vistTypeReport($subdomain,Request $request){
        $now = Carbon::now();
        $month=$now->month;
        $company=$this->company;
        $branchs=Branch::where('company_id', $company->id)->get();
        
        $manger_branch_id= $this->branch_id;
        $manger_department_id= $this->department_id;
    
        $departments=Department::where('company_id',$company->id)
        
                                ->Where(function($query) use ($manger_department_id){
                                       
                                        if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                             $query->where('departments.id',$manger_department_id);
                                       
                                  })
                               ->get();
        $branchs=Branch::where('company_id', $company->id)
                       ->Where(function($query) use ($manger_branch_id){
                                       
                          if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                              $query->Where('branches.id',$manger_branch_id);
                                       
                        })
        
                       ->get();
        $visit_types=Visits_type::where('company_id',$company->id)->get();
      
       
        $outdoor=array();
        $answer=array();

        $search=$request->all();
      
       
      
         if(isset($search['user_id'])&&$search['user_id']!='null')$user_id=$search['user_id'];else $user_id='all';
       
         $from=$search['from']??Carbon::now()->format('Y')."-".$month."-".'1';
         $to=$search['to']??Carbon::now();
         if(isset($search['department'])) $department=$search['department'];else $department='all';
         if(isset($search['branch']))  $branch=$search['branch']; else $branch='all';            
         if(isset($search['visit_type']))$visit_type=$search['visit_type'];else $visit_type='all';

         $visitTypeReports=array();
         $user_cond=$from_cond=$to_cond=$department_cond=$branch_cond="";
        if($user_id!='all'){
            $user_cond=" and `user_id` =". $user_id;
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
        DB::enableQueryLog();
        $visitquestionanswers=$serach_name=array();
      $outdoors_ids=array();
        if($visit_type !='all'){
            
            
             $outdoors_ids=Outdoor::select('outdoors.id')
                            ->join('users','users.id', '=', 'outdoors.user_id')
                            ->join('visits_types','visits_types.id', '=', 'outdoors.visit_type_id')
                            
                             ->join('departments', 'departments.id', '=', 'users.department_id')
                            ->join('branches', 'branches.id', '=', 'users.branch_id') 
                          
                            ->Where(function($query1) use ($user_id) {
                                if($user_id!='all'){
                                    $query1->Where('users.id',$user_id);
                                }
                            })
                              
                            ->Where(function($query) use ($from,$to,$visit_type,$department,$branch,$manger_branch_id,$manger_department_id) {
                      
                               
                                    $query->where('outdoors.is_registered',1);
                              
                           
                                if($to!='all'){
                                        
                                    $query->whereDate('outdoors.date','<=' ,$to);
                                }
                               
                                    $query->where('outdoors.date','>=',$from);
                                    
                                if($visit_type!='all'){
                                    $query->where('outdoors.visit_type_id','=' ,$visit_type);
                                }
                              
                                  
                                
                                if($department!='all')
                                    $query->where('users.department_id',$department);
                                if($branch!='all')
                                    $query->where('users.branch_id',$branch);
                                
                      
                               /* if($to!='all'){
                                    $query->where('outdoors.date_to','<=' ,$to);
                                }*/

                                               
                                if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                    $query->where('users.branch_id',$manger_branch_id);
                                if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                    $query->Where('users.department_id',$manger_department_id);
                                       
                  
                                })
                               ->where('users.active',1)
                               ->where('users.bassma',1)
                             ->orderBy('outdoors.date','desc')   
                             ->get()->toArray();
                            
                      //$query= DB::getQueryLog();
                           //     print_r($query);exit ; 
                 $outdoor_ids=array(); 
                
               foreach($outdoors_ids as $id){$outdoor_ids[]=$id['id'];}
      $visitquestionanswers=array();
       if(!empty($outdoor_ids)){
               
             //  $visitTypeReports= DB::select(DB::raw("SELECT `question_text`,`answer_value`,`outdoor_id`,concat('(',group_concat(`outdoor_id`),')' )outdoor_ids,`question_id`,`type`,`visit_type_id`,COUNT(answer_value) AS COUNT_NUMBER FROM visit_reports JOIN visits_questions on visits_questions.id=visit_reports.question_id  GROUP BY `question_id`,`answer_value`,`type`,`visit_type_id` having  `outdoor_id` in(" . implode(",", array_map("intval", $outdoor_ids)).")" ."and `type` != 'text'  and `visit_type_id` =". $visit_type));             
             $visitTypeReports= DB::select(DB::raw("SELECT`answer_value`,`outdoor_id`,concat('(',group_concat(`outdoor_id`),')' )outdoor_ids,`question_id`,COUNT(answer_value) AS COUNT_NUMBER FROM visit_reports  GROUP BY `question_id`,`answer_value` having  `outdoor_id` in(" . implode(",", array_map("intval", $outdoor_ids)).")"));             

              // $visitTypeReports= DB::select(DB::raw("SELECT `question_text`,`name`,`answer_value`, `question_id` ,`chose_answer`,`type`,`visit_type_id`,COUNT(chose_answer) AS COUNT_NUMBER FROM V  GROUP BY `question_id`,`chose_answer`,`type`,`visit_type_id` having `type` != 'text' AND `chose_answer` IS NOT NULL and `visit_type_id` =". $visit_type ));
                          
            // $visitTypeReports= DB::select(DB::raw("SELECT `question_text`,`name`,`answer_value`".$branch_select.",`date`".$department_select.",concat('(',group_concat(`outdoor_id`),')' )outdoor_ids,`question_id` ,`chose_answer`,`type`,`visit_type_id`,COUNT(chose_answer) AS COUNT_NUMBER FROM V  GROUP BY `question_id`,`chose_answer`,`type`,`visit_type_id`".$branch_group." having `type` != 'text'  and `visit_type_id` =". $visit_type.$user_cond.$branch_cond.$department_cond.$from_cond ));
               //DB::select(DB::raw("SELECT `outdoor_id`,`question_id` ,`chose_answer`,`type`,`visit_type_id`,COUNT(chose_answer) AS COUNT_NUMBER FROM V  GROUP BY `question_id`,`chose_answer`,`type`,`visit_type_id` having `type` != 'text' AND `chose_answer` IS NOT NULL and `visit_type_id` =". $visit_type.$user_cond.$branch_cond.$department_cond.$from_cond.$to_cond ));                  
                                   // $query= DB::getQueryLog();
                              //  print_r($query);exit;

       
       // print_r($visitTypeReports);exit;
       $serach_name=Visits_type::select('name')->where('company_id',$company->id)->where('id',$visit_type)->first();
         
         foreach($visitTypeReports as $index=>$visitTypeReport){
           
            $ques_id=$visitTypeReport->question_id;
             $question_title=DB::select(DB::raw("SELECT `question_text`,`type` from visits_questions where id= $ques_id and `type`!='text'"));
             if(!empty($question_title)){
             $qustion=$question_title[0]->question_text??"";
             $qustion_type=$question_title[0]->type??"";
                if($visitTypeReports[$index]->question_id==$visitTypeReport->question_id){
                     $visitquestionanswers[$visitTypeReport->question_id]['question_type']=$qustion_type;
                     $visitquestionanswers[$visitTypeReport->question_id]['question_text']= $qustion;
                     $visitquestionanswers[$visitTypeReport->question_id]['name']=$serach_name; 
                    // $visitquestionanswers[$visitTypeReport->question_id]['outdoor_ids'][]=$visitTypeReports[$index]->outdoor_id;                
                     $visitquestionanswers[$visitTypeReport->question_id]['answer'][]=$visitTypeReports[$index];
                 }
             }
            
         }
         // print_r( $visitquestionanswers);exit;
        
        }
        }
        $clients=Client::select('clients.*','client_types.name as client_type_name')->join('client_types','client_types.id','=','clients.client_type_id')->where('clients.company_id', $company->id)->get();
       if(!$request->ajax()){
             return view('outdoor_report.vistTypeReport',array('visitquestionanswers'=>$visitquestionanswers,'visit_types'=>$visit_types,'search'=>$search,'serach_name'=>$serach_name,'subdomain'=>$subdomain,'branchs'=>$branchs,'departments'=> $departments));
    
       }else{
            return view('outdoor_report.vistTypeReportsearch',['visitquestionanswers'=>$visitquestionanswers,'search'=>$search,'serach_name'=> $serach_name,'subdomain'=>$subdomain,'branchs'=>$branchs,'departments'=> $departments]);
       }
        
}
  public function visit_report_details($subdomain,$visit_id,$user_id){
      //  $outdoor=Outdoor::where('id',$visit_id)->first();
        $outdoor=Outdoor::select('outdoors.*','outdoor_attendances.*','users.name as user_name','outdoors.id as outdoors_id','outdoor_attendance_attachments.avatar as outdoor_img','outdoor_attendance_attachments.lati','outdoor_attendance_attachments.longi','outdoor_attendance_attachments.type','outdoor_attendance_attachments.address','clients.name as client_name','clients.address as client_address','clients.contact_phone','branches.title as branch_title','clients.email as client_email','clients.phone as client_phone')
                            
                            ->join('outdoor_attendances', 'outdoor_attendances.outdoor_id', '=', 'outdoors.id')
                            ->join('outdoor_attendance_attachments', 'outdoor_attendance_attachments.outdoor_attendance_id', '=', 'outdoor_attendances.id')
                            ->leftjoin('clients', 'clients.id', '=', 'outdoors.customer_id') 
                            ->leftjoin('branches', 'branches.id', '=', 'clients.branch_id')
                             ->join('users', 'users.id', '=', 'outdoor_attendances.user_id')
                           
                            ->where('outdoors.user_id',$user_id)
                            ->where('outdoors.id',$visit_id)
                            ->where('outdoor_attendance_attachments.type',"in")
                            ->first();
                          
    
        if(isset($outdoor['created_at'])){
           
            $outdoor_date=$outdoor['created_at']->toDateString();
            $outdoor_in=$outdoor_date." ".$outdoor['time_in'];
            
            $outdoor_out=$outdoor['time_out'];
            
            $outdoor['in']=Carbon::parse($outdoor_in)->format('l jS \of F Y h:i:s A');
            
         
                
                $outdoor_attach_out=Outdoor::select('outdoors.*','outdoors.id as outdoors_id','outdoor_attendance_attachments.avatar as outdoor_img','outdoor_attendance_attachments.lati','outdoor_attendance_attachments.longi','outdoor_attendance_attachments.type','outdoor_attendance_attachments.address')
                                            ->join('outdoor_attendances', 'outdoor_attendances.outdoor_id', '=', 'outdoors.id')
                                            ->join('outdoor_attendance_attachments', 'outdoor_attendance_attachments.outdoor_attendance_id', '=', 'outdoor_attendances.id')
                                            ->where('outdoors.user_id',$user_id)
                                            ->where('outdoors.id',$visit_id)
                                            ->where('outdoor_attendance_attachments.type',"out")
                                            ->first();
                                       
                $outdoor['attendance_attach_out']=$outdoor_attach_out;
                $outdoor['out']=Carbon::parse($outdoor_out)->format('l jS \of F Y h:i:s A');
                $outdoor['hours']=Carbon::parse($outdoor['time_out'])->diffInHours(Carbon::parse($outdoor_in));
              
          if(empty($outdoor_attach_out)){
            
                $outdoor['out']=NULL;
                $outdoor['hours']="NaN";
                $visit_data['attendance_attach_out']=null;
            }
            //=gmdate('H:i:s',$hours);
            
        }
      
        $visit_data['out_door']=$outdoor;
        if($outdoor==NULL){
                
                   $visit_data['answers']=$visit_data['questions']=null;
        }else{
                   $visit_data['questions']=Visits_question::where('visit_type_id',$outdoor['visit_type_id'])->get();
                   $visit_data['answers']=Visit_report::where('user_id',$user_id)->where('outdoor_id',$visit_id)->get(); 
        }

        $visit_data['user']=$user_id;

        return response()->json($visit_data);
    }
    
    
    
    
    public function visitPrint($subdomain,$type='total',UsersDataTable $dataTable){

        return $dataTable->render('users');
    }
    public function visitTypeReportPrint($subdomain,$type='visit_type',UsersDataTable $dataTable){
          
        return $dataTable->render('users');
    }
    
    
    public function visit_report_search($subdomain,Request $request){
        $search=$request->all();
        
        $user_id=$search['user_id']?$search['user_id']:'all';
        $customer_id=$search['customer_id']?$search['customer_id']:'all';
        $from=$search['from']?$search['from']:'all';
        $to=$search['to']?$search['to']:'all';
        $visit_type=$search['visit_type']?$search['visit_type']:'all';
        if(isset($search['department'])) $department=$search['department'];else $department='all';
        if(isset($search['branch']))  $branch=$search['branch']; else $branch='all'; 
        $company=$this->company;   
        if($user_id!='all'){
            $users=User::where(array('company_id'=>$company->id,'id'=>$user_id))->where('users.id', '!=' , Auth::user()->id)->get();
        }else{
            $users=User::where('company_id',$company->id)->where('users.id', '!=' , Auth::user()->id)->get();
        }
        $outdoor=array();
      
        foreach($users as $user){
          //  DB::enableQueryLog();
            $outdoor=Outdoor::select('users.*','users.name as user_name','outdoors.id as leave_id','outdoors.*','outdoor_attendances.created_at as visit_date','outdoor_attendances.time_out','users.id aS EmployeeId','departments.title as dep_title','branches.title as branch_title','clients.name as client_name','clients.address as client_address','clients.contact_phone')
                                ->join('outdoor_attendances', 'outdoor_attendances.outdoor_id', '=', 'outdoors.id')
                                ->join('users', 'users.id', '=', 'outdoor_attendances.user_id')
                                ->join('departments', 'departments.id', '=', 'users.department_id')
                                ->join('branches', 'branches.id', '=', 'users.branch_id') 
                                ->leftJoin('clients','clients.id','=','outdoors.customer_id')
                                          
                                ->Where(function($query) use ($user_id,$from,$to,$visit_type,$department,$branch,$customer_id) {
                                    if($user_id!='all'){
                                        $query->where('users.id','=' ,$user_id);
                                    }
                                  
                                    if($from!='all'){
                                       
                                        $query->whereDate('outdoor_attendances.created_at','>=' ,$from);
                                    }
                                    if($to!='all'){
                                        
                                        $query->whereDate('outdoor_attendances.created_at','<=' ,$to);
                                    }
                                    if($visit_type!='all'){
                                        $query->where('outdoors.visit_type_id','>=' ,$visit_type);
                                    }
                                    if($department!='all')
                                        $query->where('users.department_id',$department);
                                    if($branch!='all')
                                        $query->where('users.branch_id',$branch);
                                    
                                     if($customer_id !='all')
                                        $query->where('outdoors.customer_id',$customer_id);
                                    })
                               ->get();
                                
              // dd(DB::getQueryLog());  exit;   
              //print_r($outdoor); exit;              
        }
       
        return view('outdoor_report.search',['outdoors'=>$outdoor]);
    }
}
