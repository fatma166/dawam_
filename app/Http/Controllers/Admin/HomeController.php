<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use App\Models\Attendance;

use App\Models\User;

use App\Models\Company;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Models\Task;

use App\Models\Leave_request;

use App\Models\Client;

use App\Models\Notifications_log;   

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends BaseController



{
   /* public function __construct()
    {
         $class = 'roles';
        parent::__construct($class);
       
    }*/
    public function index($subdomain){

        $company=$this->company;
        $manger_branch_id= $this->branch_id;
        $manger_department_id= $this->department_id;
       // $roles=Auth::user()->role()->first();
        
        $date1= Carbon::now();
    
        $date=$date1->format('Y-m-d');
       if($company!="all"||Session::has('company')){

    
            $total=User::select(DB::raw('COUNT(users.id) as total'))
    
                        ->where('users.company_id',$company->id)
                        ->where('users.id', '!=' , Auth::user()->id)
                         ->where('users.active', 1)
                         ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query->where('users.department_id',$manger_department_id);
                                   
                          
                                       
                        })
                        ->first();
                        
    
            $company_report['total']=$total['total'];
    
    
    
            $present=Attendance::select( DB::raw('COUNT(attendances.user_id) as present'))
    
                    ->join('users', 'users.id', '=', 'attendances.user_id')
    
                    ->where('users.company_id',$company->id)
                    ->where('attendances.status','!=','absent')
                    ->whereDate('attendances.created_at', $date)
                    ->where('users.id', '!=' , Auth::user()->id)
                     ->where('users.active', 1)
                    ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query->where('users.department_id',$manger_department_id);
                                   
                          
                                       
                        })
                    ->first();
                   
    
            $company_report['present']= $present['present'];
    
            $company_report['absent']= $company_report['total']-$company_report['present'];
    
            $late=Attendance::select( DB::raw('COUNT(attendances.user_id) as late'))
    
                            ->join('users', 'users.id', '=', 'attendances.user_id')
    
                            ->where('attendances.description','LIKE', '%'."late".'%')
    
                            ->where('users.company_id',$company->id)
                             ->where('attendances.status','!=','absent')
                            ->whereDate('attendances.created_at', $date)
                            ->where('users.active', 1)
                            ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query->where('users.department_id',$manger_department_id);
                                   
                          
                                       
                            })
                            ->first();
    
            $company_report['late_comers']=$late['late'];
    
            $early=Attendance::select( DB::raw('COUNT(attendances.user_id) as early'))
    
                            ->join('users', 'users.id', '=', 'attendances.user_id')
    
                            ->where('attendances.description','LIKE', '%'."before_leave".'%')
                             ->where('attendances.status','!=','absent')
                            ->where('users.company_id',$company->id)
    
                            ->whereDate('attendances.created_at', $date)
                             ->where('users.active', 1)
                            ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query->where('users.department_id',$manger_department_id);
                                   
                          
                                       
                           })
                            ->first();
    
            $company_report['early_leave']=$early['early'];
    
    
    
    
    
    
    
            /*absent users*/
    
            $present_array= Attendance::select('attendances.user_id')
                                        
                                        ->where('attendances.company_id',$company->id)
                                        ->join('users', 'users.id', '=', 'attendances.user_id')
                                        ->whereDate('attendances.created_at', '=',$date)
                                             ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                     $query->where('users.branch_id',$manger_branch_id);
                                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                     $query->where('users.department_id',$manger_department_id);
                                                   
                                          
                                                       
                                        })
                                        ->get();
    
           
    
            $absents= User::select('users.name','users.id','users.avatar')->where('users.company_id',$company->id)
                           ->where('users.id', '!=' , Auth::user()->id)
                
                           
                            ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                   if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                         $query->where('users.branch_id',$manger_branch_id);
                                   if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                         $query->where('users.department_id',$manger_department_id);
                                       
                              
                                           
                            })
                          ->whereNotIn('id',$present_array)->take(5)->get();

    
    
            $month=($date1->month);
    
            $year= $date1->year;
    
            //DB::enableQueryLog();
    
            $company_report['tasks_count']=Task::where('tasks.company_id',$company->id)->whereMonth('tasks.created_at',$month)
                                                ->join('users', 'users.id', '=', 'tasks.user_id')
                                               
                                                     ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                                       if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                             $query->where('users.branch_id',$manger_branch_id);
                                                       if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                             $query->where('users.department_id',$manger_department_id);
                                                           
                                                  
                                                               
                                                })
                                                ->whereYear('tasks.created_at',$year)
                                                
                                                ->count();
    
            $company_report['tasks_done']=Task::where('tasks.company_id',$company->id)
                                              ->whereMonth('tasks.created_at',$month)
                                              ->join('users', 'users.id', '=', 'tasks.user_id')
                                               
                                                     ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                                       if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                             $query->where('users.branch_id',$manger_branch_id);
                                                       if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                             $query->where('users.department_id',$manger_department_id);
                                                           
                                                  
                                                               
                                                })
                                              ->whereYear('tasks.created_at',$year)->where('tasks.status','done')->count();
    
            $company_report['tasks_count_late']=Task::where('tasks.company_id',$company->id)
                                                    ->whereMonth('tasks.created_at',$month)
                                                    ->join('users', 'users.id', '=', 'tasks.user_id')
                                                    
                                                     ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                                       if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                             $query->where('users.branch_id',$manger_branch_id);
                                                       if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                             $query->where('users.department_id',$manger_department_id);
                                                           
                                                  
                                                               
                                                     })
                                                    ->whereYear('tasks.created_at',$year)->where('tasks.status','late')->count();
    
            $company_report['tasks_count_inprogress']=Task::where('tasks.company_id',$company->id)
                                                           ->whereMonth('tasks.created_at',$month)
                                                           ->join('users', 'users.id', '=', 'tasks.user_id')
                                                      
                                                                 ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                                                   if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                                         $query->where('users.branch_id',$manger_branch_id);
                                                                   if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                                         $query->where('users.department_id',$manger_department_id);
                                                                       
                                                              
                                                                           
                                                            })
                                                           ->whereYear('tasks.created_at',$year)
                                                           ->where('tasks.status','inprogress')->count();
    
            $company_report['tasks_count_pending']=Task::where('tasks.company_id',$company->id)
                                                       ->whereMonth('tasks.created_at',$month)
                                                       ->whereYear('tasks.created_at',$year)
                                                       ->join('users', 'users.id', '=', 'tasks.user_id')
                                                        
                                                             ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                                     $query->where('users.branch_id',$manger_branch_id);
                                                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                                     $query->where('users.department_id',$manger_department_id);
                                                                   
                                                          
                                                                       
                                                        })
                                                       ->where('tasks.status','pending')->count();
    
            //$query = \DB::getQueryLog();
    
    
    
            //dd(end($query));
    
           // print_r( $company_report['tasks_count']);exit;
    
           if( $company_report['tasks_count']!=0){
    
               
    
                $company_report['tasks_done_present']=((Task::where('tasks.company_id',$company->id)->whereMonth('tasks.created_at',$month)
                                                              ->whereYear('tasks.created_at',$year)->where('status','done')
                                                            ->join('users', 'users.id', '=', 'tasks.user_id')
                                                            
                                                             ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                                                   if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                                         $query->where('users.branch_id',$manger_branch_id);
                                                                   if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                                         $query->where('users.department_id',$manger_department_id);
                                                                       
                                                              
                                                                           
                                                            })
                                                             ->count())/$company_report['tasks_count'])*100;
    
                
    
                $company_report['tasks_late_present']=((Task::where('tasks.company_id',$company->id)->whereMonth('tasks.created_at',$month)
                                                                ->join('users', 'users.id', '=', 'tasks.user_id')
                                                               
                                                                 ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                                                   if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                                         $query->where('users.branch_id',$manger_branch_id);
                                                                   if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                                         $query->where('users.department_id',$manger_department_id);
                                                                       
                                                              
                                                                           
                                                               })
                                                               ->whereYear('tasks.created_at',$year)->where('tasks.status','late')->count())/$company_report['tasks_count'])*100;
    
                $company_report['tasks_inprogress_present']=((Task::where('tasks.company_id',$company->id)->whereMonth('tasks.created_at',$month)
                                                                  ->join('users', 'users.id', '=', 'tasks.user_id')
                                                                    
                                                                         ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                                                           if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                                                 $query->where('users.branch_id',$manger_branch_id);
                                                                           if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                                                 $query->where('users.department_id',$manger_department_id);
                                                                               
                                                                      
                                                                                   
                                                                    }) 
                                                                 ->whereYear('tasks.created_at',$year)->where('tasks.status','done')->count())/$company_report['tasks_count'])*100;
    
              
    
                $company_report['tasks_pending_present']=((Task::where('tasks.company_id',$company->id)->whereMonth('tasks.created_at',$month)
                                                                ->join('users', 'users.id', '=', 'tasks.user_id')
                                                               
                                                                     ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                                                       if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                                             $query->where('users.branch_id',$manger_branch_id);
                                                                       if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                                             $query->where('users.department_id',$manger_department_id);
                                                                           
                                                                  
                                                                               
                                                                })
                                                               ->whereYear('tasks.created_at',$year)->where('tasks.status','done')->count())/$company_report['tasks_count'])*100;
    
              
    
           }else{
                $company_report['tasks_done_present']=$company_report['tasks_late_present']= $company_report['tasks_inprogress_present']= $company_report['tasks_pending_present']=0;
           }
    
            $company_report['leave_today']=Leave_request::whereDate('leave_from', $date)
                                                        ->where('leave_requests.company_id',$company->id)
                                                        ->join('users', 'users.id', '=', 'leave_requests.user_id')
                                                        
                                                             ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                                     $query->where('users.branch_id',$manger_branch_id);
                                                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                                     $query->where('users.department_id',$manger_department_id);
                                                                   
                                                          
                                                                       
                                                        })
                                                        ->count();
    
            $company_report['task_done_today']=Task::whereDate('tasks.created_at', $date)
                                                   ->join('users', 'users.id', '=', 'tasks.user_id')
                                                        
                                                         ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                                           if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                                 $query->where('users.branch_id',$manger_branch_id);
                                                           if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                                 $query->where('users.department_id',$manger_department_id);
                                                               
                                                      
                                                                   
                                                    })
                                                      ->count();
    
            $company_report['leave_users']=Leave_request::select('users.*','users.name as user_name','leave_requests.id as leave_id','leave_requests.*')
    
                                                        ->where('leave_requests.status','pending')
    
                                                        ->whereDate('leave_from', $date)
                                                        ->where('leave_requests.company_id',$company->id)
                                                        ->join('users', 'users.id', '=', 'leave_requests.user_id')
                                                           
                                                     
                                                         ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                                     $query->where('users.branch_id',$manger_branch_id);
                                                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                                     $query->where('users.department_id',$manger_department_id);
                                                                   
                                                          
                                                                       
                                                        })
                                                        ->take(5)->get();
    
    
    
            
    
            $company_report['clients']=Client::select('clients.*')->where('clients.company_id', $company->id)
                                             ->Where(function($query2) use ($manger_branch_id) {
                                              
                                               if(isset($manger_branch_id)&&$manger_branch_id!='all')
                                               $query2->Where('clients.branch_id',$manger_branch_id);
                                              
                                              })->take(5)->get();
    
            $company_report['tasks']=Task::select('tasks.*')->whereDate('due_date', $date)
                                         ->join('users', 'users.id', '=', 'tasks.user_id')
                                            ->where('tasks.company_id',$company->id)        
                                         ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                     $query->where('users.branch_id',$manger_branch_id);
                                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                     $query->where('users.department_id',$manger_department_id);
                                                   
                                          
                                                       
                                         })
                                         ->take(5)->get();    
    
             return view('index')->with(compact('company_report','absents','subdomain'));
        }else{
            
            
            $company_report['total_company']=Company::count();
            $total=User::select(DB::raw('COUNT(users.id) as total'))
    
                        
                        ->where('users.id', '!=' , Auth::user()->id)
                         ->orwhere('users.role_id', '!=' , 2)
                        ->first();
                        
    
            $company_report['total']=$total['total'];
    
    
    
            $present=Attendance::select( DB::raw('COUNT(attendances.user_id) as present'))
    
                    ->join('users', 'users.id', '=', 'attendances.user_id')
    

                    ->where('attendances.status','!=','absent')
                    ->whereDate('attendances.created_at', $date)
                    ->where('users.id', '!=' , Auth::user()->id)
                    
                    ->first();
                   
    
            $company_report['present']= $present['present'];
    
             return view('admin_board.index')->with(compact('company_report','subdomain'));
          
        }
        

          



        

       /* $tasks statistics*/

    }

    public function line_chart($subdomain){

        $company=$this->company;

        $date1= Carbon::now();



        $month=($date1->month)-1;

        $year= $date1->year;

           $number_days = Carbon::now()->daysInMonth; 

        $total=User::select(DB::raw('COUNT(users.id) as total'))->where('users.company_id',$company->id)->where('users.id', '!=' , Auth::user()->id)->first();

        $total=$total['total'];

        $company_report=array();

        for($day=0;$day<=$number_days;$day++){

            $estimated=strtotime($year."-".$month."-".$day);

            $date=date('Y-m-d',$estimated);

            $company_report[$day]['day']=$day;

            $present=Attendance::select( DB::raw('COUNT(attendances.user_id) as present'))

                                ->join('users', 'users.id', '=', 'attendances.user_id')

                                ->where('users.company_id',$company->id)

                                ->whereDate('attendances.created_at', '=', $date) 

                                

                                ->first();

                               

            $company_report[$day]['present']= $present['present'];

            $company_report[$day]['absent']= $total-$company_report[$day]['present'];

            $late=Attendance::select( DB::raw('COUNT(attendances.user_id) as late'))

                                ->join('users', 'users.id', '=', 'attendances.user_id')

                                ->where('attendances.description','LIKE', '%'."late".'%')

                                ->where('users.company_id',$company->id)

                                ->whereDate('attendances.created_at', '=', $date)

                                ->first();

            $company_report[$day]['late_comers']=$late['late'];

            $early=Attendance::select( DB::raw('COUNT(attendances.user_id) as early'))

                            ->join('users', 'users.id', '=', 'attendances.user_id')

                            ->where('attendances.description','LIKE', '%'."before_leave".'%')

                            ->where('users.company_id',$company->id)

                            ->whereDate('attendances.created_at', '=', $date)

                            ->first();

            $company_report[$day]['early_leave']=$early['early'];

        }

       // $data=array(array('y'=> '2006', 'present'=> 50,'b'=> 90 ),array('y'=> '2007', 'present'=> 57,'b'=> 97 ),array('y'=> '2008', 'a'=> 58,'b'=> 98));

        return response()->json($company_report); 

    }

    public function selectEmployeeSearch(Request $request)
    {
         $manger_branch_id= $this->branch_id;
         $manger_department_id= $this->department_id;
         $company=$this->company;
         $users = [];

        if($request->has('q')){
            $search = $request->q;
            $users =User::select("id", "name")
            		->where('name', 'LIKE', "%$search%")
    	            ->where('company_id',$company->id)
                    ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query->where('users.department_id',$manger_department_id);
                                       
                    })
                    ->where('users.active',1)
                    ->where('users.bassma',1)
            		->get();
        }
        return response()->json($users);
   }

   
    public function selectEmployeeSearchBranch(Request $request)
    {
         $manger_branch_id= $this->branch_id;
         $manger_department_id= $this->department_id;
         $company=$this->company;
         $users = [];
         
//print_r($request['branch']);exit;

        if($request->has('q')){
            $search = $request->q;
             $branch= $request['branch'];
            $users =User::select("id", "name")
            		->where('name', 'LIKE', "%$search%")
             	    ->where('company_id', $company->id)
                   ->where(function($query) use($branch){
                           if($branch!='all')
                           $query->where('branch_id', $branch);
                    })
                    ->where('users.active',1)
                    ->where('users.bassma',1)
            		->get();
        }

        return response()->json($users);
   }

       public function selectClientSearchBranch(Request $request)
    {
         $company=$this->company;
         $users = [];
         


        if($request->has('q')){
            $search = $request->q;
            $branch= $request['branch'];
            $users =Client::select("id", "name")
            		->where('name', 'LIKE', "%$search%")
             	    ->where('company_id', $company->id)
                    ->where(function($query) use($branch){
                           if($branch!='all')
                           $query->where('branch_id', $branch);
                    })
                   
            		->get();
        }

        return response()->json($users);
   }
   
    public function get_notification($subdomain){
        $manger_branch_id= $this->branch_id;
        $manger_department_id= $this->department_id;
        $notfys=Notifications_log::select('notifications_logs.*','users.avatar','users.name')
                                  ->join('users', 'users.id', '=','notifications_logs.notify_from')
                                  ->where('notifications_logs.company_id',$this->company->id)
                                  ->where('status','=','delivered')->where('notifications_logs.created_by','user')
                                  ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                     $query->where('users.branch_id',$manger_branch_id);
                                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                     $query->where('users.department_id',$manger_department_id);
                                                   
                                          
                                                       
                                    })
                                 ->orderBy('created_at','desc')->take(8)->get();
          
           View::share('notfys',$notfys);

            return view('activities.notfy',compact('subdomain'));

    }
    
    public function get_notification_all($subdomain){
          $manger_branch_id= $this->branch_id;
          $manger_department_id= $this->department_id;
          $activities=Notifications_log::select('notifications_logs.*','users.avatar','users.name')
                                        ->join('users', 'users.id', '=','notifications_logs.notify_from')
                                        ->where('notifications_logs.company_id',$this->company->id)
                                        ->where('status','=','delivered')->where('notifications_logs.created_by','user')
                                        ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                     $query->where('users.branch_id',$manger_branch_id);
                                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                     $query->where('users.department_id',$manger_department_id);
                                                   
                                          
                                                       
                                          })
                                        ->orderBy('created_at','desc')->paginate(15);

          

            return view('activities.activities',['activities'=>$activities,'subdomain'=>$subdomain]);
        
    }


   public function mac_check($subdomain,Request $request){
    
        $company=$this->company;
        $data_notfy=$request->all();

        if($data_notfy['status']=="accept"){
           
            $addtion_data= json_decode($data_notfy['addtion_data']);
           
            $user_data=User::select('id','MAC_address')->where('id',$data_notfy['notify_id'])->first(); 
          
           // print_r(json_decode($user_data['MAC_address']));
            $all_macs=array_merge($addtion_data,json_decode($user_data['MAC_address']));
            User::where('id',$data_notfy['notify_id'])->update(array('MAC_address'=>json_encode($all_macs)));
            $notfy=array('title'=>'accept_mac','message'=> "accept_mac",'company_id'=>$company->id,'notify_from'=>Auth::user()->id,'notify_to'=>$data_notfy['notify_id'],'data_id'=>$data_notfy['notify_id'],'addtion_data'=>$data_notfy['addtion_data'],'type'=>"accept_mac",'created_by'=>"admin");
            Notifications_log::create($notfy); 
          
        }else{
            $notfy=array('title'=>'refuse_mac','message'=> "accept_mac",'company_id'=>$company->id,'notify_from'=>Auth::user()->id,'notify_to'=>$data_notfy['notify_id'],'data_id'=>$data_notfy['notify_id'],'type'=>"refuse_mac",'created_by'=>"admin");
            Notifications_log::create($notfy);  
        }
        
        Notifications_log::where('id',$data_notfy['id'])->update(array('status'=>'seen'));
          
        return redirect()->route('activities',$subdomain);
    
   }
   
   public function change_status_notification(Request $request){
         $data=$request->all();
         Notifications_log::where('id',$data['notify_id'])->update(array('status'=>'seen'));
       
         return response()->json(['success'=>'updated.']);
   }

}

