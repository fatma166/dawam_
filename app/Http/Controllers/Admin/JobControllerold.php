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
use Illuminate\Validation\Rule;

use App\Http\Controllers\Admin\JobController;
use App\Models\Job;
use App\Models\Department;
use App\Models\Branch;

use App\Models\evaluation_elements_jobs;
use App\Models\employee_evaluation;
class JobController  extends BaseController
{

  
    //for job evaluation
    public function index()
    {
      
        $company_check = $this->company;
        $companies = array();

    




        $jobs_id = evaluation_elements_jobs::get('job_id');
       //return $jobs_id;
        $evaluation= evaluation_element::where('company_id', $company_check->
            id)->get();


        $jobs= Job::WhereNotIn('id', $jobs_id)->where('company_id', $company_check->
            id)->get();
     
            $jobs_evaluations = Job::select('jobs.*','evaluation_elements_jobs.element_degree')
            ->leftjoin('evaluation_elements_jobs','evaluation_elements_jobs.job_id','=','jobs.id')
            ->where('jobs.company_id', $company_check->id)->get();
         
          
    //return $jobs_evaluations;
        $evaluation_keies = [];
        //  return $jobs_evalu[1]->element_degree;
        
        foreach ($jobs_evaluations as $key)
        {
            $result['element'] = json_decode($key->element_degree);
           //return $result;
          $evaluation_keies[$key->id]['id']= $key->id;
          $job_degree=0;
         $evaluation_keies[$key->id]["row"]="";
      
       if(!is_null($result['element']))
       {
             foreach($result['element'] as $index => $data)
            {
                
               // $jobtitle=Job::find($key->job_id)->first('title');
                 $key2 = evaluation_element::find($index);
               // return $key2;
                 $evaluation_keies[$key->id]["row"] .= ' '.$key2->title  . ' : ' . $data;
                //return $evaluation_keies[$key->id];
                 $job_degree += $data;
                 $evaluation_keies[$key->id]['totaldegree']= $job_degree;
                 $evaluation_keies[$key->id]['jobname']= $key->title;
                 $evaluation_keies[$key->id]['target_location']= $key->target_location_check;        
            }
            
         }
        else{
              $evaluation_keies[$key->id]['totaldegree']= 0;
             $evaluation_keies[$key->id]['jobname']= $key->title;
             $evaluation_keies[$key->id]['target_location']= $key->target_location_check;
            // $evaluation_keies[$key->id]['jobname']= $key->title;
        }
        
      
    
        }
     
      
      return view('jobs.job-list',compact('evaluation','jobs','evaluation_keies'));
    }


    public function store(Request $request)
    {
        
    $company = $this->company;
    //return response($request);
      $validator = Validator::make($request->all(),
        [
        
                'title' => ['required',
                            Rule::unique('jobs')
                              ->where('company_id', $company->id)
                           ],
        ]);
 
        if ($validator->passes())
        {

           /**   save in database  */
            $evalelem = $request->All();
          
        

          $input=array('title'=>$evalelem['title'] ,'target_location_check'=>$evalelem['target_location_check'],'company_id'=> $company->id);

          $job=job::create($input);
    
         //get last id add in job table 
          $job_id=job::latest()->first('id');
     
        //get not empty degree only
    if(isset($evalelem['degree']))
    {
        $degree = array();
        foreach ($evalelem['degree'] as $key => $degre)
         {

            if (!empty($degre))
                $degree[$key] = $degre;
         }

        //  print_r($degree);die;
        $evaluation_jobelement = array(
            'job_id' =>$job_id['id'],

            'element_degree' => json_encode($degree),
            'company_id' => $company->id);
        
        $evaluation_jobstore = evaluation_elements_jobs::create($evaluation_jobelement);

    }
        
        // if (!is_null($evaluation_jobstore))
        // {

            toastr()->success(trans('trans.data_add_successfly'));
            return response()->json(['success'=>'Added new records.']);
        // }
    
      }
        else
        {
           
            return response()->json(['error'=>$validator->errors()->all()]);
           
           // return back()->with('error', 'messages.error');
        }
       

    }


    public function edit_evaluation($id)
    {
        //print_r('fffff');die;
        $company_check = $this->company;
        $data = evaluation_elements_jobs::where('job_id','=',$id)->where('company_id', $company_check->
            id)->first();
       // print_r($data);die;
        $jobeval = Job::where('id', $id)->where('company_id', $company_check->
            id)->first();

        return response()->json(['jobevalution' => $data, 'jobs' => $jobeval]);

    }

    public function update(Request $request, $id)
    {
        
        $company_check= $this->company;
        $jobid=$request['jobEval_id'];
       
        $req=Validator::make($request->all(),[
            'title'=> ['required',
               Rule::unique('jobs')->where(function ($query) use($company_check,$jobid)
              {
                        return $query->where('company_id', $company_check->id)->where('id','!=',$jobid);
               }),
            ],
        ]);
      
if ($req->passes())
        {
        
      
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
//update in jobstable
       Job::where('id',$evalelem2['jobEval_id'])->update(['title'=>$evalelem2['title'],'target_location_check'=>$evalelem2['target_location_check']]);
    //deleted old evaluation_elements_jobs
       evaluation_elements_jobs::where('job_id',$evalelem2['jobEval_id'])->delete();
       
        $evaluation_jobstore = evaluation_elements_jobs::create($evaluation_jobelement1);


        if (!is_null($evaluation_jobstore))
        {
            //return back()->with('success', ' updated successfully.');
            toastr()->success(trans('trans.data_edit_successfly'));
            return response()->json(['success'=>'Added new records.']);
        }
        // else return with error message
       

    }
    else
    {
        return response()->json(['error'=>$req->errors()->all()]);
        //return back()->with('error', 'messages.error');
    }
    }


    public function delete(Request $request)
    {

        evaluation_elements_jobs::where('id', $request->id)->delete();
        toastr()->error(trans('trans.data_delete_successfly'));
    }

 

    

    public function getemployejob_id($id)
    {

        $user = User::find($id);

        //  return response()->json($users);
        //$evaluation1= evaluation_element::where('company_id',$company_check->id)->get();

        $evaluationjob = evaluation_elements_jobs::where('job_id', $user->job_id)->
            first();
        // return response()-> json($evaluationjob);
        
       
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

  
  


  


   
   

}
