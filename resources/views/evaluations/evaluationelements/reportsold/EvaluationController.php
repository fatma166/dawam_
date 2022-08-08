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
use Validator;
use App\Http\Controllers\Admin\JobController;
use App\Models\Job;
use App\Models\Department;
use App\Models\Branch;

use App\Models\evaluation_elements_jobs;
use App\Models\employee_evaluation;


use  App\Http\Controllers\Admin\BaseController;

use App\Models\Attendance;
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




class EvaluationController extends BaseController
{

    public function index()
    {

        $company_check = $this->company;
        //$company_check=Company::join('users','users.company_id','=','companies.id')->where(array('users.id'=>Auth::user()->id,'role_id'=>1))->first();

        $companies = array();
        $evaluation = evaluation_element::where('company_id', $company_check->id)->get();

        $jobs = Job::where('company_id', $company_check->id)->get();
        return view('evaluations.evaluation_list', compact('evaluation', 'jobs'));


    }


    public function store(Request $request)
    {


        $company_check = $this->company;


        $req = Validator::make($request->all(), [ /** abdelkawy validation title field in store  */
            'title' => 'required|unique:evaluation_elements', ]);


        if ($req->passes())
        {


            /**   save in database  */
            $input = array('title' => $request->title, 'company_id' => $company_check->id);
            $evaluation = evaluation_element::create($input);
            if (!is_null($evaluation))
            {
                return response()->json(['success' => 'Added successfully.']);
            }

        } else
        {
            return response()->json(['error' => $req->errors()->all()]);
        }

    }


    public function edit($id)
    {


        $company_check = $this->company;

        $evaluation = evaluation_element::where('id', $id)->first();
        return response()->json($evaluation);

    }

    public function update(Request $request, $id)
    {

        $req = Validator::make($request->all(), [ /** abdelkawy validation title field in store  */
            'title' => 'required|unique:evaluation_elements,title,' . $id, ]);


        if ($req->passes())
        {
            $evaluations = $request->all();

            $evaluation_update = array('title' => $evaluations['title']);
            evaluation_element::where('id', $id)->update($evaluation_update);
            return response()->json(['success' => ' updated successfully.']);
        } else
        {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }
    public function delete(Request $request)
    {

        evaluation_element::where('id', $request->id)->delete();
        return back()->with('success', 'Delete successfully.');
    }


    //for job evaluation
    public function evalutaionjob_index()
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
   
      
      return view('evaluations.job_evaluations',compact('evaluation','jobs','evaluation_keies'));
    }


    public function storeevaluationjobs(Request $request)
    {


        /**   $evalelem=$request->All();*/

        $evalelem = $request->All();

        // print_r($evalelem);die();
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

            return back()->with('success', ' added successfully.');
        }
        // else return with error message
        else
        {

            return back()->with('error', 'messages.error');
        }


    }


    public function edit_evaluation($id)
    {
        $company_check = $this->company;
        $data = evaluation_elements_jobs::where('id', $id)->where('company_id', $company_check->
            id)->first();
        $jobeval = Job::where('id', $data->job_id)->where('company_id', $company_check->
            id)->first('title');

        return response()->json(['jobevalution' => $data, 'jobtitle' => $jobeval]);

    }

    public function update_evaluationjob(Request $request, $id)
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
            return back()->with('success', ' updated successfully.');
        }
        // else return with error message
        else
        {

            return back()->with('error', 'messages.error');
        }


    }


    public function delete_evalutionjob(Request $request)
    {

        evaluation_elements_jobs::where('id', $request->id)->delete();
        return back()->with('success', 'Delete successfully.');
    }


    public function evaluationemployes_index()
    {
        
       
         $date=date_create(date("Y-m-d"));
         $eval_date["curr_date"]["month"]=date_format($date,"m");
         $eval_date["curr_date"]["year"]=date_format($date,"Y");
         date_sub($date,date_interval_create_from_date_string("1 month"));
         $eval_date["prev_date"]["month"]=date_format($date,"m");
         $eval_date["prev_date"]["year"]=date_format($date,"Y");
       
     
        $company_check = $this->company;
        $branchs = Branch::where('company_id', $company_check->id)->get();
        $departments = Department::where('company_id', $company_check->id)->get();
        $employees = User::select('users.*', 'departments.title as dep_title',
            'branches.title as branch_title')->where('users.company_id', $company_check->id)->
            join('departments', 'departments.id', '=', 'users.department_id')->join('branches',
            'branches.id', '=', 'users.branch_id')->where('users.id', '!=', Auth::user()->
            id)->get();

     
        //$user=User::where('company_id',$company_check->id)->where('role_id',"!=",1);
        $users = User::select("users.company_id as cm_id", "users.name as user_name",
            "users.id as user_id", "branches.title as branch_name", 'jobs.title as job_name','departments.title as department_name')
            ->join("branches", "users.branch_id", "=", "branches.id")
            ->Join("jobs","users.job_id", "=", "jobs.id")
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->where('users.company_id', $company_check->id)->
            where('users.role_id', "!=", 1)->get();
            
          
        // return $users;


        /* $users=User::where('company_id',$company_check->id)->where('role_id',"!=",1)->get();
        //return $users;*/
        $evalarray = [];

        foreach ($users as $user)
        {
            
        foreach($eval_date as $index=>$item)
        {
            
        
           $data = employee_evaluation::where('user_id', $user->user_id)
                 ->where('month',
                 $item["month"])->where('year',$item["year"])
                 ->first();
                $result['user_id'] = $user->user_id;
                $result['user_name'] = $user->user_name;
                $result['company_id'] = $user->cm_id;
                $result['job'] = $user->job_name;
                $result['department'] = $user->department_name;
                $result['branch'] = $user->branch_name;
                $result['month'] =$data?$data->month:$item["month"];
                $result['year'] = $data?$data->year:$item["year"];
                $result['element_degree'] = $data?$data->element_degree:"";
                $result['emp_degree'] = $data?$data->emp_degree:"";
                $result['evaluation_degree'] = $data?$data->evaluation_degree:"";
                $result['evalution_jobs_id'] = $data?$data->evalution_jobs_id:"";
                $result['evalution_id'] = $data?$data->id:"";
           array_push($evalarray, $result);
          
          
        }
        
            
        }


        //  return $evalarray;


        //   $data_evaluation=employee_evaluation::employeesEvaluations($company_check->id);
        // return $data_evaluation;
        // return view('evaluations.employes_evaluations',compact('data_evaluation','branchs','departments','employees'));


        return view('evaluations.employes_evaluations', compact('evalarray', 'branchs',
            'departments', 'employees'));


    }


    public function getemployejob_id($id)
    {
          // evaluation-month="{{$item['month']}}"
          // evaluation-year="{{$item['year']}}"
       
        $user = User::find($id);

        //  return response()->json($users);
        //$evaluation1= evaluation_element::where('company_id',$company_check->id)->get();

        $evaluationjob = evaluation_elements_jobs::where('job_id', $user->job_id)->
            first();
        // return response()-> json($evaluationjob);
        //return response()->json()$ev)
       
        $evaljob_id = $evaluationjob->id;
        $items = json_decode($evaluationjob["element_degree"]);
        // $items= json_decode($evaluationjob->element_degree);

        $evaluation_keies = [];

        foreach ($items as $index => $item)
        {

            $key = evaluation_element::find($index);
            $reuslt["id"] = $key->id;
            $reuslt["title"] = $key->title;
            $reuslt["degree"] = $item;
            $reuslt["evaljob_id"] = $evaljob_id;
            array_push($evaluation_keies, $reuslt);
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
        return view("evaluations.evaluation_table", compact('evaluation_keies', 'user'));


    }

    public function store_employeevaluation(Request $request)
    {


     //  return $request;
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

            return back()->with('success', ' added successfully.');
        }
        // else return with error message
        else
        {

            return back()->with('error', 'messages.error');
        }


    }


    public function evaluationemp_edit($id)
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
            'evaluationemploye'));
        return response()->json($evaluation_keies);
    }


    public function update_empevaluation(Request $request, $id)
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

            return back()->with('success', ' added successfully.');
        }
        // else return with error message
        else
        {

            return back()->with('error', 'messages.error');
        }


    }


    public function delete_empevaluation(Request $request)
    {

        employee_evaluation::find($request->id)->delete();
    }


    public function evaluation_search(Request $request)
    {
        
      //  return response()->json($request);
         $date=date_create(date("Y-m-d"));
         $eval_date["curr_date"]["month"]=date_format($date,"m");
         $eval_date["curr_date"]["year"]=date_format($date,"Y");
         date_sub($date,date_interval_create_from_date_string("1 month"));
         $eval_date["prev_date"]["month"]=date_format($date,"m");
         $eval_date["prev_date"]["year"]=date_format($date,"Y");
     
         $company=$this->company;
         $search = $request->all();
         //return response()->json($search);
         if(!empty($search)){
            //$month=$search['month']; 
             $user=$search['employee_name']?$search['employee_name']:'all';
             $department= $search['department']? $search['department']:'all';
             $branch=$search['branch']?$search['branch']:'all';
            // $year=$search['year']?$search['year']:'all';
             //$month=$search['month']?$search['month']:'all';
        
             if($search['employee_name']=="null"){$user='all';}
             //if($user!='all' || $department!='all' || $branch!='all')
             if($user!='all'||$department!='all'||$branch!='all')
             {
             
                  $users= User::select("users.company_id as cm_id", "users.name as user_name",
                         "users.id as user_id", "branches.title as branch_name", 'jobs.title as job_name','departments.title as department_name')
                        ->join("branches", "users.branch_id", "=", "branches.id")
                        ->Join("jobs","users.job_id", "=", "jobs.id")
                       ->join('departments', 'departments.id', '=', 'users.department_id')
                       ->where('users.company_id', $company->id)
                       ->where('users.role_id', "!=", 1)
                      // ->where('users.id', "=", $user)
                      ->Where(function($query) use ($department,$branch,$user){
                                    if($user!='all')
                                       $query->where('users.id',$user);
                                    if($department!='all')
                                        $query->where('users.department_id',$department);
                                    if($branch!='all')
                                        $query->where('users.branch_id',$branch);
                               })->get();

             }
             elseif($branch='all')
             {
                       $users= User::select("users.company_id as cm_id", "users.name as user_name",
                         "users.id as user_id", "branches.title as branch_name", 'jobs.title as job_name','departments.title as department_name')
                        ->join("branches", "users.branch_id", "=", "branches.id")
                        ->Join("jobs","users.job_id", "=", "jobs.id")
                       ->join('departments', 'departments.id', '=', 'users.department_id')
                       ->where('users.company_id', $company->id)
                       ->where('users.role_id', "!=", 1)->get();
             }     
                    
           
             elseif($department='all')
             {
                       $users= User::select("users.company_id as cm_id", "users.name as user_name",
                         "users.id as user_id", "branches.title as branch_name", 'jobs.title as job_name','departments.title as department_name')
                        ->join("branches", "users.branch_id", "=", "branches.id")
                        ->Join("jobs","users.job_id", "=", "jobs.id")
                       ->join('departments', 'departments.id', '=', 'users.department_id')
                       ->where('users.company_id', $company->id)
                       ->where('users.role_id', "!=", 1)->get();
             }     
       
      // return response()->json($users);
        $evalarray = [];
      //  return response()->json($evalarray);
          foreach ($users as $user)
        {
     
        foreach($eval_date as $index=>$item)
            {
       
               $data = employee_evaluation::where('user_id', $user->user_id)
                     ->where('month',
                     $item["month"])->where('year',$item["year"])
                     ->first();
                    $result['user_id'] = $user->user_id;
                    $result['user_name'] = $user->user_name;
                    $result['company_id'] = $user->cm_id;
                    $result['job'] = $user->job_name;
                    $result['department'] = $user->department_name;
                    $result['branch'] = $user->branch_name;
                    $result['month'] =$data?$data->month:$item["month"];
                    $result['year'] = $data?$data->year:$item["year"];
                    $result['element_degree'] = $data?$data->element_degree:"";
                    $result['emp_degree'] = $data?$data->emp_degree:"";
                    $result['evaluation_degree'] = $data?$data->evaluation_degree:"";
                    $result['evalution_jobs_id'] = $data?$data->evalution_jobs_id:"";
                    $result['evalution_id'] = $data?$data->id:"";
               array_push($evalarray, $result);
       
            }
        
            
        }
        return view("evaluations.evaluationsearch",compact('evalarray'));
       
         }

       }
       
       
       
       
       public function evaluation_report(Request $request)
       {
        
              $company=$this->company;
              $manger_branch_id= $this->branch_id;
              $manger_department_id= $this->department_id; 
              $branchs=Branch::where('company_id', $company->id)
                             ->Where(function($query) use ($manger_branch_id){
                              if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                              $query->where('branches.id',$manger_branch_id);
                                                               })->get();
                                                               
            $departments=Department::where('company_id', $company->id)
                         ->Where(function($query) use ($manger_department_id){
                         if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                         $query->where('departments.id',$manger_department_id);
                         }) ->get();
                                  
           $employees=User::select('users.*','departments.title as dep_title','branches.title as branch_title')->where('users.company_id',$company->id)->join('departments', 'departments.id', '=', 'users.department_id')->join('branches', 'branches.id', '=', 'users.branch_id')
                            ->Where(function($query1) use ($manger_branch_id,$manger_department_id){
                                   if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                         $query1->where('users.branch_id',$manger_branch_id);
                                   if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                         $query1->where('users.department_id',$manger_department_id); })  
                                        ->where('users.id', '!=' , Auth::user()->id)->get();
         
          $search=$request->All();   
          $type="not_ajax";   
         
          if(empty($search) && $type!="ajax") 
          {
              $users= User::select("users.company_id as cm_id", "users.name as user_name",
                "users.id as user_id", "branches.title as branch_name", 'jobs.title as job_name','departments.title as department_name')
                ->join("branches", "users.branch_id", "=", "branches.id")
                ->Join("jobs","users.job_id", "=", "jobs.id")
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->where('users.company_id', $company->id)
                ->where('users.role_id', "!=", 1)->get();
                      // ->where('users.id', "=", $user)
           $evalarray = [];
               foreach ($users as $user)
            {
         
          
           
                   $data = employee_evaluation::where('user_id', $user->user_id)->where('year',date('Y'))
                         ->get();
                   //$data = employee_evaluation::where('user_id', $user->user_id)
                        // ->paginate(3);
                       //return $data;
                       foreach($data as $data)
                       {
                     
                        $result['user_id'] = $user->user_id;
                        $result['user_name'] = $user->user_name;
                        $result['company_id'] = $user->cm_id;
                        $result['job'] = $user->job_name;
                        $result['department'] = $user->department_name;
                        $result['branch'] = $user->branch_name;
                        $result['month'] =$data?$data->month:'';
                        $result['year'] = $data?$data->year:'';
                        $result['element_degree'] = $data?$data->element_degree:"";
                        $result['emp_degree'] = $data?$data->emp_degree:"";
                        $result['evaluation_degree'] = $data?$data->evaluation_degree:"";
                        $result['evalution_jobs_id'] = $data?$data->evalution_jobs_id:"";
                        $result['evalution_id'] = $data?$data->id:"";
                         array_push($evalarray, $result);
                       }
                  
              
                
            }
             return view("evaluations.evaluation_report",compact('evalarray','type','departments','branchs','employees')); 
            
         }
                  
           
       }
       
       
                            
       
       public function monthReport(Request $request)
       {
                
          //$company=Company::join('users','users.company_id','=','companies.id')->where(array('users.id'=>Auth::user()->id,'role_id'=>1))->first();
       // $employees=User::where('company_id',$company->id)->get();
        $company=$this->company;
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
        $employees=User::select('users.*','departments.title as dep_title','branches.title as branch_title')->where('users.company_id',$company->id)->join('departments', 'departments.id', '=', 'users.department_id')->join('branches', 'branches.id', '=', 'users.branch_id')
                        ->Where(function($query1) use ($manger_branch_id,$manger_department_id){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query1->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query1->where('users.department_id',$manger_department_id);
                                   
                         })  
                       
                       ->where('users.id', '!=' , Auth::user()->id)->get();
        
        $now = Carbon::now();
        $search= $request->all();
        $month=$now->month;
        $type="not_ajax";    
        if(!empty($search)){$type="ajax";}

        if(!empty($search)){
            return $search;            
            //$month=$search['month']; 
             $date_from=$search['date_from']? $search['date_from']:Carbon::now()->format('Y')."-".$month."-".'1'; 
             $date_to=$search['date_to']? $search['date_to']:Carbon::now();
             $department= $search['department']? $search['department']:'all';
             $branch=$search['branch']? $search['branch']:'all'; 
             $user=$search['user']? $search['user']:'all';
             if($search['user']=="null"){$user='all';}
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
                                    
                                    
                                    ->get();
            
            
            
            
             }
               
        }else{
             $date_from=Carbon::now()->format('Y')."-".$month."-".'1';
             $date_to=Carbon::now()->format('Y')."-".$month."-".Carbon::now()->daysInMonth;
            $department=$branch= $user='all'; 
      
        }
       // echo $date_from; echo $date_to; exit;
        
        if(isset($search['year'])){
            $year =$search['year'];
        }else{
            
            $year=$now->year;
        }
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
               // print_r($holiday); exit; 
                if(isset($holiday->day)) {
                    $holiday_array=json_decode($holiday->day);
                   
                    $exception_holiday=0;
                        $holiday_=[];
                        foreach($holiday_array as $hol_key => $val){
                           
                           
                            $hol_key1 = [];
                            if($hol_key=="saturday")
                                $startDate = Carbon::parse($date_from)->next(Carbon::SATURDAY); // Get the first friday.
                            elseif($hol_key="sunday"){
                                 $startDate = Carbon::parse($date_from)->next(Carbon::SUNDAY); // Get the first friday.
                            }
                             elseif($hol_key="monday"){
                                 $startDate = Carbon::parse($date_from)->next(Carbon::MONDAY); // Get the first friday.
                            }
                            elseif($hol_key="thursday"){
                                 $startDate = Carbon::parse($date_from)->next(Carbon::THURSDAY); // Get the first friday.
                            }
                            elseif($hol_key="wednsday"){
                                 $startDate = Carbon::parse($date_from)->next(Carbon::WEDNSDAY); // Get the first friday.
                            }
                            elseif($hol_key="tuesday"){
                                 $startDate = Carbon::parse($date_from)->next(Carbon::TUESDAY); // Get the first friday.
                            }
                            elseif($hol_key="friday"){
                                 $startDate = Carbon::parse($date_from)->next(Carbon::FRIDAY); // Get the first friday.
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
                   // print_r(count($holiday_)); exit;

                    $exception_holiday=count(ExceptionHolidays::whereDate('created_at','>=',$date_from)->whereDate('created_at','<=',$date_to)->where('company_id',$company->id)->get());
                    
                    $monthly[$employee->id]['fixed_holiday']= count($holiday_);
                    $monthly[$employee->id]['exception_holiday']= $exception_holiday;
                    if($type=="not_ajax"){
                         $monthly[$employee->id]['absent']= Carbon::now()->daysInMonth- $monthly[$employee->id]['present']-$exception_holiday-count($holiday_);
                    }   
                    else{
                                           // $days = CarbonPeriod::create($date_from, $date_to);
                         $start_date =Carbon::parse($date_from);
                         $end_date =Carbon::parse($date_to);
                         $days = $start_date->diffInDays($end_date); 
                        // echo  $days;exit;
                        $monthly[$employee->id]['absent']=($days+1)- $monthly[$employee->id]['present']-$exception_holiday-count($holiday_);
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
        if($type!="ajax")
        {
                return view('reports.monthly_report')->with(compact('monthly','type','departments','branchs','employees'));  
        }
        else
        {
                return view('reports.month_ajax')->with(compact('monthly','type','departments','branchs','employees'));
        }
      
            
            
        }
        
       
       
       }
         
      
        
        
  function sum_the_time($time1, $time2) 
  {
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
       
    
 
  


