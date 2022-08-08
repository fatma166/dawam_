<?php
namespace App\Traits;
use App\Models\Company;
use App\Models\evaluation_element;
use App\Models\Task;
use App\Models\Job;
use App\Models\Department;
use App\Models\Branch;
use App\Models\Role;
use App\Models\evaluation_elements_jobs;
use App\Models\employee_evaluation;
use App\Models\Attendance;
use App\Models\Outdoor;
use Illuminate\Support\Facades\DB;

trait EvaluationEmployeTrait
{
   
    public function user_evalution($users,$month,$year,$company_id)
    
    {
     
      $chart_evalution=array();
      foreach($users as $user)
      {
   
        
        $currentdaysmonth=Attendance::select('*')
        ->whereMonth('attendances.created_at',$month)
        ->whereYear('attendances.created_at',$year)
        ->where('attendances.company_id',$company_id)
        ->where('attendances.user_id', $user->user_id)
        ->distinct((DB::raw('DATE(attendances.created_at)')))
        ->count();
       
        // return response()->json($currentdaysmonth);
        $allattendances=Attendance::where('user_id',$user->user_id)
        ->where('company_id',$company_id)
        ->whereMonth('created_at',$month)
        ->whereYear('created_at',$year)
        ->wherein('status',['attend','Attendance_discount'])
        ->distinct((DB::raw('DATE(attendances.created_at)')))
        ->count();
        if($currentdaysmonth==0) $allattendances_precnet=0; else $allattendances_precnet=($allattendances/$currentdaysmonth);

      //  ###################الإلتزام################
        $propriety=Attendance::where('user_id',$user->user_id)
        ->where('company_id',$company_id)
        ->whereMonth('created_at',$month)
        ->whereYear('created_at',$year)
        ->wherein('status',['attend'])
        ->distinct((DB::raw('DATE(attendances.created_at)')))
        ->count();
        if($currentdaysmonth==0)$propriety_precnet=0; else $propriety_precnet= ($propriety/$currentdaysmonth);

      #############الزيارات#####################
      $allOutdoor=Outdoor::where('user_id',$user->user_id)
      ->where('company_id',$company_id)
      ->whereMonth('created_at',$month)
      ->whereYear('created_at',$year)
      ->count();

      $done_outdoors=Outdoor::where('user_id',$user->user_id)
      ->where('company_id',$company_id)
      ->whereMonth('created_at',$month)
      ->whereYear('created_at',$year)
      ->where('status','done')
      ->count();
      if($allOutdoor==0)$outdoor_precnet=0; else $outdoor_precnet=($done_outdoors/$allOutdoor);
    
        #############المهام#####################
        $alltasks=Task::where('user_id',$user->user_id)
        ->where('company_id',$company_id)
        ->whereMonth('start_date',$month)
        ->whereYear('start_date',$year)
        ->count();

        $done_tasks=Task::where('user_id',$user->user_id)
        ->where('company_id',$company_id)
        ->whereMonth('created_at',$month)
        ->whereYear('created_at',$year)
        ->where('status','done')
        ->count();
        if($alltasks==0) $alltasks_precnet=0; else $alltasks_precnet=($done_tasks/$alltasks);


        $evaluationjob = evaluation_elements_jobs::where('job_id', $user->job_id)
          ->where('company_id',$company_id)
          ->first();
          // return response()->json($evaluationjob);

          // return response()->json($evaluationjob);
          $total_precent=0;
          $evaluation_keies = [];
          $evaluat_status=[];

              if($evaluationjob != null && isset($evaluationjob["element_degree"]))
              {
              
              
                $items = json_decode($evaluationjob["element_degree"]);
                foreach($items as $index =>$item)
                {
              
                    $key = evaluation_element::find($index);
                    // return $index;
                    $reuslt["id"] = $key->id;
                    $reuslt["title"] = $key->title;
                    $reuslt["degree"] = $item;
                    $result["status"]= $key->status;
                  // return  $result["status"];
              
                if($result["status"]==0)
                {
                    array_push($evaluat_status,$result["status"]);
                    
                } 
                  //if($result["status"]==0) $element_status=0;
              
                  // $reuslt["evaljob_id"] = $evaljob_id;
                    $reuslt["precnet"]=0;
                    if($reuslt["title"]=='الحضور') $reuslt["precnet"]=($allattendances_precnet*$reuslt["degree"]);
                    if($reuslt["title"]=='الإلتزام') $reuslt["precnet"]=($propriety_precnet*$reuslt["degree"]);
                    if($reuslt["title"]=='الزيارات') $reuslt["precnet"]=($outdoor_precnet*$reuslt["degree"]);
                    if($reuslt["title"]=='المهام')  $reuslt["precnet"]=($alltasks_precnet*$reuslt["degree"]);
                  $total_precent +=round($reuslt["precnet"],2);
                }
              
                
              }
            

    //  return response()->json($total_precent);

          $emp_dgree = employee_evaluation::where('user_id', $user->user_id)
                                     ->where('company_id',$company_id)
                                     ->where('year',$year)
                                     ->Where(function($query) use($month)
                                     {
                                          
                                      if($month !='all')
                                      {
                                          $query->where('month','=', $month);
                                      }
                                                  
                                    })
                                     ->sum('emp_degree');
         $evaluation_degree = employee_evaluation::where('user_id', $user->user_id)
                                     ->where('company_id',$company_id)
                                     ->where('year',$year)
                                     ->Where(function($query) use($month)
                                     {
                                          
                                      if($month !='all')
                                      {
                                          $query->where('month','=', $month);
                                      }
                                    })
                                     ->sum('evaluation_degree');
        
       
        $result['user_name'] = $user->user_name;
        if($evaluation_degree==0 || $emp_dgree==0 )
        {
          $result['emp_degree'] = $total_precent;
        }
        else
        {
          $Total=$emp_dgree+$total_precent;
          $result['emp_degree']=round($Total,2);
          //$result['emp_degree']=round(($emp_dgree/$evaluation_degree)*100,2);
        }
       // $result['emp_degree'] = ($emp_dgree/$evaluation_degree)*100;
        $result['user_id'] = $user->user_id;
        $result['year'] = $year;
        $result['month'] = $month;
       
        $result['company_id'] = $user->cm_id;
        $result['job'] = $user->job_name;
       
        $result['evaluation_degree'] = $evaluation_degree;
        array_push($chart_evalution, $result);
      
        
                 
       }

      // print_r($jobchart);die;
      return ($chart_evalution);

    }

   
    public function evalution_report($empevalu)
    {
       
     
     $monthly=array();
    foreach($empevalu as $data)
        {
        
         $result['user_id'] = $data->user_id;
         $result['user_name'] = $data->name;
         $result['company_id'] = $data->company_id;
         $result['job'] = $data->job_name;
         $result['job_id'] = $data->job_id;
         $result['department'] = $data->department_name;
         $result['branch'] = $data->branch_name;
         $result['month'] =$data?$data->month:'';
         $result['year'] = $data?$data->year:'';

        //  $result['id'] = $data->user_id;
         $result['Employe_Name'] = $data->name;
         $result['evaluation_month'] =$data?$data->month:'';
         $result['Evaluation_Year'] = $data?$data->year:'';
         $result['id'] = $data->user_id;

        
         //$result['evaluation_month'] =date("M",mktime(0,0,0,$data->month));

                    
        // return $result['month'];
        //الحضور##########################
        $currentdaysmonth=Attendance::select('*')
        ->whereMonth('attendances.created_at',$result['month'])
        ->whereYear('attendances.created_at',$result['year'])
        ->where('attendances.company_id',$result['company_id'])
        //  $user->user_id
        ->where('attendances.user_id', $result['user_id'])
        ->distinct((DB::raw('DATE(attendances.created_at)')))
        ->count();
          //return $currentdaysmonth;
      //الحضور والحضور متأخر
      $allattendances=Attendance::where('user_id',$result['user_id'])
      ->where('company_id',$result['company_id'])
      ->whereMonth('created_at',$result['month'])
      ->whereYear('created_at',$result['year'])
      ->wherein('status',['attend','Attendance_discount'])
      ->distinct((DB::raw('DATE(attendances.created_at)')))
      ->count();

      if($currentdaysmonth==0) $allattendances_precnet=0; else $allattendances_precnet=($allattendances/$currentdaysmonth);

            //  return $allattendances_precnet;
          ###################الإلتزام################
          $propriety=Attendance::where('user_id',$result['user_id'])
          ->where('company_id',$result['company_id'])
          ->whereMonth('created_at',$result['month'])
          ->whereYear('created_at',$result['year'])
          ->wherein('status',['attend'])
          ->distinct((DB::raw('DATE(attendances.created_at)')))
          ->count();
          if($currentdaysmonth==0)$propriety_precnet=0; else $propriety_precnet= ($propriety/$currentdaysmonth);

            #############الزيارات#####################
            $allOutdoor=Outdoor::where('user_id',$result['user_id'])
            ->where('company_id',$result['company_id'])
            ->whereMonth('created_at',$result['month'])
            ->whereYear('created_at',$result['year'])
            ->count();


            $done_outdoors=Outdoor::where('user_id',$result['user_id'])
            ->where('company_id',$result['company_id'])
            ->whereMonth('created_at',$result['month'])
            ->whereYear('created_at',$result['year'])
            ->where('status','done')
            ->count();
           // return $done_outdoors;

            if($allOutdoor==0)$outdoor_precnet=0; else $outdoor_precnet=($done_outdoors/$allOutdoor);

            #############المهام#####################
            $alltasks=Task::where('user_id',$result['user_id'])
            ->where('company_id',$result['company_id'])
            ->whereMonth('start_date',$result['month'])
            ->whereYear('start_date',$result['year'])
            ->count();


            $done_tasks=Task::where('user_id',$result['user_id'])
            ->where('company_id',$result['company_id'])
            ->whereMonth('created_at',$result['month'])
            ->whereYear('created_at',$result['year'])
            ->where('status','done')
            ->count();


          if($alltasks==0) $alltasks_precnet=0; else $alltasks_precnet=($done_tasks/$alltasks);
          $evaluationjob = evaluation_elements_jobs::where('job_id', $result['job_id'])
          ->where('company_id',$result['company_id'])
          ->first();

         
            $total_precent=0;
            $evaluation_keies = [];
            $evaluat_status=[];
            if($evaluationjob != null && isset($evaluationjob["element_degree"]))
            {
            
            
              $items = json_decode($evaluationjob["element_degree"]);
              foreach($items as $index =>$item)
              {
            
                  $key = evaluation_element::find($index);
                  // return $index;
                  $res["id"] = $key->id;
                  $res["title"] = $key->title;
                  $res["degree"] = $item;
                  $res["status"]= $key->status;
                // return  $result["status"];
            
              if($res["status"]==0)
              {
                  array_push($evaluat_status,$res["status"]);
                  
              } 
              
                  $res["precnet"]=0;
                  if($res["title"]=='الحضور') $res["precnet"]=($allattendances_precnet*$res["degree"]);
                  if($res["title"]=='الإلتزام') $res["precnet"]=($propriety_precnet*$res["degree"]);
                  if($res["title"]=='الزيارات') $res["precnet"]=($outdoor_precnet*$res["degree"]);
                  if($res["title"]=='المهام')  $res["precnet"]=($alltasks_precnet*$res["degree"]);
                  $total_precent +=round($res["precnet"],2);
              }
            
            
            }
        
            
         $result['element_degree'] = $data?$data->element_degree:"";
         $result['emp_degree'] = $data?$data->emp_degree:"";
         if($result['emp_degree']=="")$result['emp_degree']=$total_precent;else $result['emp_degree']=$result['emp_degree']+$total_precent;
         $result['evaluation_degree'] = $data?$data->evaluation_degree:"";
         $result['evalution_jobs_id'] = $data?$data->evalution_jobs_id:"";
         $result['evalution_id'] = $data?$data->id:"";

         if($result['emp_degree']=="")$result['Total_Evaluation']=$total_precent.' %';else $result['Total_Evaluation']=($result['emp_degree']+$total_precent).' %';
         

         array_push($monthly,$result);
         
        }
       return ($monthly);

      //end foreach

       

      //endforeach





    }

}

