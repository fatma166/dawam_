<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Role;
use App\Models\Department;
use App\Models\Company;
use App\Models\Job;
use App\Models\Shift;
use App\Models\Track_user;
use App\Models\Client;
use App\Models\Outdoor;
use App\Models\Task;
use App\Models\Leave_request;
use App\Models\Leave_type;
use App\Models\Attendance;
use App\Models\evaluation_elements_jobs;
use App\Models\evaluation_element;
use App\Models\employee_evaluation;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
class EmployeeController extends BaseController
{
/**
 *     public function __construct()
 *     {
 *          $class = 'users';
 *         parent::__construct($class);
 *     }
 */

    public function index($subdomain){
       $company_check=$this->company;
       $manger_branch_id= $this->branch_id;
       $manger_department_id= $this->department_id;
       $users= User::leftjoin('branches','branches.id','=','branch_id')->join('jobs','jobs.id','=','users.job_id')
                   ->select('users.*','branches.id as branch_id','branches.title as branch_title','jobs.id as job_id','jobs.title as job_title')
                   ->where('users.id', '!=' , Auth::user()->id)->where('users.company_id',$company_check->id)
                                     
                   ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query->where('users.department_id',$manger_department_id);
                                       
                    })
                    ->orderBy('created_at','desc')
                   ->get(); 
  
       $branchs=Branch::where('company_id', $company_check->id)->get();
       $jobs=Job::where('company_id',$company_check->id)->get();
       $roles_=Role::where('company_id',$company_check->id)->where('id','>=',$this->roles['id'])->get();
       //  print_r($roles);
       $shifts=Shift::where('company_id',$company_check->id)->get();
       $departments=Department::where('company_id', $company_check->id)->get();
        return view('employee.employees-list',array('users'=>$users,'branchs'=>$branchs,'roles_'=>$roles_,'departments'=>$departments,'jobs'=>$jobs,'shifts'=>$shifts,'subdomain'=>$subdomain));
    }
   public function profile($subdomain,REQUEST $request,$id){
        $company_check=$this->company;
        $manger_branch_id= $this->branch_id;
        $manger_department_id= $this->department_id;
        $date1= Carbon::now();
      
        $employee=User::SELECT('branch_id','name','job_id')->where('id',$id)->first();
        $month=($date1->month);

        $year= $date1->year;
        $users= User::join('branches','branches.id','=','branch_id')->join('jobs','jobs.id','=','users.job_id')
                   ->select('users.*','branches.id as branch_id','branches.title as branch_title','jobs.id as job_id','jobs.title as job_title')
                   ->where('users.id', '!=' , Auth::user()->id)->where('users.company_id',$company_check->id)
                                     
                   ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query->where('users.department_id',$manger_department_id);
                                       
                    })
                   ->get(); 
  
       $branchs=Branch::where('company_id', $company_check->id)->get();
       $jobs=Job::where('company_id',$company_check->id)->get();
       $roles_=Role::where('company_id',$company_check->id)->where('id','>=',$this->roles['id'])->get();
    //  print_r($roles);
       $shifts=Shift::where('company_id',$company_check->id)->get();
       $departments=Department::where('company_id', $company_check->id)->get();
       $tracks=array();
       $from=Carbon::now();
       $counts=array();  
       $counts['tasks_count']=task::where('tasks.company_id',$company_check->id)
                       ->where('tasks.user_id',$id)
                       ->count();

       $counts['attend_count']=Attendance::where('attendances.company_id',$company_check->id)
                               ->where('attendances.user_id',$id)
                                ->whereMonth('attendances.created_at', '=', $month) 
                                ->whereYear('attendances.created_at', '=', $year) 
                                ->distinct(DB::raw('DATE(created_at)'))
                               ->count();
       $counts['outdoors_count']= Outdoor::where('outdoors.company_id',$company_check->id)
                                ->where('outdoors.user_id',$id)
                                ->where('outdoors.status','done')
                                ->whereMonth('outdoors.date', '=', $month) 
                                ->whereYear('outdoors.date', '=', $year) 
                                ->count();
                              
       $counts['leaves_count']= Leave_request::where('leave_requests.company_id',$company_check->id)
                                ->where('leave_requests.user_id',$id)
                                ->where('leave_requests.status','accepted')
                                ->whereYear('leave_requests.created_at', '=', $year) 
                                ->count();
       $counts['leavestype_count']= Leave_type::where('leave_types.company_id',$company_check->id)
                               
                                ->where('leave_types.status','active')
                                
                                ->count();
     $evaluation=array();
    
     $job_eval_elments=evaluation_elements_jobs::where('job_id',$employee['job_id'])->first();
     $evalu_statics=employee_evaluation::where('user_id',$id)
                        ->where('month', '=', $month) 
                        ->where('year', '=', $year)->first();
     if(!empty($evalu_statics))
     $evalu_statics_decode=json_decode($evalu_statics['element_degree']);
     
    // print_r(json_decode($job_eval_elments['element_degree'])); exit;
    if(!empty($job_eval_elments)){
     foreach( json_decode($job_eval_elments['element_degree']) as $element_id=> $element_degree){
        
          $evaluation[$element_id]['degree'] = $element_degree;
             
          $element_data=evaluation_element::where('id',$element_id)->first();
          
          if($element_data['status']==1){
             $evaluation[$element_id]['title']=$element_data['title'];
              if($element_data['title']=="??????"){
                   $attend=Attendance::where('attendances.company_id',$company_check->id)
                                       ->where('attendances.user_id',$id)
                                        ->whereMonth('attendances.created_at', '=', $month) 
                                        ->whereYear('attendances.created_at', '=', $year) 
                                        ->distinct(DB::raw('DATE(created_at)'))
                                       ->count();
                  $evaluation[$element_id]['actual']=($attend*$element_degree)/(Carbon::today()->day);
                  
              }elseif($element_data['title']=="????????"&&$element_data['status']==1){
                 $evaluation[$element_id]['actual']=($counts['outdoors_count']*$element_degree)/(Carbon::today()->day);
                
                
              }elseif($element_data['title']=="??????"&&$element_data['status']==1){
                 $evaluation[$element_id]['actual']=($counts['tasks_count']*$element_degree)/(Carbon::today()->day);
               
                
              
              }elseif($element_data['title']=="????????"&&$element_data['status']==1){
                 $evaluation[$element_id]['actual']=($counts['tasks_count']*$element_degree)/(Carbon::today()->day);
                
                
              }
         }else{
         
                if(!empty($evalu_statics)){
               if(isset($evalu_statics_decode->$element_id)){
                   $evaluation[$element_id]['degree']=$element_degree;
                   
                   $evaluation[$element_id]['actual']=$evalu_statics_decode->$element_id;
                    $evaluation[$element_id]['title']=$element_data['title'];
                }
                }
    
            
          }
          
     }
    }
     // print_r($evaluation)  ;    exit;                    
      // $total=User::select(DB::raw('COUNT(users.id) as total'))->where('users.company_id',$company->id)->where('users.id', '!=' , Auth::user()->id)->first();

       // if(($employee_name!='all')||( $from!='all')||($status!='all')||( $client!='all')){
            $tracks=Track_user::select('track_users.*','users.name')
                            ->join('users','users.id', '=', 'track_users.user_id')
                            
                           
        
                            ->Where(function($query) use ($id,$from,$manger_branch_id,$manger_department_id) {
                                if($id!='all'){
                                    $query->Where('track_users.user_id',$id);
                                }
                                if($from!='all')
                                    $query->whereDate('track_users.date','=',$from);
                                    
                                               
                                if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                    $query->where('users.branch_id',$manger_branch_id);
                                if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                    $query->Where('users.department_id',$manger_department_id);
                                       
                  
                             })
                             ->orderBy('track_users.date','desc')   
                             ->get()->toArray();
     
       //return   $users;
        return view('employee.profile',array('employee_id'=>$id,'evaluation'=>$evaluation,'employee'=>$employee,'counts'=>$counts,'tracks'=>$tracks,'users'=>$users,'branchs'=>$branchs,'roles_'=>$roles_,'departments'=>$departments,'jobs'=>$jobs,'shifts'=>$shifts,'subdomain'=>$subdomain));
    } 
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($subdomain,REQUEST $request)
    {
        $id=$request->id;
      
        $user=User::where('id', $id)->first();
        $user['password'];
        return response()->json(['user'=>$user]);
        

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($subdomain,Request $request)
    {
         $company_check=$this->company;
         $req=Validator::make($request->all(),[

          //  'title'=>'required|unique:branches',
             'name'=>  Rule::unique('users')->where(function ($query) use($company_check) {
                        return $query->where('company_id', $company_check->id);
               }),
             'name'              =>      'required|unique:users',  
            'password'          =>      'required',
            'confirm_password'  =>      'required|same:password',
            'joining_date'       =>     'required',
            'job_id'             =>      'required',
            'department'       =>        'required',
            'branch'             =>'required|nullable',
            //'email' => 'required_without:phone',
            'email' => 'required_without:phone|unique:users',
           // 'phone' => 'required_without:email|numeric|min:9|max:15|unique:users',
           'phone' => 'required_without:email|numeric',
           'phone' => 'min:9|max:15|unique:users',
           ]);
            
       
       //  print_r($request->all());
        
        if ($req->passes()) {
         
            //  exit; 
            // $request->validate([ 'title'=>'required']);
            
           
            if(isset($company_check->logo)){
                 $logo=$company_check->logo;
            }else{
                 $logo='img/logo.png';
            }
            
           // $role_id=$request->role_id?"Null":$request->role_id;
            
         
            $check_user=User::where('email',$request->email)->first();    
                if(empty($check_user)){
                    $input=array('name'=>$request->name,'email'=>$request->email,'password'=> bcrypt($request->password),'join_date'=>$request->joining_date,'phone'=>$request->phone
                                 ,'job_id'=>$request->job_id,'user_id'=>Auth::user()->id,'company_id'=>$company_check->id
                                 ,'shift_id'=>$request->shift_id,'logo'=>$logo);
                              //   print_r($input); exit;
                    $input['active']=$request->active?true:false;
                    $input['bassma']=$request->bassma?true:false;
                    /*if($request->department!="Null")
                    $input['department_id']=$request->department;
                        
                    if($request->branch!="Null")
                     $input['branch_id']=$request->branch;
                    else
                    $employee['branch_id']=null;*/
                                   
                     $employee['branch_id']=($request['branch']=="all")? null:$request['branch'];
               
                     $employee['department_id']=($request['department']=="all")? null:$request['department'];
                     if($request->role_id!="Null")
                      $input['role_id']=$request->role_id;
                     
                    
                    $employee=User::create($input);
                
                    if(!is_null($employee)) {
                        
                        return response()->json(['success'=> 'Added successfully.']);
                    }

                }
        }else{
            return response()->json(['error'=>$req->errors()->all()]);
        }
    }
    public function search($subdomain,Request $request){
       $name= $request->name;
       $phone=  $request->phone;
       $branch= $request->branch;
       if(isset($name)){
           

       }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($subdomain,Request $request, $id)
    {    
        if(!empty($request['password'])){
          
                 if(!empty($request['type'])){
                     $req=Validator::make($request->all(),[
                     'name'=>      'required|unique:users,name,'.$id,
                     'email' => 'required_without:phone',
                    //'phone' => 'required_without:email|numeric|max:15|min:9|unique:users,phone,'.$id,
                     'phone' => 'required_without:email|numeric',
                     'phone' => 'min:9|max:15|unique:users,phone,'.$id,
                     'password'          =>      'required',
                     'confirm_password'  =>      'required|same:password',
               
                  ]);
                }else{
                       $req=Validator::make($request->all(),[
                         'name'=>      'required|unique:users,name,'.$id,
                         'email' => 'required_without:phone',
                        //'phone' => 'required_without:email|numeric|max:15|min:9|unique:users,phone,'.$id,
                         'phone' => 'required_without:email|numeric',
                         'phone' => 'min:9|max:15|unique:users,phone,'.$id,
                        
                         'joining_date'       => 'required',
                         'job_id'             =>      'required',
                         'department'       => 'required',
                         'branch'             =>'required|nullable',
                         'password'          =>      'required',
                         'confirm_password'  =>      'required|same:password',
                   
                      ]);
                   }
            
        }else{
             
            if(!empty($request['type'])){
              
               $req=Validator::make($request->all(),[
                    'name'              =>      'required|unique:users,name,'.$id,
                    'email' => 'required_without:phone',
                    //'phone' => 'required_without:email|numeric|max:15|min:9|unique:users,phone,'.$id,
                     'phone' => 'required_without:email|numeric',
                     'phone' => 'min:9|max:15|unique:users,phone,'.$id,
                    
    
               
                ]);
            }else{
                    $req=Validator::make($request->all(),[
                        'name'              =>      'required|unique:users,name,'.$id,
                        'email' => 'required_without:phone',
                        //'phone' => 'required_without:email|numeric|max:15|min:9|unique:users,phone,'.$id,
                         'phone' => 'required_without:email|numeric',
                         'phone' => 'min:9|max:15|unique:users,phone,'.$id,
                        
                        'joining_date'       => 'required',
                        'job_id'             =>      'required',
                        'department'       => 'required',
                        'branch'             =>'required|nullable',
                   
                    ]);
             }
          }
        
        if ($req->passes()) {
        
            $employee['name']=$request['name'];
            $employee['email']=$request['email'];
             $employee['phone']=$request['phone'];
             if(empty($request['type'])){
                $employee['join_date']=$request['joining_date'];
                $employee['job_id']=$request['job_id'];
               
                $employee['branch_id']=($request['branch']=="all")? null:$request['branch'];
               
                $employee['department_id']=($request['department']=="all")? null:$request['department'];
                $employee['shift_id']=$request['shift_id'];
                if($request->role_id!="Null")
                $employee['role_id']=$request['role_id'];
                $employee['active']=$request->active?true:false;
                $employee['bassma']=$request->bassma?true:false;
            }
            if(!empty($request['password'])){
                $employee['password']=bcrypt($request['password']);
            }
            User::where('id',$id)->update($employee);
            //return redirect()->route('employee_index');
           // toastr()->success(trans('trans.data_edit_successfly'));
            return response()->json(['success'=> 'Added successfully.']);
        }else{
            return response()->json(['error'=>$req->errors()->all()]);
        }    
    }
    
      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($subdomain,Request $request)
    {
        User::where('id',$request->id)->delete();
       
    }
    
    public function status(Request $request,$subdomain)
    {
            $company = $this->company;
            //print_r($request->all()); exit;
            

            $employee=User::where('id',$request['id'])->update(array('active' =>$request['status']));
           
            // return back()->with('success', ' status changed successfully.');
            
       

    }
      public function bar_chart($subdomain,Request $request){

        $company=$this->company;
        $manger_branch_id= $this->branch_id;
    
        $date1= Carbon::now();
        $id=$request->id;
        $employee=User::SELECT('branch_id','name')->where('id',$id)->first();
        $month=($date1->month);

        $year= $date1->year;

        $clients=Client::select('clients.id','clients.name')          
                       ->where('clients.company_id', $company->id)
                       ->where('clients.branch_id', $employee['branch_id'])
                       ->get()->toArray();
        // print_r($clients); exit;
        $client_statistics=array();

        foreach($clients as $index=>$client){

            

           $client_statistics[$index]['client']=$client['name'];

           $client_statistics[$index]['outdoor_count']=Outdoor::where('outdoors.company_id',$company->id)
                                ->where('outdoors.user_id',$request->id)
                                ->where('outdoors.status','done')
                                ->where('outdoors.customer_id',$client['id'])
                                ->whereMonth('outdoors.date', '=', $month) 
                                ->whereYear('outdoors.date', '=', $year) 
                                ->count();
        }

       // $data=array(array('y'=> '2006', 'present'=> 50,'b'=> 90 ),array('y'=> '2007', 'present'=> 57,'b'=> 97 ),array('y'=> '2008', 'a'=> 58,'b'=> 98));

        return response()->json($client_statistics); 

    }

}
