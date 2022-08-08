<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Models\evaluation_element;
use App\Models\Task;

use App\Http\Controllers\Admin\JobController;
use App\Models\Job;
use App\Models\Department;
use App\Models\Branch;
use App\Models\Role;
use App\Models\evaluation_elements_jobs;
use App\Models\employee_evaluation;


use  App\Http\Controllers\Admin\BaseController;

use App\Models\Attendance;
use App\Models\Outdoor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Workflow;
use App\Models\Shift;
use App\Models\User_shift;

use App\DataTables\UsersDataTable;

use App\Models\Zone;
use App\Models\Holiday;
use Carbon\CarbonPeriod;
use App\Models\ExceptionHolidays;


use DateTime;

use Validator;
use Illuminate\Validation\Rule;

use App\Traits\EvaluationEmployeTrait;
class EvaluationController extends BaseController
{

  use EvaluationEmployeTrait;

    public function index($subdomain)
    {

        $company_check = $this->company;
        //$company_check=Company::join('users','users.company_id','=','companies.id')->where(array('users.id'=>Auth::user()->id,'role_id'=>1))->first();

        $companies = array();
        $evaluation = evaluation_element::where('company_id', $company_check->id)
        ->get();
       

        $jobs = Job::where('company_id', $company_check->id)->get();
        return view('evaluations.evaluation_list', compact('evaluation', 'jobs','subdomain'));


    }


    public function store($subdomain,Request $request)
    {


        $company_check = $this->company;


        $req = Validator::make($request->all(),
         [
            'title' => ['required',
             Rule::unique('evaluation_elements')
              ->where('company_id', $company_check->id)
           ],

        ]);

     
 

        if ($req->passes())
        {


            /**   save in database  */
            $input = array('title' => $request->title, 'company_id' => $company_check->id,'status'=>0);
            $evaluation = evaluation_element::create($input);
            if (!is_null($evaluation))
            {
                //toastr()->success('Data has been saved successfully!');
               // toastr()->success(trans('trans.data_add_successfly'));
              
                return response()->json(['success' => 'Added successfully.']);
                
            }

        } else
        {
            return response()->json(['error' => $req->errors()->all()]);
        }

    }


    public function edit($subdomain,$id)
    {


        $company_check = $this->company;

       // $evaluation = evaluation_element::where('id', $id)->first();
        $evaluation = evaluation_element::where('id', $id)->where('company_id',$company_check->id)->first();
        return response()->json($evaluation);

    }

    public function update($subdomain,Request $request, $id)
    {

       //print_r($id);die;
       
            $company_check = $this->company;
            $req=Validator::make($request->all(),[
                'title'=> ['required',
                   Rule::unique('evaluation_elements')->where(function ($query) use($company_check,$id)
                  {
                            return $query->where('company_id', $company_check->id)->where('id','!=',$id);
                   }),
                ],
            ]);


        if ($req->passes())
        {
            $evaluations = $request->all();

            $evaluation_update = array('title' => $evaluations['title']);
            // evaluation_element::where('id', $id)->update($evaluation_update);
             evaluation_element::where('id', $id)->where('company_id',$company_check->id)->update($evaluation_update);
          //  toastr()->success(trans('trans.data_edit_successfly'));
            return response()->json(['success' => ' updated successfully.']);
        } else
        {
            return response()->json(['error' => $req->errors()->all()]);
        }
    }
    public function delete($subdomain,Request $request)
    {
        $company_check = $this->company;
         //search if emenlent_id in realtion with job table or not first
        // $jobs_evaluations=evaluation_elements_jobs::where('company_id',$company_check->id)->get();
        
       
    
       //  $evaluation_keies[$key->job_id]["row"]="";
        // foreach (json_decode($key->element_degree) as $index => $data)
          //  {
                
                //$jobtitle=Job::find($key->job_id)->first('title');
               //  $key2 = evaluation_element::find($index);
               // $evaluation_keies[$key->job_id]["row"] .= ' '.$key2->title  . ' : ' . $data;
            //   foreach($index as $index)
            //   {
             //   $evaluation_keies[$key->job_id]["row"] .= $index;
             //  }
                 
                // $job_degree += $data;
                // $evaluation_keies[$key->job_id]['totaldegree']= $job_degree;
                // $evaluation_keies[$key->job_id]['jobname']= $key->title;
                            
           // }
    
       // }
       //  return  response($evaluation_keies);
         evaluation_element::where('id', $request->id)->delete();
        // toastr()->error(trans('trans.data_delete_successfly'));
         return back()->with('success', 'Delete successfully.');
       }
       
      


    //for job evaluation
    public function evalutaionjob_index($subdomain)
    {
      
        $company_check = $this->company;
        $companies = array();

      

        $jobs_id = evaluation_elements_jobs::get('job_id');

        $evaluation= evaluation_element::where('company_id', $company_check->
            id)->get();


        $jobs= Job::WhereNotIn('id', $jobs_id)->where('company_id', $company_check->
            id)->get();
           
     
            $jobs_evaluations = evaluation_elements_jobs::select('evaluation_elements_jobs.*', 'jobs.title')
           ->where('evaluation_elements_jobs.company_id', $company_check->id)->
            join('jobs', 'jobs.id', '=', 'evaluation_elements_jobs.job_id')->get();
         
          
        // return $jobs_evalu;
        $evaluation_keies = [];
        //  return $jobs_evalu[1]->element_degree;
        
        foreach ($jobs_evaluations as $key)
        {
          //  $result['element'] = json_decode($key->element_degree);
          $evaluation_keies[$key->job_id]['id']= $key->id;
          $job_degree=0;
         $evaluation_keies[$key->job_id]["row"]="";
         foreach (json_decode($key->element_degree) as $index => $data)
            {
                
                //$jobtitle=Job::find($key->job_id)->first('title');
                 $key2 = evaluation_element::find($index);
                 $evaluation_keies[$key->job_id]["row"] .= ' '.$key2->title  . ' : ' . $data;
                 $job_degree += $data;
                 $evaluation_keies[$key->job_id]['totaldegree']= $job_degree;
                 $evaluation_keies[$key->job_id]['jobname']= $key->title;
                            
            }
    
        }
   
      
      return view('evaluations.job_evaluations',compact('evaluation','jobs','evaluation_keies','subdomain'));
    }

    
    public function storeevaluationjobs($subdomain,Request $request)
    {
  
       
      
        /**   $evalelem=$request->All();*/

        $evalelem = $request->All();
        
      //  print_r($evalelem);die();
        $company = $this->company;
        $degree = array();
        foreach ($evalelem['degree'] as $key => $degre)
        {

            if (!empty($degre))
                $degree[$key] = $degre;
        }

        // print_r($degree);die;
        $evaluation_jobelement = array(
            'job_id' => $evalelem['job_evalutionsid'],

            'element_degree' => json_encode($degree),
            'company_id' => $company->id);

        //print_r($evaluation_jobelement);die;
        
        $evaluation_jobstore = evaluation_elements_jobs::create($evaluation_jobelement);


        if (!is_null($evaluation_jobstore))
        {
            toastr()->success(trans('trans.data_add_successfly'));
            return redirect()->back();
        }
        // else return with error message
        else
        {

            return back()->with('error', 'messages.error');
        }


    }


    public function edit_evaluation($subdomain,$id)
    {
       
        $company_check = $this->company;
        $data = evaluation_elements_jobs::where('id', $id)->where('company_id', $company_check->
            id)->first();
        $jobeval = Job::where('id', $data->job_id)->where('company_id', $company_check->
            id)->first('title');

        return response()->json(['jobevalution' => $data, 'jobtitle' => $jobeval]);

    }

    public function update_evaluationjob($subdomain,Request $request, $id)
    {


        //print_r($id);die;

        $company_check = $this->company;
        $evalelem2 = $request->All();
        // return $evalelem2;
        if (!is_null($evalelem2))
        {
            evaluation_elements_jobs::where('id', $id)->where('company_id', $company_check->
                id)->delete();
        }

        //save
        $degree = array();
        foreach ($evalelem2['degree'] as $key => $degre)
        {

            if (!empty($degre))
                $degree[$key] = $degre;
        }

        // print_r($degree);die;

        $evaluation_jobelement1 = array(
            'job_id' => $evalelem2['jobEval_id'],
            'element_degree' => json_encode($degree),
            'company_id' => $company_check->id);

        $evaluation_jobstore = evaluation_elements_jobs::create($evaluation_jobelement1);


        if (!is_null($evaluation_jobstore))
        {
           // toastr()->success(trans('trans.data_edit_successfly')); 
            return back()->with('', ' updated successfully.');
        }
        // else return with error message
        else
        {

            return back()->with('error', 'messages.error');
        }


    }


    public function delete_evalutionjob($subdomain,Request $request)
    {

        evaluation_elements_jobs::where('id', $request->id)->delete();
        toastr()->error(trans('trans.data_delete_successfly'));
        //return back()->with('success', 'Delete successfully.');
    }


 
   

    public function evaluationemployes_index($subdomain,Request $request)
    {
     
      ///////////////////
     
        $company_check = $this->company;
        $manger_branch_id= $this->branch_id;
        $manger_department_id= $this->department_id;
        $evalaution_element=evaluation_element::select('title')
                            ->where('company_id',$company_check->id)
                            ->where('status',1)->get();
     


        $roles_=Role::where('company_id',$company_check->id)->wherein('name',['super_admin','admin','manger'])->pluck('id');
        $branchs = Branch::where('company_id', $company_check->id)->get();
        $departments = Department::where('company_id', $company_check->id)->get();
        $employees = User::select('users.*', 'departments.title as dep_title',
                            'branches.title as branch_title')->where('users.company_id', $company_check->id)->
                            join('departments', 'departments.id', '=', 'users.department_id')->join('branches',
                            'branches.id', '=', 'users.branch_id')
                            //->Join("roles","roles.id", "=", "users.role_id")
                           ->whereNotIn('users.role_id', $roles_)
                           ->where('users.company_id',"=", $this->company->id)
                             ->orWhere(function($query)
                              {
                                        
                                    $query->where('users.role_id', "=", null);
                                    $query->where('users.company_id',"=", $this->company->id);
                                   //$query->where('users.role_id',"!=", $roles_);
                                                        
                             })
                                
                           ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                       if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                             $query->where('users.branch_id',$manger_branch_id);
                                       if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                             $query->where('users.department_id',$manger_department_id);
                                               
                            })
                     
                           ->where('users.id', '!=' , Auth::user()->id)
                          ->get();
          
          $search = $request->all();
      
          // return $search
           $date=date_create(date("Y-m-d"));
           if(isset($search['employee_name'])&&$search['employee_name']!='null')$user=$search['employee_name'];else $user='all';
           if(isset($search['department'])&&$search['department']!='null')$department=$search['department'];else $department='all';
           if(isset($search['branch'])&&$search['branch']!='null')$branch=$search['branch'];else $branch='all';
          
           if(isset($search['month']) && ($search['month']!=='all' || $search['month']!==''))$month=$search['month']; else $month=date_format($date,"m");
           if(isset($search['month']) && ($search['month']=='all'))$month=date_format($date,"m");
         
           if(isset($search['year']) && ($search['year']!=='all' || $search['year']!==''))$year=$search['year']; else $year=date_format($date,"Y");
           if(isset($search['year']) && ($search['year']=='all'))$year=date_format($date,"Y");
       
         //  return $year;
        // $eval_date["curr_date"]["month"]=$month;
        // $eval_date["curr_date"]["year"]=$year;
     
        
        $users = User::select("users.company_id as cm_id", "users.name as user_name",
            "users.id as user_id",  "users.job_id","branches.title as branch_name", 'jobs.title as job_name','departments.title as department_name')
            ->join("branches", "users.branch_id", "=", "branches.id")
            ->Join("jobs","users.job_id", "=", "jobs.id")
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->where('users.company_id',"=", $this->company->id)
            ->Where(function($query) use($roles_)
             {
                       
                   $query->whereNotIn('users.role_id', $roles_)
                   ->orwhere('users.role_id', "=", null);
                   $query->where('users.company_id',"=", $this->company->id);
                                 
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
                           ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                       if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                             $query->where('users.branch_id',$manger_branch_id);
                                       if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                             $query->where('users.department_id',$manger_department_id);
                                               
                            })
                             ->where('users.id', '!=' , Auth::user()->id)
                         ->paginate(15);
            //return $users;
    $evalarray = [];
     foreach ($users as $user)
     {
       
         //return $user;
         
        //get days from begin date of month until now from attendance table
        //ÇáÍÖæÑ##########################
           $currentdaysmonth=Attendance::select('*')
           ->whereMonth('attendances.created_at',$month)
           ->whereYear('attendances.created_at',$year)
           ->where('attendances.company_id',$company_check->id)
          //  $user->user_id
           ->where('attendances.user_id', $user->user_id)
           ->distinct((DB::raw('DATE(attendances.created_at)')))
           ->count();
            //return $currentdaysmonth;
           
           // return  d
           //ÇáÍÖæÑ æÇáÍÖæÑ ãÊÃÎÑ
             $allattendances=Attendance::where('user_id',$user->user_id)
             ->where('company_id',$company_check->id)
             ->whereMonth('created_at',$month)
             ->whereYear('created_at',$year)
             ->wherein('status',['attend','Attendance_discount'])
             ->distinct((DB::raw('DATE(attendances.created_at)')))
             ->count();
            
            if($currentdaysmonth==0) $allattendances_precnet=0; else $allattendances_precnet=($allattendances/$currentdaysmonth);
          
            ###################ÇáÅáÊÒÇã################
             $propriety=Attendance::where('user_id',$user->user_id)
             ->where('company_id',$company_check->id)
             ->whereMonth('created_at',$month)
             ->whereYear('created_at',$year)
             ->wherein('status',['attend'])
             ->distinct((DB::raw('DATE(attendances.created_at)')))
             ->count();
            if($currentdaysmonth==0)$propriety_precnet=0; else $propriety_precnet= ($propriety/$currentdaysmonth);
          
            #############ÇáÒíÇÑÇÊ#####################
          $allOutdoor=Outdoor::where('user_id',$user->user_id)
                ->where('company_id',$company_check->id)
                ->whereMonth('created_at',$month)
                ->whereYear('created_at',$year)
                ->count();
        
          $done_outdoors=Outdoor::where('user_id',$user->user_id)
            ->where('company_id',$company_check->id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->where('status','done')
            ->count();
            //return $done_outdoors;
            if($allOutdoor==0)$outdoor_precnet=0; else $outdoor_precnet=($done_outdoors/$allOutdoor);
        //  return $outdoor_precnet;
      
         #############ÇáãåÇã#####################
         $alltasks=Task::where('user_id',$user->user_id)
          ->where('company_id',$company_check->id)
          ->whereMonth('start_date',$month)
          ->whereYear('start_date',$year)
          ->count();
       
        $done_tasks=Task::where('user_id',$user->user_id)
          ->where('company_id',$company_check->id)
          ->whereMonth('created_at',$month)
          ->whereYear('created_at',$year)
          ->where('status','done')
          ->count();

        
         if($alltasks==0) $alltasks_precnet=0; else $alltasks_precnet=($done_tasks/$alltasks);
        // return $alltasks_precnet;
          $evaluationjob = evaluation_elements_jobs::where('job_id', $user->job_id)
          ->where('company_id',$company_check->id)
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
                if($reuslt["title"]=='ÇáÍÖæÑ') $reuslt["precnet"]=($allattendances_precnet*$reuslt["degree"]);
                if($reuslt["title"]=='ÇáÅáÊÒÇã') $reuslt["precnet"]=($propriety_precnet*$reuslt["degree"]);
                if($reuslt["title"]=='ÇáÒíÇÑÇÊ') $reuslt["precnet"]=($outdoor_precnet*$reuslt["degree"]);
                if($reuslt["title"]=='ÇáãåÇã')  $reuslt["precnet"]=($alltasks_precnet*$reuslt["degree"]);
              $total_precent +=round($reuslt["precnet"],2);
            }

       
          }
         // return $total_precent;
      //print_r ($items);die;
      
      $userval;
      $evalution_id;
      $emp_degree;
      $dataeval = employee_evaluation::where('user_id',$user->user_id)
      ->where('month',$month)
      ->where('year',$year)
      ->first();
      
      if(!is_null($dataeval))
      {
        $userval=1;
        $evalution_id=$dataeval->id;
        $emp_degree=$dataeval->emp_degree;
      }
      else
      {
        $userval=0;
        $evalution_id='';
        $emp_degree=0;
      }

     
    /// return $dataeval;
     
         // return  count($evaluat_status);
       
         // return $evaluat_status;
          // if($evaluat_status!==null)print_r('ddddd');die;
                  $result['user_id'] = $user->user_id;
                  $result['user_name'] = $user->user_name;
                  $result['company_id'] = $user->cm_id;
                  $result['job'] = $user->job_name;
                  $result['department'] = $user->department_name;
                  $result['branch'] = $user->branch_name;
                  $result['month'] = $month;
                  $result['year'] = $year;
                  $result['element_degree'] = $total_precent + $emp_degree;
                 
                  $result['status']=count($evaluat_status);
                  $result['usereval']=$userval;
                  $result['evalution_id'] = $evalution_id;

                 //return  $result['status'];
                //return count($evaluat_status);
                array_push($evalarray,$result);

          
     }
    
    // return $evalarray;
      if($request->ajax())
       //return response()->json($evalarray);
       //return response()->json($evalarray);

       
      return view('evaluations.evaluationsearch', compact('evalarray', 'branchs',
       'departments', 'employees','users','subdomain'),['search'=>$search])->with('i', ($request->input('page', 1) - 1) * 5);
      else
          return view('evaluations.employes_evaluations', compact('evalarray', 'branchs',
              'departments', 'employees','users','subdomain'),['search'=>$search])->with('i', ($request->input('page', 1) - 1) * 5);


      }
    


  

    public function getemployejob_id($subdomain,$id)
    {
          // evaluation-month="{{$item['month']}}"
          // evaluation-year="{{$item['year']}}"
      // $company_check = $this->company;->where('company_id',$company_check->id);
        $user = User::find($id);

        //  return response()->json($users);
        //$evaluation1= evaluation_element::where('company_id',$company_check->id)->get();
//
        $evaluationjob = evaluation_elements_jobs::where('job_id', $user->job_id)->
            first();
        // return response()-> json($evaluationjob);
        //return response()->json()$ev)
       
        $evaljob_id = $evaluationjob->id;
        if($evaluationjob !==null && isset($evaluationjob["element_degree"]))
        {
          $items = json_decode($evaluationjob["element_degree"]);
        }
        // $items= json_decode($evaluationjob->element_degree);

        $evaluation_keies = [];

        foreach ($items as $index => $item)
        {

          // $key = evaluation_element::where('id',$index)
          //       ->where('status',0)->get();
         $key = evaluation_element::where('id',$index)->where('status',0)->first();

         if(!is_null($key)) 
         {
          $reuslt["id"] = $key->id;
          $reuslt["title"] = $key->title;
          $reuslt["degree"] = $item;
          $reuslt["evaljob_id"] = $evaljob_id;
          array_push($evaluation_keies, $reuslt);
        }
        

        
          // print_r($key);die;
  


        }
        /*  $all_months=["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sept","Oct","Nov","Dec"];
        $evaluated_month= employee_evaluation::select("month")->where("user_id",$id)->where("year",date("Y"))->get();
        // $company_check=$this->company;
        $months=[];
        foreach($evaluated_month as $item){
        
        array_push($months,date("M",mktime(0,0,0,(int)$item->month)));
        }
        
        $unevaluated_months= array_diff($all_months,$months);
        */


        // return response()-> json($evaluation_keies);
        return view("evaluations.evaluation_table", compact('evaluation_keies', 'user','subdomain'));


    }

    public function store_employeevaluation($subdomain,Request $request)
    {

    // print_r ('ddddddd');die;
        $emp_degree = 0;
        foreach ($request->degree as $key => $total)
        {
            $emp_degree += $total;

        }
        // return  $emp_degree;

        $evaluation_degree = 0;
        foreach ($request->basic_degree as $key => $degree)
        {
            $evaluation_degree += $degree;

        }


        $company_check = $this->company;
        $evaluation_employe = array(
            'user_id' => $request->user_id,
            'month' => $request->month,
            'year' => $request->year,
            'evalution_jobs_id' => $request->evaljob_id,
            'element_degree' => json_encode($request->degree),
            'emp_degree' => $emp_degree,
            'evaluation_degree' => $evaluation_degree,
            'company_id' => $company_check->id,
            );

        //print_r($evaluation_jobelement);die;
        $evaluation_emlpyestore = employee_evaluation::create($evaluation_employe);

        if (!is_null($evaluation_employe))
        {
          //  toastr()->success(trans('trans.data_add_successfly'));
            return redirect()->back();
        }
        // else return with error message
        else
        {

            return back()->with('error', 'messages.error');
        }


    }

 
    public function evaluationemp_edit($subdomain,$id)
    {
        $company_check = $this->company;
        // $evaluationemploye = employee_evaluation::where('id', $id)->where('month',
           // date("m"))->where('company_id', $company_check->id)->first();
        $evaluationemploye = employee_evaluation::where('id', $id)->where('company_id', $company_check->id)->first();
        // return $evaluationemploye;


        // $items= json_decode($evaluationjob->element_degree);


        //  get jobevaluation dgree
        $elements = [];
        $evaluation_elements_jobs = evaluation_elements_jobs::find($evaluationemploye->
            evalution_jobs_id);
        foreach (json_decode($evaluation_elements_jobs->element_degree) as $index => $item)
        {
            $em["key"] = $index;
            $em["job_degree"] = $item;
            array_push($elements, $em);

        }

        //  return $elements;

        //get employe dgree

        $evaluation_keies = [];
        $items = json_decode($evaluationemploye["element_degree"]);

        foreach ($items as $index => $item)
        {
            $reuslt = [];
            $key = evaluation_element::find($index);


            $reuslt["elment_id"] = $key->id;
            $reuslt["eleme_title"] = $key->title;

            $reuslt["emp_degree"] = $item;
            //get dgree of jobevalaution


            //for get jobeavalutindegree with the same employe dgree
            foreach ($elements as $a => $value)
            {
                // $value hass key and dgree
                if ($value["key"] == $reuslt["elment_id"])
                {
                    $reuslt = array_merge($value, $reuslt);
                    break;
                    
                }
            }

            //  $reuslt["evaljob_id"]=$evaljob_id;
            array_push($evaluation_keies, $reuslt);
        }


        //  return  $evaluation_keies;
        /*  $all_months=["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sept","Oct","Nov","Dec"];
        //
        $evaluated_month= employee_evaluation::select("month")->where('user_id',$evaluationemploye->user_id)
        ->where("year",date("Y"))->where('id',"!=",$id)->get();
        //return $evaluated_month;
        //  // $company_check=$this->company;
        $months=[];
        foreach($evaluated_month as $item)
        {
        
        array_push($months,date("M",mktime(0,0,0,(int)$item->month)));
        }
        //to get remaning months and the current month i want to edit    
        $unevaluated_months= array_diff($all_months,$months);
        */
        return view('evaluations.edit_employeevaluation', compact('evaluation_keies',
            'evaluationemploye','subdomain'));
        return response()->json($evaluation_keies);
    }


    public function update_empevaluation($subdomain,Request $request, $id)
    {

  //return $id;
  //return $request;
        $eval_emp = employee_evaluation::where('id', $id)->where('month', $request->
            month)->delete();

        $emp_degree = 0;
        foreach ($request->degree as $value)
        {
            $emp_degree += $value;
        }

        $evaluation_degree = 0;
        foreach ($request->basic_degree as $key => $degree)
        {
            $evaluation_degree += $degree;

        }

        // return $evaluation_degree;
        $company_check = $this->company;
        $evaluation_employe = array(
            'user_id' => $request->user_id,
            'month' => $request->month,
            'year' => $request->year,
            'evalution_jobs_id' => $request->jobevaluation_id,
            'element_degree' => json_encode($request->degree),
            'emp_degree' => $emp_degree,
            'evaluation_degree' => $evaluation_degree,
            'company_id' => $company_check->id,
            );


        $evaluation_empstore = employee_evaluation::create($evaluation_employe);
        if (!is_null($evaluation_empstore))
        {
            toastr()->success(trans('trans.data_edit_successfly'));
            return back()->with('', ' added successfully.');
        }
        // else return with error message
        else
        {

            return back()->with('error', 'messages.error');
        }


    }


    public function delete_empevaluation($subdomain,Request $request)
    {

        employee_evaluation::find($request->id)->delete();
    }



    //not use
    public function evaluation_search($subdomain,Request $request)
    {
    //    // return response()->json($request);
         
    //     $company_check = $this->company;
    //     $roles_=Role::where('company_id',$company_check->id)->wherein('name',['super_admin','admin','manger'])->pluck('id');
     
    //      $date=date_create(date("Y-m-d"));
         
    //      $roles=Auth::user()->role()->first();
      
    //      $company=$this->company;
    //      $search = $request->all();
    //      //return response()->json($search);
    //      if(!empty($search)){
    //         //$month=$search['month']; 
    //           $user=$search['employee_name']?$search['employee_name']:'all';
           
    //          $department=$search['department']?$search['department']:'all';
    //          $branch=$search['branch']?$search['branch']:'all';
    //          $search['month']=$search['month']=='all'?date_format($date,"m"):$search['month'];
    //          $search['year']=$search['year']=='all'?date_format($date,"Y"):$search['year'];
    //           $eval_date["curr_date"]["month"]=$search['month'];
    //           $eval_date["curr_date"]["year"]=$search['year'];
    //          $users = User::select("users.company_id as cm_id", "users.name as user_name",
    //         "users.id as user_id", "branches.title as branch_name", 'jobs.title as job_name'
    //         ,'departments.title as department_name',"users.job_id")
    //         ->join("branches", "users.branch_id", "=", "branches.id")
    //         ->Join("jobs","users.job_id", "=", "jobs.id")
    //         ->join('departments', 'departments.id', '=', 'users.department_id')
    //          ->where('users.company_id',"=", $this->company->id)
    //          ->Where(function($query) use($roles_)
    //           {
                        
    //                 $query->whereNotIn('users.role_id', $roles_)
    //                 ->orwhere('users.role_id', "=", null);
    //                 $query->where('users.company_id',"=", $this->company->id);
                                  
    //          })
           
    //           ->Where(function($query1) use ($department,$branch,$user)
    //               {
    //                         if($department!='all')
    //                            {
    //                                $query1->where('users.department_id','=',$department);
                                                  
    //                              }
    //                           if($branch!='all')
    //                            {
    //                                $query1->where('users.branch_id','=',$branch);
                                                  
    //                              }
    //                            if($user!='all')
    //                            {
    //                                $query1->where('users.id','=',$user);
                                                  
    //                              }
                                        
    //                      })
             
    //          ->paginate(5)
    //          ->appends('search',$request->all());
    //         //->appends(Input::except('page'))

    //         //  ->get();
      
       
     
    //     $evalarray = [];
    // // DB::connection()->enableQueryLog();
    //   foreach ($users as $user)
    //   {
         
             
       
    //     foreach($eval_date as $index=>$item)
    //     {
            
    //       $jobelemnevalt =evaluation_elements_jobs::where('job_id', $user->job_id)
    //       ->where('company_id',$company_check->id)->first('job_id');
    //        $data = employee_evaluation::where('user_id', $user->user_id)
    //              ->where('month',
    //              $item["month"])->where('year',$item["year"])
    //              ->first();
         
    //             $result['user_id'] = $user->user_id;
    //             $result['user_name'] = $user->user_name;
    //             $result['company_id'] = $user->cm_id;
    //             $result['job'] = $user->job_name;
    //             $result['job_id'] = $user->job_id;
    //             $result['jobelements']=evaluation_elements_jobs::where('job_id',$result['job_id'])->where('company_id',$company_check->id)->pluck('job_id');
    //             $result['department'] = $user->department_name;
    //             $result['branch'] = $user->branch_name;
    //             $result['month'] =$data?$data->month:$item["month"];
    //             $result['year'] = $data?$data->year:$item["year"];
    //             $result['jobelemnevalt'] =  $jobelemnevalt;
    //             $result['element_degree'] = $data?$data->element_degree:"";
    //             $result['emp_degree'] = $data?$data->emp_degree:"";
    //             $result['evaluation_degree'] = $data?$data->evaluation_degree:"";
    //             $result['evalution_jobs_id'] = $data?$data->evalution_jobs_id:"";
    //             $result['evalution_id'] = $data?$data->id:"";
    //        array_push($evalarray, $result);
           
              
    //     }
           
           
    //     }
   
    //    // return response()->json($evalarray);
        

    //    return view('evaluations.evaluationsearch', compact('evalarray', 'branch',
    //    'department', 'user','users'));

    //    // return view("evaluations.evaluationsearch",compact('evalarray','users'));
    //     // return view("evaluations.employes_evaluations",compact('evalarray'));
       
    //      }
       

    }
       
    
       public function evaluation_report($subdomain,Request $request)
         {
          
         $company=$this->company;
         $roles_=Role::where('company_id',$company->id)->wherein('name',['super_admin','admin','manger'])->pluck('id');
       
        // return response()->json($roles_);
        
        $manger_branch_id= $this->branch_id;
        $manger_department_id= $this->department_id;
     
        $branchs=Branch::where('company_id', $company->id) ->Where(function($query) use ($manger_branch_id){
                                                            if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                                $query->where('branches.id',$manger_branch_id);
                                                           })->get();

        $departments=Department::where('company_id', $company->id)
                                        ->Where(function($query) use ($manger_department_id){
                                        if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                             $query->where('departments.id',$manger_department_id);
                                             })
                               ->get();
         
        $employees= User::select("users.company_id as cm_id", "users.name as user_name",
            "users.id as user_id", "branches.title as branch_name", 'jobs.title as job_name','departments.title as department_name')
            ->join("branches", "users.branch_id", "=", "branches.id")
            ->Join("jobs","users.job_id", "=", "jobs.id")
            ->join('departments', 'departments.id', '=', 'users.department_id')
             ->Where(function($query) use($roles_)
              {
                    $query->whereNotIn('users.role_id', $roles_)
                    ->orwhere('users.role_id', "=", null);
                    $query->where('users.company_id',"=", $this->company->id);
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

         

       
        $now = Carbon::now();
        $month=$now->month;
      
        $search= $request->all();
        
       
          
           // return response()->json($search);
           //return response()->json($search);
            $monthly=array();   
             if(isset($search['department']))$department=$search['department'];else $department='all';
             if(isset($search['branch']))$branch=$search['branch']; else $branch='all'; 
             if(isset($search['user'])) $user=$search['user'];else $user='all';
             if(isset($search['from_month'])&& $search['from_month']!='NaN')$from_month=$search['from_month']; else $from_month='';
             if(isset($search['from_year']) && $search['from_year']!='NaN')  $from_year=$search['from_year']; else  $from_year='';
             if(isset( $search['to_month'])&& $search['to_month']!='NaN')$to_month=$search['to_month']; else $to_month='';
             if(isset($search['to_year'])&& $search['to_year']!='NaN')  $to_year=$search['to_year']; else  $to_year='';
       
            
            $empevalu=employee_evaluation::select('employee_evaluations.*','users.name', "branches.title as branch_name"
                     ,'departments.title as department_name','jobs.title as job_name','users.job_id as job_id')
            ->join("users","users.id","=","employee_evaluations.user_id")
            ->join("branches", "users.branch_id", "=", "branches.id")
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->Join("jobs","users.job_id", "=", "jobs.id")

           
            ->Where(function($query) use($roles_)
              {
                        
                    $query->whereNotIn('users.role_id', $roles_)
                    ->orwhere('users.role_id', "=", null);
                    $query->where('users.company_id',"=", $this->company->id);
                           
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

            ->paginate(12);
         
            $monthly=$this->evalution_report($empevalu);
          

//return $empevalu;
/*
     //start foreach
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

            // return $result['month'];
            //ÇáÍÖæÑ##########################
            $currentdaysmonth=Attendance::select('*')
            ->whereMonth('attendances.created_at',$result['month'])
            ->whereYear('attendances.created_at',$result['year'])
            ->where('attendances.company_id',$result['company_id'])
            //  $user->user_id
            ->where('attendances.user_id', $result['user_id'])
            ->distinct((DB::raw('DATE(attendances.created_at)')))
            ->count();
              //return $currentdaysmonth;
          //ÇáÍÖæÑ æÇáÍÖæÑ ãÊÃÎÑ
          $allattendances=Attendance::where('user_id',$result['user_id'])
          ->where('company_id',$result['company_id'])
          ->whereMonth('created_at',$result['month'])
          ->whereYear('created_at',$result['year'])
          ->wherein('status',['attend','Attendance_discount'])
          ->distinct((DB::raw('DATE(attendances.created_at)')))
          ->count();

          if($currentdaysmonth==0) $allattendances_precnet=0; else $allattendances_precnet=($allattendances/$currentdaysmonth);

                //  return $allattendances_precnet;
              ###################ÇáÅáÊÒÇã################
              $propriety=Attendance::where('user_id',$result['user_id'])
              ->where('company_id',$result['company_id'])
              ->whereMonth('created_at',$result['month'])
              ->whereYear('created_at',$result['year'])
              ->wherein('status',['attend'])
              ->distinct((DB::raw('DATE(attendances.created_at)')))
              ->count();
              if($currentdaysmonth==0)$propriety_precnet=0; else $propriety_precnet= ($propriety/$currentdaysmonth);

                #############ÇáÒíÇÑÇÊ#####################
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

                #############ÇáãåÇã#####################
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
              // return $evaluationjob;
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
                      if($res["title"]=='ÇáÍÖæÑ') $res["precnet"]=($allattendances_precnet*$res["degree"]);
                      if($res["title"]=='ÇáÅáÊÒÇã') $res["precnet"]=($propriety_precnet*$res["degree"]);
                      if($res["title"]=='ÇáÒíÇÑÇÊ') $res["precnet"]=($outdoor_precnet*$res["degree"]);
                      if($res["title"]=='ÇáãåÇã')  $res["precnet"]=($alltasks_precnet*$res["degree"]);
                      $total_precent +=round($res["precnet"],2);
                  }
                }
             $result['element_degree'] = $data?$data->element_degree:"";
             $result['emp_degree'] = $data?$data->emp_degree:"";
             if($result['emp_degree']=="")$result['emp_degree']=$total_precent;else $result['emp_degree']=$result['emp_degree']+$total_precent;
             $result['evaluation_degree'] = $data?$data->evaluation_degree:"";
             $result['evalution_jobs_id'] = $data?$data->evalution_jobs_id:"";
             $result['evalution_id'] = $data?$data->id:"";
             array_push($monthly,$result);
             
            }
          //end foreach
          return $monthly;
        
       */ 

        if($request->ajax())
        {
                return view('reports.evaluationreport_ajax')->with(compact('monthly','departments','branchs','employees','empevalu','subdomain')
              );  
              
           
        }
        else
        {
              
              return view('reports.evaluation_report')->with(compact('monthly','departments','branchs','employees','empevalu','subdomain')
             );  
                
         
        }
           
           
            

        
                    
                
          }

      
          

       
    
    /**
     * 
     *  user Report 
     * 
     */
    
  public function showevaluation_employes($subdomain)
  {
    return   view('evaluations.showemployes_evalchart',compact('subdomain'));
  }


  public function showemploye_chart(Request $request)
    {
       


     
    
     $company_check = $this->company;
     $roles_=Role::where('company_id',$company_check->id)->wherein('name',['super_admin','admin','manger'])->pluck('id');
  
      $date=date_create(date("Y-m-d"));
  
      $company=$this->company;
      $search = $request->all();
    
      if(!empty($search)){
         //$month=$search['month']; 
           $user=$search['employee_id']?$search['employee_id']:'';
         // return response()->json();
           //$search['month']=$search['month']=='all'?date_format($date,"m"):$search['month'];
           $search['year']=$search['year']=='all'?date_format($date,"Y"):$search['year'];
         //  $eval_date["curr_date"]["month"]=$search['month'];
           $eval_date1["curr_date"]["year"]=$search['year'];
          //DB::connection()->enableQueryLog();
          
          $users = User::select("users.company_id as cm_id", "users.name as user_name",
         "users.id as user_id", "branches.title as branch_name", 'jobs.title as job_name','departments.title as department_name'
         ,'users.job_id')
         ->join("branches", "users.branch_id", "=", "branches.id")
         ->Join("jobs","users.job_id", "=", "jobs.id")
         ->join('departments', 'departments.id', '=', 'users.department_id')
          ->where('users.company_id',"=", $this->company->id)
          ->Where(function($query1) use ($user,$company)
               {
                        
                            if($user!='all')
                            {
                                $query1->where('users.id','=',$user);
                                $query1->where('users.company_id',"=", $company->id);
                                               
                             }
                                     
                 })
          
          ->first();
   
        $month=['01','02','03','04','05','06','07','08','09','10','11','12'];
        $chartarray=array();

  foreach($month as $index1=>$month1)
  {
           //return response()->json($item);
            //get days from begin date of month until now from attendance table
        //ÇáÍÖæÑ##########################
        $currentdaysmonth=Attendance::select('*')
        ->whereMonth('attendances.created_at',$month1)
        ->whereYear('attendances.created_at',$eval_date1["curr_date"]["year"])
        ->where('attendances.company_id',$company_check->id)
       //  $user->user_id
        ->where('attendances.user_id', $users->user_id)
        ->distinct((DB::raw('DATE(attendances.created_at)')))
        ->count();
        
        // return response()->json($item);
      //ÇáÍÖæÑ æÇáÍÖæÑ ãÊÃÎÑ
      $allattendances=Attendance::where('user_id',$users->user_id)
      ->where('company_id',$company_check->id)
      ->whereMonth('created_at',$month1)
      ->whereYear('created_at',$eval_date1["curr_date"]["year"])
      ->wherein('status',['attend','Attendance_discount'])
      ->distinct((DB::raw('DATE(attendances.created_at)')))
      ->count();
      if($currentdaysmonth==0) $allattendances_precnet=0; else $allattendances_precnet=($allattendances/$currentdaysmonth);
    
     // return response()->json($allattendances);

//  ###################ÇáÅáÊÒÇã################
 $propriety=Attendance::where('user_id',$users->user_id)
 ->where('company_id',$company_check->id)
 ->whereMonth('created_at',$month1)
 ->whereYear('created_at',$eval_date1["curr_date"]["year"])
 ->wherein('status',['attend'])
 ->distinct((DB::raw('DATE(attendances.created_at)')))
 ->count();
 
 if($currentdaysmonth==0)$propriety_precnet=0; else $propriety_precnet= ($propriety/$currentdaysmonth);
 
  #############ÇáÒíÇÑÇÊ#####################
  $allOutdoor=Outdoor::where('user_id',$users->user_id)
  ->where('company_id',$company_check->id)
  ->whereMonth('created_at',$month1)
  ->whereYear('created_at',$eval_date1["curr_date"]["year"])
  ->count();


  $done_outdoors=Outdoor::where('user_id',$users->user_id)
  ->where('company_id',$company_check->id)
  ->whereMonth('created_at',$month1)
  ->whereYear('created_at',$eval_date1["curr_date"]["year"])
  ->where('status','done')
  ->count();
  // return $done_outdoors;
   

  if($allOutdoor==0)$outdoor_precnet=0; else $outdoor_precnet=($done_outdoors/$allOutdoor);
//return response()->json($outdoor_precnet);
   #############ÇáãåÇã#####################
   $alltasks=Task::where('user_id',$users->user_id)
   ->where('company_id',$company_check->id)
   ->whereMonth('start_date',$month1)
   ->whereYear('start_date',$eval_date1["curr_date"]["year"])
   ->count();


 $done_tasks=Task::where('user_id',$users->user_id)
   ->where('company_id',$company_check->id)
   ->whereMonth('created_at',$month1)
   ->whereYear('created_at',$eval_date1["curr_date"]["year"])
   ->where('status','done')
   ->count();


//  return response()->json($done_tasks);
  if($alltasks==0) $alltasks_precnet=0; else $alltasks_precnet=($done_tasks/$alltasks);
 // return $alltasks_precnet;
   
// ////////////////
$evaluationjob = evaluation_elements_jobs::where('job_id', $users->job_id)
->where('company_id',$company_check->id)
->first();
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
      if($reuslt["title"]=='ÇáÍÖæÑ') $reuslt["precnet"]=($allattendances_precnet*$reuslt["degree"]);
      if($reuslt["title"]=='ÇáÅáÊÒÇã') $reuslt["precnet"]=($propriety_precnet*$reuslt["degree"]);
      if($reuslt["title"]=='ÇáÒíÇÑÇÊ') $reuslt["precnet"]=($outdoor_precnet*$reuslt["degree"]);
      if($reuslt["title"]=='ÇáãåÇã')  $reuslt["precnet"]=($alltasks_precnet*$reuslt["degree"]);
    $total_precent +=round($reuslt["precnet"],2);
  }

  
}

//return response()->json('dddd');
// return response()->json($total_precent);
// return response()->json($total_precent);
//return response()->json($total_precent);
 /////////////
          $data1 = employee_evaluation::where('user_id', $users->user_id)
                 ->where('month',$month1)
                 ->where('year',$eval_date1["curr_date"]["year"])
                 ->first();
          // if(is_null($data1)) return response()->json('fffff');
                 $chartarray[$index1]['month'] =$data1?date("M",mktime(0,0,0,$data1->month)):date("M",mktime(0,0,0,$month1));
                
                 $empdegree=$data1?$data1->emp_degree:0;
               
                 $evaluationdegree= $data1?$data1->evaluation_degree:0;
               if($empdegree==0)
               {
                   $chartarray[$index1]['emp_degree']=$total_precent;
               }
               else 
               {

                //$Total=($empdegree/$evaluationdegree)*100;
                $Total=$total_precent+$empdegree;

                $chartarray[$index1]['emp_degree']=round($Total,1);
                //$Total=($empdegree/$evaluationdegree)*100;
                  //$Total=$empdegree;
                 // $chartarray[$index1]['emp_degree']=0;
               }
           
              //  return response()->json($chartarray[$index]['emp_degree']);
              // return response()->json($month1);

        }
        return response()->json($chartarray);

      }
     
   
        
    }
            
        
 public function jobchart($subdomain)
    {
      // print_r('gggg');die;
        $company_check = $this->company;
        $data['jobs']=Job::where('company_id',$company_check->id)->get();
        $data['subdomain']=$subdomain;
        //return $jobs;
        
       return view('evaluations.job_charts',$data);
      
    }

 public function showjobcharts(Request $request)
    {
      
      $company_check = $this->company;
        $roles_=Role::where('company_id',$company_check->id)->wherein('name',['super_admin','admin','manger'])->pluck('id');
        $search=$request->all();
        if(!empty($search))
        {

            $job_id=$search['job_id'];
            $year=$search['year'];
            $month=$search['month'];


            $jobchart=array();
            $users = User::select("users.company_id as cm_id", "users.name as user_name",
            "users.id as user_id" ,'jobs.title as job_name','users.job_id')
            ->Join("jobs","users.job_id", "=", "jobs.id")
             ->where('users.job_id','=',$job_id)
             ->Where(function($query) use($roles_,$company_check)
              {
                 
                    $query->whereNotIn('users.role_id', $roles_)
                    ->orwhere('users.role_id', "=", null);
                    $query->where('users.company_id',"=", $company_check->id);
                           
             })->get();

             $job_chart=$this->user_evalution($users,$month,$year,$company_check->id);
             return response()->json($job_chart);
          }
        }

     // return response()->json($users);
       
        
  public function showdeparteval($subdomain)
  {
    $company_check = $this->company;
    $departments=Department::where('company_id',$company_check->id)->get();
   // return $departments;
    return view('evaluations.department_chartseval',compact('departments','subdomain'));
  }

  public function showdepartmentscharts(Request $request)
  {
    
       $company_check = $this->company;
        $roles_=Role::where('company_id',$company_check->id)->wherein('name',['super_admin','admin','manger'])->pluck('id');
        $search=$request->all();
        if(!empty($search))
        {

            $department_id=$search['depart_id'];
            $year=$search['year'];
            $month=$search['month'];
            $jobchart=array();
            $users = User::select("users.company_id as cm_id", "users.name as user_name","users.job_id",
            "users.id as user_id" ,'departments.title as job_name')
            ->Join("departments","users.department_id", "=", "departments.id")
             ->where('users.department_id','=',$department_id)
             ->Where(function($query) use($roles_,$company_check)
              {
                 
                    $query->whereNotIn('users.role_id', $roles_)
                    ->orwhere('users.role_id', "=", null);
                    $query->where('users.company_id',"=", $company_check->id);
                           
             })->get();

             $department_chart=$this->user_evalution($users,$month,$year,$company_check->id);
             return response()->json($department_chart);  
                       
          }
                  
                  
   
  }

  public function showbrancheval($subdomain)
  {
    $company_check=$this->company;
    $branchs=Branch::where('company_id',$company_check->id)->get();
    return view('evaluations.branch_charts',compact('branchs','subdomain'));
  }

  public function showbranchcharts(Request $request)
  {
     
    $company_check = $this->company;
    $company_id= $company_check->id;
    $roles_=Role::where('company_id',$company_check->id)->wherein('name',['super_admin','admin','manger'])->pluck('id');
    $search=$request->all();
    if(!empty($search))
    {

        $branch_id=$search['branch_id'];
        $year=$search['year'];
        $month=$search['month'];


        // $jobchart=array();
        $users = User::select("users.company_id as cm_id", "users.name as user_name","users.job_id",
        "users.id as user_id" ,'branches.title as branch_name')
         ->Join("branches","users.branch_id", "=", "branches.id")
         ->where('users.branch_id','=',$branch_id)
         ->Where(function($query) use($roles_,$company_check)
          {
             
                $query->whereNotIn('users.role_id', $roles_)
                ->orwhere('users.role_id', "=", null);
                $query->where('users.company_id',"=", $company_check->id);
                       
         })->get();

       
         $branch_chart=$this->user_evalution($users,$month,$year,$company_check->id);
         return response()->json($branch_chart);
       

         
                   
      }
           
  }
        
       
  }
         
      
        
        
 
    
 
  


