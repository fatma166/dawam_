<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Company;
use App\Models\User;
use Validator;
use Carbon\Carbon;
use App\Models\Notifications_log;
use App\DataTables\TaskDataTable;
class TaskController extends BaseController
{
    
   function task_datatable($subdomain,TaskDataTable $dataTable){
        $manger_branch_id= $this->branch_id;
        $manger_department_id= $this->department_id;
        
        $company=$this->company;
        $users=User::where('company_id',$company->id)
                    ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query->where('users.department_id',$manger_department_id);
                                       
                    })
                    ->where('users.active',1)
                   ->where('users.bassma',1)
                    ->where('users.id', '!=' , Auth::user()->id)
                   ->where('users.id', '!=' , Auth::user()->id)->get();
     
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
        return $dataTable->render('tasks.taskdatatable',array('users'=>$users,'departments'=>$departments,'branchs'=>$branchs,'subdomain'=>$subdomain));
    
        
    }
    //
    function index($subdomain,Request $request){
 
        $manger_branch_id= $this->branch_id;
        $manger_department_id= $this->department_id;
        
        $company=$this->company;
        $users=User::where('company_id',$company->id)
                    ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query->where('users.department_id',$manger_department_id);
                                       
                    })
                   ->where('users.id', '!=' , Auth::user()->id)->get();

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
        if(isset($_GET['notify__id'])) $task=$_GET['notify__id'];else $task=null;
        
        $now = Carbon::now();
       
        $month=$now->month;
         if($this->roles['name']=="manger") {
          
          $manger_branch_id= Auth::user()->branch_id;
          $manger_department_id= Auth::user()->department_id;
        }else{
          $manger_branch_id=$manger_department_id='all'  ;
        }
        $search=$request->all();
      // print_r($search); exit;
   
        if(isset($search['employee_name'])&&$search['employee_name']!='null' )$employee_name=$search['employee_name']; else $employee_name='all';
        if(isset($search['date_from']))$date_from=$search['date_from'];else $date_from='all';
        if(isset($search['date_to']))$date_to=$search['date_to']; else $date_to='all';
        if(isset($search['status']))$status=$search['status']; else $status='all';
        if(isset( $search['department']))$department= $search['department'];else $department='all';
        if(isset( $search['branch'])) $branch= $search['branch'];else  $branch='all';
        
        $tasks=Task::select('tasks.*','users.name as username')
                   ->join('users','users.id', '=', 'tasks.user_id')
                   ->join('departments', 'departments.id', '=', 'users.department_id')
                    ->join('branches', 'branches.id', '=', 'users.branch_id')
                   ->where('tasks.company_id',$company->id)
                  /* ->Where(function($query) use ($task,$manger_branch_id,$manger_department_id) {
                               if($task!=null){
                                  $query->Where('tasks.id',$task);  
                               }
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query1->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query1->where('users.department_id',$manger_department_id);
                   })
                  

                   ->get();*/
                         ->Where(function($query1) use ($employee_name) {
                                if($employee_name!='all'){
                                    $query1->Where('users.id',$employee_name);
                                }
                            })
                              
                            ->Where(function($query) use ($status,$date_from,$date_to,$manger_branch_id,$manger_department_id,$department,$branch) {
                      
                                if($status!='all'){
                                    $query->where('tasks.status',$status);
                                }
                                if($date_from!='all'){
                                    $query->whereDate('tasks.created_at','>=',$date_from);
                                }
                                if($date_to!='all'){
                                     $query->whereDate('tasks.created_at','<=',$date_to);
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
                             ->orderBy('tasks.due_date','desc')   
                             ->paginate(15)
                             ->appends('search',$request->all());
        
        if($request->ajax())
        return view('tasks.search',['tasks'=>$tasks,'users'=>$users,'search'=>$search,'subdomain'=>$subdomain]);
        else

          return view('tasks.task_admin',['tasks'=>$tasks,'users'=>$users,'search'=>$search,'departments'=>$departments,'branchs'=>$branchs,'subdomain'=>$subdomain]);
  
    }
   
    /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
      public function store ($subdomain,Request $request)
      {
        $validator = Validator::make($request->all(), [
          'title' => 'required',
          'start_date' => 'required',
          'due_date' => 'required',
          'user_id' => 'required',
          
         ]);
   
   
        if ($validator->passes()) {
          $task_requests=$request->all();
          
          $company=$this->company;
          $task=Task::create(array('company_id'=>$company->id,'title'=>$task_requests['title'],'start_date'=>$task_requests['start_date'],'due_date'=>$task_requests['due_date'],'user_id'=>$task_requests['user_id'],'status'=>'delivered','description'=>$task_requests['description']))->get();
        
        
          if(!is_null($task)) {
            $notfy=array('title'=>'task added','message'=>" new task added",'company_id'=>$company->id,'notify_from'=>Auth::user()->id,'notify_to'=>$task_requests['user_id'],'data_id'=>$task[0]->id,'type'=>"add_task");
            Notifications_log::create($notfy); 
            return response()->json(array('success'=>'Added new records.'));
          }
       }else{
            return response()->json(['error'=>$validator->errors()->all()]);
      
       }

   
  
      }
    
      public function status($subdomain,Request $request){
       
         $shift= Shift::where('id',$request->id)->update(array('status'=>$request->status));
         if($shift>0){
          return response()->json(array('success'=> ' status changed successfully.'));
         }else{
          return response()->json(['error'=>$validator->errors()->all()]); 
         }

      }

    public function edit($subdomain,$id){
      $task=task::where('id',$id)->get();
     
      return response()->json($task);
    }
    public function update($subdomain,Request $request, $id){
      $validator = Validator::make($request->all(), [
        'title' => 'required',
        'start_date' => 'required',
        'due_date' => 'required',
        'user_id' => 'required',
       ]);
 
      if ($validator->passes()) {
        $company=$this->company;
        $task_requests=$request->all();
        $task=array('company_id'=>$company->id,'title'=>$task_requests['title'],'start_date'=>$task_requests['start_date'],'due_date'=>$task_requests['due_date'],'user_id'=>$task_requests['user_id'],'status'=>'delivered','description'=>$task_requests['description']);
        Task::where('id',$id)->update($task);
        return response()->json(['success'=>'Upadated new records.']);
      }else{
        return response()->json(['error'=>$validator->errors()->all()]);
      }

    }
    public function delete($subdomain, Request $request)
    {
        Task::where('id',$request->id)->delete();
        return back()->with('success', 'Delete successfully.');
       
    }


}
