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
class EvaluationController extends BaseController

{

    public function index()
    {
       
         $company_check=$this->company;
          //$company_check=Company::join('users','users.company_id','=','companies.id')->where(array('users.id'=>Auth::user()->id,'role_id'=>1))->first();
        
        $companies=array();
        $evaluation= evaluation_element::where('company_id', $company_check->id)->get();
       
        $jobs=Job::where('company_id',$company_check->id)->get();
        return view('evaluations.evaluation_list',compact('evaluation','jobs'));
       
      
    }



   
    public function store(Request $request)
        {
      
            
            $company_check= $this->company; 
           
           
             $req=Validator::make($request->all(),[
            /** abdelkawy validation title field in store  */
                'title'=>'required|unique:evaluation_elements',
                          
            ]);
            
            
            if ($req->passes()) {
          
                
            
               
            
               
               
               /**   save in database  */
                $input=array('title'=>$request->title,'company_id'=> $company_check->id);
                $evaluation=evaluation_element::create($input);
                if(!is_null($evaluation))
                 {
                             return response()->json(['success'=> 'Added successfully.']);
                }
              
            }
            else
            {
                     return response()->json(['error'=>$req->errors()->all()]);
            }
        
        } 
            
           
         

    
    
    
    public function edit($id)
    {
              
        
         $company_check=$this->company;
         
         $evaluation=evaluation_element::where('id',$id)->first();
           return response()->json($evaluation);
         
    }
    
    public function update(Request $request, $id)
    {
    
      $req=Validator::make($request->all(),[
            /** abdelkawy validation title field in store  */
                'title'=>'required|unique:evaluation_elements,title,'.$id,
                          
            ]);
           
          
        if ($req->passes())
         {
            $evaluations=$request->all(); 
           
            $evaluation_update=array('title'=>$evaluations['title']);
            evaluation_element::where('id',$id)->update($evaluation_update);
            return response()->json(['success'=> ' updated successfully.']);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }
    public function delete(Request $request)
    {
        
        evaluation_element::where('id',$request->id)->delete();
        return back()->with('success', 'Delete successfully.');
    }
    
    
    //for job evaluation 
    public function evalutaionjob_index()
    {
       $company_check=$this->company;
       $companies=array();

       $jobs_id=evaluation_elements_jobs::get('job_id');
       
        $data['evaluation']= evaluation_element::where('company_id',$company_check->id)->get();
    
        $data['jobs']=Job::WhereNotIn('id',$jobs_id)->where('company_id',$company_check->id)->get();
        $data['jobs_evaluations']=evaluation_elements_jobs::where('company_id',$company_check->id)->get();
        return view('evaluations.job_evaluations',$data);
    }
    
    
      public function storeevaluationjobs(Request $request)
        {
          
        
        /**   $evalelem=$request->All();*/
         
          $evalelem=$request->All();
         
         // print_r($evalelem);die();
         $company=$this->company;
         $degree=array();
         foreach($evalelem['degree'] as $key =>$degre){
            
            if(!empty($degre))  $degree[$key]=$degre;
         }
       
         // print_r($degree);die;
          $evaluation_jobelement=array('job_id'=>$evalelem['job_evalutionsid'],
                                       
                                        'element_degree'=>json_encode($degree),
                                         'company_id'=>$company->id);
           
        //print_r($evaluation_jobelement);die;
        $evaluation_jobstore=evaluation_elements_jobs::create($evaluation_jobelement);
      
       
         if(!is_null($evaluation_jobstore)) {
              
             return back()->with('success', ' added successfully.');
         }
         // else return with error message
         else {
            
             return back()->with('error','messages.error');
         }
           
        
        } 
        
        
        
        public function edit_evaluation($id)
        {
             $company_check=$this->company;
             $data=evaluation_elements_jobs::where('id',$id)->where('company_id',$company_check->id)->first();
             $jobeval=Job::where('id',$data->job_id)->where('company_id',$company_check->id)->first('title');
            
              return response()->json(['jobevalution'=>$data,'jobtitle'=>$jobeval]);
             
        }
        
        public function update_evaluationjob(Request $request,$id)
        {
           
           
          //print_r($id);die;
          
           $company_check=$this->company;
           $evalelem2=$request->All();
          // return $evalelem2;
          if(!is_null($evalelem2))
          {
            evaluation_elements_jobs::where('id',$id)->where('company_id',$company_check->id)->delete();
          }
           
           //save
             $degree=array();
             foreach($evalelem2['degree'] as $key =>$degre){
                
                if(!empty($degre))  $degree[$key]=$degre;
             }
             
            // print_r($degree);die;
            
              $evaluation_jobelement1=array('job_id'=>$evalelem2['jobEval_id'],
                                           'element_degree'=>json_encode($degree),
                                           'company_id'=>$company_check->id);
 
              $evaluation_jobstore=evaluation_elements_jobs::create($evaluation_jobelement1);
      
       
         if(!is_null($evaluation_jobstore))
          {
               return back()->with('success', ' updated successfully.');
          }
         // else return with error message
         else 
         {
            
             return back()->with('error','messages.error');
         }
            
            
        }
        
        
        public function delete_evalutionjob(Request $request)
        {
           
              evaluation_elements_jobs::where('id',$request->id)->delete();
              return back()->with('success', 'Delete successfully.');
        }
        
        
        public function evaluationemployes_index()
        {
          
         $company_check=$this->company;
           
        $branchs=Branch::where('company_id', $company_check->id)->get();
        $departments=Department::where('company_id', $company_check->id)->get();
        $employees=User::select('users.*','departments.title as dep_title','branches.title as branch_title')->where('users.company_id',$company_check->id)
                  ->join('departments', 'departments.id', '=', 'users.department_id')
                  ->join('branches', 'branches.id', '=', 'users.branch_id')
                  ->where('users.id', '!=' , Auth::user()->id)->get();
         
         //$user=User::where('company_id',$company_check->id)->where('role_id',"!=",1);
         $users=User::select("users.company_id as cm_id","users.name as user_name","users.id as user_id","branches.title as branch_name",
                             'jobs.title as job_name')
          ->join("branches","users.branch_id","=","branches.id")
          ->Join("jobs","users.job_id","=","jobs.id")->
          where('users.company_id',$company_check->id)->where('users.role_id',"!=",1)->get();
        // return $users;
              
        
        
              
      /* $users=User::where('company_id',$company_check->id)->where('role_id',"!=",1)->get();
        //return $users;*/
       $evalarray=[];
       
        foreach($users as $user)
        {
         
            $data=employee_evaluation::where('user_id',$user->user_id)->where('month',date('m'))->first();
              
            if($data)
            {
              
                $result['user_id']=$user->user_id;
                $result['user_name']=$user->user_name;
                $result['company_id']=$user->cm_id;
                $result['job']=$user->job_name;
                $result['branch']=$user->branch_name;
                $result['month']=$data->month;
                $result['year']=$data->year;
                $result['element_degree']=$data->element_degree;
                $result['total_degree']=$data->total_degree;
                $result['evalution_jobs_id']=$data->evalution_jobs_id;
               
              
                //$result['user_name']=$data->name;
            }
            else
            {
                $result['user_id']=$user->user_id;
                $result['user_name']=$user->user_name;
                $result['company_id ']=$user->cm_id;
                $result['job']=$user->job_name;
                $result['branch']=$user->branch_name;
                $result['month']=date("m");
                $result['year']=date("Y");
                $result['element_degree']="";
                $result['total_degree']="";
                $result['evalution_jobs_id']="";
            }
       
             array_push($evalarray,$result);
        }
        
          
          
        //  return $evalarray;
          
          
      //   $data_evaluation=employee_evaluation::employeesEvaluations($company_check->id);      
        // return $data_evaluation;
       // return view('evaluations.employes_evaluations',compact('data_evaluation','branchs','departments','employees'));
     
          
          
             
             
             
                 
            return view('evaluations.employes_evaluations',compact('evalarray','branchs','departments','employees'));
    
         
                

        
        
        }
        
        
    public function getemployejob_id($id)
    {    
           
            $user=User::find($id); 
            
         //  return response()->json($users);
            //$evaluation1= evaluation_element::where('company_id',$company_check->id)->get();
            
            $evaluationjob=evaluation_elements_jobs::where('job_id',$user->job_id)->first();
            // return response()-> json($evaluationjob);
             $evaljob_id=$evaluationjob->id;              
             $items= json_decode($evaluationjob["element_degree"]);
            // $items= json_decode($evaluationjob->element_degree);
           
             $evaluation_keies=[];
            
            foreach($items as $index=>$item)
            {
                
               $key=evaluation_element::find($index);
                    $reuslt["id"]=$key->id;
                    $reuslt["title"]=$key->title;
                    $reuslt["degree"]=$item; 
                    $reuslt["evaljob_id"]=$evaljob_id;
               array_push($evaluation_keies,$reuslt);
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
             return view("evaluations.evaluation_table",compact('evaluation_keies','user'));
          
            
            
    }    
        
       public function store_employeevaluation(Request $request)
    {
      
     //  return $request;
        $result=[];
        $total_degree=0;
        foreach($request->degree as $total)
        
        {
            $total_degree +=$total;
            $result['total_degree']=$total_degree;
        }
        
        $from_degree=0;
        foreach($request->basic_degree as $degree)
        
        {
            $from_degree +=$degree;
            $result['from_degree']=$from_degree;
        }
        
        return $result;
       
        //get total jobdegree
     /*   $evaluationjob=evaluation_elements_jobs::where('id',$request->evaljob_id)->first();
                      
             $items= json_decode($evaluationjob["element_degree"]);
                       
             
            $job_degree=0;
            foreach($items as $item)
            {
               $job_degree +=$item;
            }
            $evaluation_keies=[$total_degree,$job_degree];
            return $evaluation_keies;
        //return $total_degree; */
        
         $company_check=$this->company;
         $evaluation_employe=array('user_id'=>$request->user_id,
                                    'month'=>$request->month,  
                                    'year'=>date("Y"),
                                    'evalution_jobs_id'=>$request->evaljob_id,
                                    'element_degree'=>json_encode($request->degree),
                                    'total_degree'=>$total_degree,
                                    'company_id'=>$company_check->id,
                                    );
           
        //print_r($evaluation_jobelement);die;
        $evaluation_emlpyestore=employee_evaluation::create($evaluation_employe);
    
         if(!is_null($evaluation_employe)) {
              
             return back()->with('success', ' added successfully.');
         }
         // else return with error message
         else {
            
             return back()->with('error','messages.error');
         }
        
        
        
        
    }
        
        
       public function evaluationemp_edit($id) 
       {
           $company_check=$this->company;
           $evaluationemploye=employee_evaluation::where('user_id',$id)->where('month',date("m"))
                              ->where('company_id',$company_check->id)->first();
         // return $evaluationemploye;
        
        
           
            // $items= json_decode($evaluationjob->element_degree);
           
          
           
         //  get jobevaluation dgree
           $elements=[];
           $evaluation_elements_jobs=evaluation_elements_jobs::find($evaluationemploye->evalution_jobs_id);
           foreach(json_decode($evaluation_elements_jobs->element_degree)  as $index=>$item )
           {
            $em["key"]=$index;
            $em["job_degree"]=$item;
            array_push($elements,$em);
            
           }
           
       //  return $elements;
           
           //get employe dgree
           
           $evaluation_keies=[];
           $items= json_decode($evaluationemploye["element_degree"]);
          
            foreach($items as $index=>$item)
            {
                $reuslt=[];
               $key=evaluation_element::find($index);
           
                
                    $reuslt["elment_id"]=$key->id;
                    $reuslt["eleme_title"]=$key->title;
                    
                    $reuslt["emp_degree"]=$item; 
             //get dgree of jobevalaution
            
             
             //for get jobeavalutindegree with the same employe dgree
               foreach($elements as $a=>$value){
               // $value hass key and dgree
                if($value["key"]==$reuslt["elment_id"]){
                     $reuslt=array_merge($value,$reuslt);
                     break;
                }
             }
          
            //  $reuslt["evaljob_id"]=$evaljob_id;
               array_push($evaluation_keies,$reuslt);
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
            return view('evaluations.edit_employeevaluation',compact('evaluation_keies','evaluationemploye'));
            return response()-> json($evaluation_keies);
       }
       
       
       
       public function update_empevaluation(Request $request,$id)
       {
         
         
        // return $request;
         $eval_emp=employee_evaluation::where('user_id',$id)->where('month',$request->month)->delete();
        
         $total_degree=0;
         foreach($request->degree as $value)
         {
            $total_degree +=$value;
         }
         
        // return $total_degree;
         $company_check=$this->company;
         $evaluation_employe=array(
           'user_id'=>$request->user_id,
           'month'=>$request->month,
           'year'=>$request->year,
           'evalution_jobs_id'=>$request->jobevaluation_id,
           'element_degree'=>json_encode($request->degree),
           'total_degree'=>$total_degree,
            'company_id'=>$company_check->id,
         );
         
        
        $evaluation_empstore=employee_evaluation::create($evaluation_employe);
         if(!is_null($evaluation_empstore))
          {
              
             return back()->with('success', ' added successfully.');
         }
         // else return with error message
         else {
            
             return back()->with('error','messages.error');
         }
    
       
          
       }
       
       
       public function delete_empevaluation(Request $request)
       {
        
          employee_evaluation::find($request->id)->delete();
       }
        
   
    
    
   

}
