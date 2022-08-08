<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave_request;
use App\Models\User_shift;
use App\Models\Company;
use App\Models\User;
use App\Models\Leave_type;
use App\Models\Custom_leave;
use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Notifications_log;
use App\Models\Branch;
use App\Models\Department;
use App\DataTables\LeaveDataTable;
class LeaveController extends BaseController
{
        public function __construct()
    {
         $class = 'leaves';
        parent::__construct($class);
    }
    function leave_datatable($subdomain,LeaveDataTable $dataTable){
       
        $company=$this->company; 
        $manger_branch_id= $this->branch_id;
        $manger_department_id= $this->department_id;
        $company=$this->company;
        $users=User::where('company_id',$company->id)
                       ->where('id','!=',Auth::user()->id)
                       ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query->where('users.department_id',$manger_department_id);
                              
                                       
                         })
                        ->where('users.active',1)
                        ->where('users.bassma',1)
                         ->get();
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
        $now = Carbon::now();
        $month=$now->month;
       
       // print_r($users); exit;
       
       
        $present=Attendance::select( DB::raw('COUNT(attendances.user_id) as present'))

                ->join('users', 'users.id', '=', 'attendances.user_id')
                 ->where(function($query) use ($manger_branch_id,$manger_department_id){
                                    if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                         $query->where('users.branch_id',$manger_branch_id);
                                   if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                         $query->where('users.department_id',$manger_department_id);
                                       
                               
                 })
                ->where('users.company_id',$company->id)
                ->where('attendances.status','!=','absent')
                ->whereDate('attendances.created_at', Carbon::today())
                ->where('users.id', '!=' , Auth::user()->id)
                ->count();
             
        $attend_today=$present;
        //Attendance::whereDate('created_at',Carbon::today())->count();
        $pending_today=Leave_request::whereDate('created_at',Carbon::today())
                                   ->where('status','pending')
                                   ->where('leave_requests.company_id',$company->id)->count();
                                   
        $types=Leave_type::where('company_id',$company->id)->get();  
        $search=$_GET;                         
        return $dataTable->render('leave.leavedatatable',array('users'=>$users,'departments'=>$departments,'branchs'=>$branchs,'types'=>$types,'attend_today'=> $attend_today,'pending_today'=>$pending_today,'search'=> $search,'subdomain'=>$subdomain));
        
            
        }
   public function index($subdomain,Request $request){
    
        $company=$this->company; 
        $manger_branch_id= $this->branch_id;
        $manger_department_id= $this->department_id;

        $search=$request->all();
       
        $manger_branch_id= $this->branch_id;
        $manger_department_id= $this->department_id;
        if(isset($search['employee_name']))$employee_name=$search['employee_name'];else $employee_name='all';
        if(isset($search['leave_type']))$leave_type=$search['leave_type']; else $leave_type='all';
        if(isset($search['status']))$status=$search['status']; else $status='all';
        if(isset($search['from']))$from=$search['from'];else $from='all';
        if(isset($search['to']))$to=$search['to']; else $to='all';
        if(isset( $search['department']))$department= $search['department'];else $department='all';
        if(isset( $search['branch'])) $branch= $search['branch'];else  $branch='all';
        if($employee_name=='null'){$employee_name='all';}
        $company=$this->company;
        $users=User::where('company_id',$company->id)
                       ->where('id','!=',Auth::user()->id)
                       ->Where(function($query) use ($manger_branch_id,$manger_department_id,$employee_name){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query->where('users.department_id',$manger_department_id);
                               if($employee_name!='all')
                                      $query->where('id',$employee_name);
                                       
                         })
                          ->where('users.active',1)
                       
                          ->where('users.bassma',1)->get();
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
        $now = Carbon::now();
        $month=$now->month;
        $leave=array();
       // print_r($users); exit;
       
       
        $present=Attendance::select( DB::raw('COUNT(attendances.user_id) as present'))

                ->join('users', 'users.id', '=', 'attendances.user_id')
                 ->where(function($query) use ($manger_branch_id,$manger_department_id){
                                    if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                         $query->where('users.branch_id',$manger_branch_id);
                                   if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                         $query->where('users.department_id',$manger_department_id);
                                       
                               
                 })
                ->where('users.company_id',$company->id)
                ->where('attendances.status','!=','absent')
                ->whereDate('attendances.created_at', Carbon::today())
                ->where('users.id', '!=' , Auth::user()->id)
                ->count();
             
       $attend_today=$present;
        //Attendance::whereDate('created_at',Carbon::today())->count();
        $pending_today=Leave_request::whereDate('created_at',Carbon::today())
                                   ->where('status','pending')
                                   ->where('leave_requests.company_id',$company->id)->count();
        
        //foreach($users as $user){
           
              
                $leave=Leave_request::select('users.*','users.name as user_name','leave_requests.id as leave_id','leave_requests.*','leave_types.name','leave_types.id as leave_type_id')
                                ->join('leave_types', 'leave_types.id', '=', 'leave_requests.leave_type_id')
                                ->join('users', 'users.id', '=', 'leave_requests.user_id')
                                ->join('departments', 'departments.id', '=', 'users.department_id')
                                ->join('branches', 'branches.id', '=', 'users.branch_id')
                                ->where(function($query) use ($manger_branch_id,$manger_department_id){
                                    if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                         $query->where('users.branch_id',$manger_branch_id);
                                   if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                         $query->where('users.department_id',$manger_department_id);
                                       
                               
                                })
                                 ->where('leave_requests.company_id',$company->id)
                                ->Where(function($query) use ($leave_type,$status,$to,$from,$employee_name,$department,$branch) {
                                    
                                    if($leave_type!='all')
                                        $query->where('leave_type_id',$leave_type);
                                    if($status!='all'){
                                        $query->where('leave_requests.status',$status);
                                    }
                                    if($to!='all'){
                                         $query->where('leave_to','<=' ,$to);
                                    }
                                    if($from!='all')
                                         $query->where('leave_from','>=', $from);
                                    if($employee_name!='all')
                                          $query->Where('leave_requests.user_id',$employee_name);
                                     if($department!='all')
                                        $query->where('users.department_id',$department);
                                     if($branch!='all')
                                        $query->where('users.branch_id',$branch);
                                })
                                ->where('id','!=',Auth::user()->id)
                                ->where('users.active',1)
                       
                                ->where('users.bassma',1)
                                ->get();
                              
           
       // }
        $types=Leave_type::get();
       
        //return view('leave.search',array('leaves'=>$leave,'types'=>$types,'users'=>$users));
        if(!$request->ajax())
             return view('leave.index',array('leaves'=>$leave,'types'=>$types,'users'=>$users,'attend_today'=>$attend_today,'pending_today'=>$pending_today,'departments'=>$departments,'branchs'=>$branchs,'subdomain'=>$subdomain));
        else
                
             return view('leave.search',array('leaves'=>$leave,'types'=>$types,'users'=>$users,'subdomain'=>$subdomain));
        
/* $users=User::where('company_id',$company->id)
                    ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query1->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query1->where('users.department_id',$manger_department_id);
                                       
                    })
                   ->where('users.id', '!=' , Auth::user()->id)->get();
        if(isset($_GET['notify__id'])) $leave_notfy=$_GET['notify__id'];else $leave_notfy=null;
        $present=Attendance::select( DB::raw('COUNT(attendances.user_id) as present'))

                ->join('users', 'users.id', '=', 'attendances.user_id')
                ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                        if(isset($manger_branch_id))
                                             $query->where('users.branch_id',$manger_branch_id);
                                        if(isset($manger_department_id))
                                             $query->orWhere('users.department_id',$manger_department_id);
                                       
                    })
                ->where('users.company_id',$company->id)
                ->where('attendances.status','!=','absent')
                ->whereDate('attendances.created_at', Carbon::today())
                ->where('users.id', '!=' , Auth::user()->id)
                ->first();
             
       $attend_today=$present['present'];
        //Attendance::whereDate('created_at',Carbon::today())->count();
        $pending_today=Leave_request::whereDate('created_at',Carbon::today())->where('status','pending')->where('leave_requests.company_id',$company->id)->count();
        $now = Carbon::now();
        $month=$now->month;
        $leave=array();

        if($leave_notfy!=null){
            
             $leave=Leave_request::select('users.*','users.name as user_name','leave_requests.id as leave_id','leave_requests.*','leave_types.name','leave_types.id as leave_type_id')
                        ->join('leave_types', 'leave_types.id', '=', 'leave_requests.leave_type_id')
                        ->join('users', 'users.id', '=', 'leave_requests.user_id')
                        ->where('users.id', '!=' , Auth::user()->id)
                        ->where('leave_requests.company_id',$company->id)
                        ->Where(function($query2) use ($leave_notfy) {
                           if($leave_notfy!=null){
                              $query2->Where('leave_requests.id',$leave_notfy);  
                           }
                        })
                        ->get();
        }else{
           
                foreach($users as $user){
                     $leave=Leave_request::select('users.*','users.name as user_name','leave_requests.id as leave_id','leave_requests.*','leave_types.name','leave_types.id as leave_type_id')
                                            ->join('leave_types', 'leave_types.id', '=', 'leave_requests.leave_type_id')
                                            ->join('users', 'users.id', '=', 'leave_requests.user_id')
                                            ->where('users.id', '!=' , Auth::user()->id)
                                            ->where('leave_requests.company_id',$company->id)
                 
                                            ->get();
                  }
            
        }
        $types=Leave_type::get();
       
        return view('leave.index',array('leaves'=>$leave,'types'=>$types,'users'=>$users,'attend_today'=>$attend_today,'pending_today'=>$pending_today));
   */
    }
    /**
     * check exist of request in this date
     */

    public function checkExistRequestBefore($user_id,$from,$to){
        
      return(Leave_request::where('user_id',$user_id)->where('leave_from','>=',$from)->where('leave_to','<=',$to)->get()->toArray());
        
    }
    public function store(Request $request,$subdomain){
        $validator = Validator::make($request->all(), [
            'leave_from' => 'required',
            'leave_to' => 'required',
            'type' => 'required',
            'days' => 'required',
            'leave_reson' => 'required',
            'user_id' => 'required',

        ]);
     
        if ($validator->passes()) {
            $leave_requests=$request->all(); 
            $check_exist=$this->checkExistRequestBefore($leave_requests['user_id'],$leave_requests['leave_from'],$leave_requests['leave_to']);
             if(!empty($check_exist))
            return response()->json(['error'=>array(__('trans.get same day before in this duration'))]);
            
            
            $company=$this->company;
            $leave=Leave_request::create(array('company_id'=>$company->id,'leave_from'=> $leave_requests['leave_from'],'leave_to'=> $leave_requests['leave_to'],'leave_type_id'=>$leave_requests['type'],'days'=>$leave_requests['days'],'leave_reson'=>$leave_requests['leave_reson'],'user_id'=>$leave_requests['user_id'],'status'=>'accepted'))->get();
        
        
            if(!is_null($leave)) {
              //  toastr()->success(trans('trans.data_add_successfly'));
                return response()->json(['success'=>'Added new records.']);
            }
        }else{
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }


    public function edit($id,$subdomain){
        $leave_request=Leave_request::where('id',$id)->first();
      
        return response()->json($leave_request);
    }
    public function update(Request $request,$subdomain){
        $validator = Validator::make($request->all(), [
            'leave_from' => 'required',
            'leave_to' => 'required',
            'type' => 'required',
            'days' => 'required',
            'leave_reson' => 'required',
            'user_id' => 'required',

        ]);
     
        if ($validator->passes()) {
            $company=$this->company;
            $outdoor=$request->all();
            $Leave_request=array('company_id'=>$company->id,'leave_from'=> $leave_requests['leave_from'],'leave_to'=> $leave_requests['leave_to'],'type'=> $leave_requests['type'],'days'=>$leave_requests['days'],'leave_reson'=>$leave_requests['leave_reson']);
        
            Leave_request::where('id',$id)->update( $Leave_request);
            toastr()->success(trans('trans.data_edit_successfly'));
          //  return response()->json(['success'=>'Added new records.']);
        }else{
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }

   /* public function leave_search(Request $request){
        $search=$request->all();
       
        $manger_branch_id= $this->branch_id;
        $manger_department_id= $this->department_id;
        $employee_name=$search['employee_name']?$search['employee_name']:'all';
        $leave_type=$search['leave_type']?$search['leave_type']:'all';
        $status=$search['status']?$search['status']:'all';
        $from=$search['from']?$search['from']:'all';
        $to=$search['to']?$search['to']:'all';
        
        $company=$this->company;
       // if(!empty($employee_name)){
           
            $users=User::where('company_id',$company->id)
                       ->Where(function($query) use ($manger_branch_id,$manger_department_id,$employee_name){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query->where('users.department_id',$manger_department_id);
                               if($employee_name!='all')
                                      $query->where('id',$employee_name);
                                       
                         })->get();
        /*}else{
            
            $users=User::where('company_id',$company->id)
                        ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query->where('users.department_id',$manger_department_id);
                                       
                    })->get();
        }*/
       /* $now = Carbon::now();
        $month=$now->month;
        $leave=array();
       // print_r($users); exit;
        foreach($users as $user){
           
              
                $leave=Leave_request::select('users.*','users.name as user_name','leave_requests.id as leave_id','leave_requests.*','leave_types.name','leave_types.id as leave_type_id')
                                ->join('leave_types', 'leave_types.id', '=', 'leave_requests.leave_type_id')
                                ->join('users', 'users.id', '=', 'leave_requests.user_id')
                                
                                ->where(function($query) use ($manger_branch_id,$manger_department_id){
                                    if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                         $query1->where('users.branch_id',$manger_branch_id);
                                   if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                         $query1->where('users.department_id',$manger_department_id);
                                       
                               
                                })
                                ->Where(function($query) use ($leave_type,$status,$to,$from,$employee_name) {
                                    
                                    if($leave_type!='all')
                                        $query->where('leave_type_id',$leave_type);
                                    if($status!='all'){
                                        $query->where('leave_requests.status',$status);
                                    }
                                    if($to!='all'){
                                         $query->where('leave_to','<=' ,$to);
                                    }
                                    if($from!='all')
                                         $query->where('leave_from','>=', $from);
                                    if($employee_name!='all')
                                          $query->Where('leave_requests.user_id',$employee_name);
                                    
                                })
                                ->get();
                              
           
        }
        $types=Leave_type::get();
       
        return view('leave.search',array('leaves'=>$leave,'types'=>$types,'users'=>$users));
    }*/
    function leaveSetting($subdomain){
        
        $company=$this->company;
        $leave_setting_check=leave_type::where('company_id',$company->id)->get();
        if(!isset($leave_setting_check[0])){
            leave_type::create(array('name'=>'Annual','company_id'=>$company->id));
            leave_type::create(array('name'=>'Sick','company_id'=>$company->id));
            leave_type::create(array('name'=>'Hospitalisation','company_id'=>$company->id));
            leave_type::create(array('name'=>'Maternity','company_id'=>$company->id));
            leave_type::create(array('name'=>'Paternity','company_id'=>$company->id));
            leave_type::create(array('name'=>'LOP','company_id'=>$company->id));
        }
        $leave_annual=leave_type::where('name',"Annual")->where('company_id',$company->id)->first();
        $leave_sick=leave_type::where('name',"Sick")->where('company_id',$company->id)->first();
        $leave_hospital=leave_type::where('name',"Hospitalisation")->where('company_id',$company->id)->first();
        $leave_maternity=leave_type::where('name',"Maternity")->where('company_id',$company->id)->first();
        $leave_Paternity=leave_type::where('name',"Paternity")->where('company_id',$company->id)->first();
        $leave_LOP=leave_type::where('name',"LOP")->where('company_id',$company->id)->first();
        $leave_hours=leave_type::where('name',"hours")->where('company_id',$company->id)->first();
        $leave_types=leave_type::where('company_id',$company->id)->get();
        /*foreach( $leave_types as $index=>$leave_type){
         $leave_types   
        }*/
        
        $users=User::where('company_id',$company->id)->where('users.id', '!=' , Auth::user()->id)->get();
        $customs_annual=Custom_leave::select('custom_leaves.*','custom_leaves.name as custom_leaves_name','custom_leaves.num_days as custom_days','leave_types.*')->join('leave_types','leave_types.id','=','custom_leaves.leave_type_id')->get();
 
        foreach($customs_annual as $index=>$custom_annual){

            $customs_annual[$index]['user_details']=User::select('id','name as username','avatar')->whereIn('id', json_decode($custom_annual->user_id))->get();
        }         
      // print_r($customs_annual);exit;
        return view('leave.leave_setting',array('customs_annual'=> $customs_annual,'users'=>$users,'leave_types'=>$leave_types,'leave_annual'=>$leave_annual,'leave_sick'=>$leave_sick,'leave_hospital'=>$leave_hospital,'leave_maternity'=>$leave_maternity,'leave_Paternity'=>$leave_Paternity,'leave_LOP'=>$leave_LOP,'leave_hours'=>$leave_hours,'subdomain'=>$subdomain));
    }


    function update_leave_setting($subdomain,Request $request){
        $update=$request->all();
        $check_exist=Leave_type::where('name',$update['leave_name'])->first();
        print_r($update);
        if(!empty($check_exist)){ 
            $Leave_type=array($update['column']=>$update['field_value']);
            Leave_type::where('name',$update['leave_name'])->update($Leave_type);
        }else{
          
            Leave_type::create(array('name'=>$update['leave_name'],$update['column']=>$update['field_value']))->get();
        }

         
        
    }
    function leave_setting_change_status($subdomain,Request $request){
         $switch_status=$request['switch_status'];
         $switch_type=$request['switch_type'];
        
          if($switch_status=="true"){ 
             print_r($request['switch_status']);
            $Leave_type=array('status'=>'active');
            Leave_type::where('name',$switch_type)->update($Leave_type);
          }else{
                $Leave_type=array('status'=>'not_active');
                Leave_type::where('name',$switch_type)->update($Leave_type);
          }
            
    }
    function add_custom_leave($subdomain,Request $request){

        $req=Validator::make($request->all(),[
            'name'=>'required',
            'leave_type_id'=>'required',
            'customleave_to.*'=>'required|string',
            'days'=>'required'
            
       
        ]);
        
        if ($req->passes()) {
            $add= $request->all(); //print_r($add); exit;
          
            $users=$add['customleave_to']?$add['customleave_to']:array();
            $custom_add=Custom_leave::create(array('name'=>$add['name'],'leave_type_id'=>$add['leave_type_id'],'num_days'=>$add['days'],'user_id'=>json_encode($users)))->get();
                 
            if(!is_null($custom_add)) {
                
              return response()->json(['success'=> 'Added successfully.']);
            }

        }else{
              return response()->json(['error'=>$req->errors()->all()]);
        } 
    } 
    
    public function edit_custom_leave($subdomain,Request $request)
    {
        $company=$this->company;
        $id=$request->id;
        $custom_leave=Custom_leave::where('id', $id)->first();
        $types=Leave_type::get();
        $users=User::where('company_id',$company->id)->where('id', '<>', 'Auth::user()->id')->get();
        return response()->json(['custom_leave'=>$custom_leave,'types'=>$types,'users'=>$users]);
    }
    
    function update_custom_leave($subdomain,Request $request){

        $req=Validator::make($request->all(),[
            'name'=>'required',
            'leave_type_id'=>'required',
            'customleave_to.*'=>'required|string',
            'days'=>'required'
            
       
        ]);
        
        if ($req->passes()) {
            $add= $request->all(); //print_r($add); exit;
          
            $users=$add['customleave_to']?$add['customleave_to']:array();
            $custom_add=Custom_leave::create(array('name'=>$add['name'],'leave_type_id'=>$add['leave_type_id'],'num_days'=>$add['days'],'user_id'=>json_encode($users)))->get();
                 
            if(!is_null($custom_add)) {
                
              return response()->json(['success'=> 'Added successfully.']);
            }

        }else{
              return response()->json(['error'=>$req->errors()->all()]);
        } 
    } 

    function view_custom($subdomain,Request $reques){
         $id=$request->id;
         $type=$request->type;
         $custom=Custom_leave::where(array('id'=>$id,'type'=>$type));
         $user_details=User::select('id','name as username','avatar')->whereIn('id', json_decode($$custom->user_id))->get();
            
         return response()->json(['user_details'=>$user_details]);
        

    }
    function get_avialable($subdomain,Request $request){
        
           $leave_type=$request->id;
           $user_id= $request->user_id;
           $leave_requests=Leave_request::select('users.*','users.name as user_name','leave_requests.id as leave_id','leave_requests.days','leave_types.name','leave_types.id as leave_type_id')
                                ->join('leave_types', 'leave_types.id', '=', 'leave_requests.leave_type_id')
                                ->join('users', 'users.id', '=', 'leave_requests.user_id')
                                ->where(array('user_id'=>$user_id,'leave_type_id'=>$leave_type,'leave_requests.status'=>'accepted'))
                                ->get();
            $day_request=0;
            $total_days=0;
            $custom_days=0;
            $available_days=0;
            foreach($leave_requests as $leave_request){
                $day_request+=$leave_request->days;
            }
            $total_days=Leave_type::where('id',$leave_type)->first();
            if(!empty($total_days)){
                $total_days= $total_days->num_days;
            }
            $custom_arr= Custom_leave::where('leave_type_id',$leave_type)->where('user_id','like', "%\"{$user_id}\"%")->where('leave_type_id',$leave_type)->first();
           
            if(!empty($custom_arr)){
                $custom_days= $custom_arr->num_days;
            }
 
            if($custom_days!=0){
                $available_days=$custom_days-$day_request;
            }else{
                 $available_days=$total_days-$day_request;
            }
           // print_r($day_request); print_r($total_days); print_r($custom_days);print_r( $available_days);
            return response()->json(['available_days'=> $available_days]);
    }
    function change_status($subdomain,Request $request){
        
        $leave_type=$request->status;
        $leave_id= $request->leave_id;
        $leave_answer= $request->answer;
        Leave_request::where('id',$leave_id)->update(array('status'=>$leave_type,'answer'=>$leave_answer));
        $leave=Leave_request::where('id',$leave_id)->first();
         
        $notfy=array('title'=>'your leave','message'=> $leave_type,'company_id'=>$leave->company_id,'notify_from'=>Auth::user()->id,'notify_to'=>$leave->user_id,'data_id'=>$leave_id,'type'=>"approve_leave");
        Notifications_log::create($notfy);
        return back()->with('success', 'status changed successfully.');
 }
    public function delete($subdomain,Request $request)
    {
      //  toastr()->error(trans('trans.data_delete_successfly'));
        Leave_request::where('id',$request->id)->delete();
        return back()->with('success', 'Delete successfully.');
       
    }
}
