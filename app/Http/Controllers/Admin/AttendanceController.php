<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\User_shift;
use App\Models\Outdoor_attendance;
use App\Models\Branch;
use App\Models\Company;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class AttendanceController extends BaseController
{
    /**
     * ATTENDANCE INDEX &SEARCH
     * RETURN ARRAY
     */
    function index($subdomain,Request $request)
    {
      /*  $company = $this->company;
        if ($this->roles['name'] == "manger")
        {

            $manger_branch_id = Auth::user()->branch_id;
            $manger_department_id = Auth::user()->department_id;
        } else
        {
            $manger_branch_id = $manger_department_id = 'all';
        }
        $users = User::where('company_id', $company->id)->Where(function ($query)use ($manger_branch_id,
            $manger_department_id)
        {
            if (isset($manger_branch_id) && ($manger_branch_id != 'all'))$query->where('users.branch_id',
                $manger_branch_id); if (isset($manger_department_id) && ($manger_department_id !=
                'all'))$query->orWhere('users.department_id', $manger_department_id); }
        )->get();

        $now = Carbon::now();
        $month = $now->month;
        $attendance = array();
        DB::enableQueryLog();

        foreach ($users as $user)
        {
            $attendance[$user->id] = Attendance::select('users.*',
                'branches.id as branch_id', 'branches.title as branch_title', 'attendances.*',
                'attendances.id as attendance_id', 'attendance_attachments.avatar as attend_img',
                'attendance_attachments.lati', 'attendance_attachments.longi',
                'attendance_attachments.type', 'attendance_attachments.address')
                ->join('attendance_attachments', 'attendance_attachments.attendance_id', '=',
                    'attendances.id')->join('branches', 'branches.id', '=', 'attendances.branch_id')->
                    join('users', 'users.id', '=', 'attendances.user_id')->where('attendances.user_id',
                    $user->id)->distinct((DB::raw('DATE(attendances.created_at)')))->whereMonth('attendances.created_at',
                    '=', $month)->orderBy('attendances.created_at', 'asc')->get();
        }


        return view('attandance.index', ['attendances' => $attendance]);*/
        if ($this->roles['name'] == "manger")
        {

            $manger_branch_id = Auth::user()->branch_id;
            $manger_department_id = Auth::user()->department_id;
        } else
        {
            $manger_branch_id = $manger_department_id = 'all';
        }
        $company = $this->company;
        $search = $request->all();
         if(isset($search['employee_name']))$employee_name =$search['employee_name'];else $employee_name='all';
         if(isset($search['year']))$year =$search['year'];else $year='all';
         if(isset($search['month']))$month =$search['month'];else $month='all';
   

        $now = Carbon::now();
        if ($month == 'all')
        {

            $month = $now->month;
        }
        if ($year == 'all')
        {
            $year = $now->year;
        }
        if (!empty($employee_name)&&$employee_name!='all')
        {
            $users = User::where(array('users.company_id' => $company->id, 'id' => $employee_name))
                         ->where('users.active',1)
                         ->where('users.bassma',1)
                        
                         ->paginate(15)
                         ->appends('search',$request->all());
        } else
        {
            $users = User::where('users.company_id', $company->id)->Where(function ($query)use ($manger_branch_id,
                $manger_department_id)
            {
                        if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                             $query->where('users.branch_id',$manger_branch_id);
                        if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                             $query->where('users.department_id',$manger_department_id);
        
            })
              ->where('users.id', '!=' , Auth::user()->id)
             ->where('users.active',1)
             ->where('users.bassma',1)
             ->paginate(15)
             ->appends('search',$request->all());
        }
        $attendance = array();
        $dd="";
        foreach ($users as $user)
        {
            // if(!empty($month)&&($month!="all")&&!empty($year)){

            $attendance[$user->id] = Attendance::select('users.*',
                'branches.id as branch_id', 'branches.title as branch_title', 'attendances.*',
                'attendances.id as attendance_id', 'attendance_attachments.avatar as attend_img',
                'attendance_attachments.lati', 'attendance_attachments.longi',
                'attendance_attachments.type', 'attendance_attachments.address')
                ->join('attendance_attachments', 'attendance_attachments.attendance_id', '=', 'attendances.id')
                ->join('branches','branches.id', '=', 'attendances.branch_id')
                ->join('users', 'users.id', '=','attendances.user_id')
                ->Where(function ($query)use ($user, $year, $month)
               {

                if ($user != null || $user != "all")
                    $query->where('attendances.user_id', $user->id);
                 if ($month != "all")
                    $query->whereMonth('attendances.created_at', '=', $month);
                    $query->distinct('attendances.created_at');
                 if ($year != "all")
                    $query->whereYear('attendances.created_at', '=', $year);
                     $query->distinct('attendances.created_at');
                                        
                   //  $query->distinct((DB::raw('DATE(attendances.created_at)'))); 
               })->distinct(DB::raw('DATE(attendances.created_at)'))->get();
        
            $i=0;
          /* foreach($attendance[$user->id] as $index => $attend ){
                 $i++;
                      if($dd==Carbon::parse($attend->created_at)->format('Y-m-d')){    
                            unset($attendance[$user->id][$index]);
                           
                        }
                        $dd=Carbon::parse($attend->created_at)->format('Y-m-d');
                   
           }*/
         // print_r( array_values( $attendance[$user->id]) ); exit;
          //$dd="";
        }
        
       
        
        if($request->ajax())
             return view('attandance.search', ['attendances' =>  $attendance,'users'=>$users,'subdomain'=>$subdomain]);
        else
             return view('attandance.index', ['attendances' =>  $attendance,'users'=>$users,'subdomain'=>$subdomain]);
    }


   
    /**
     * CHANGE USER ATTENDANCE STATUS
     * RETURN MSG SUCCESS/ERROR
     */
    public function change_attend_status($subdomain,Request $request)
    {
        // print_r($request->all()); exit;

        /* if($request->status=="on"){
        
        $status="attend";
        }else{
        $status="absent";
        }*/
        $status = $request->status;

        if (empty($request->user_date_search))
        {
            $now = Carbon::now();
            $now_explode = explode('-', $now);
            $dt = Carbon::create($now_explode[0], $now_explode[1], $request->user_date);

            $select_day = $dt->toDateString();
        } else
        {

            $select_day = Carbon::parse($search->user_date_search);
            $select_day = $select_day->format('Y-m-d');
        }
        //  DB::enableQueryLog();
        $Attendance = Attendance::where('user_id', $request->user_id)->whereDate('attendances.created_at',
            '=', $select_day)->update(array('status' => $status));
        // $query = DB::getQueryLog(); print_r($query);exit;
        if ($Attendance > 0)
        {

            return response()->json(['success' => 'added successfully.']);
        } else
        {
            return response()->json(['error' => 'error.']);
        }
    }
    /**
     * SHOW ATTENDANCE DETAILS
     * 
     * 
     */
    public function show_details($subdomain,Request $request, $day, $user_id)
    {

        $now = Carbon::now();
        $now_explode = explode('-', $now);
        // print_r($request->all());exit;

        if (isset($request['date']))
        {

            $select_day = Carbon::parse($request['date']);
            $select_day = $select_day->format('Y-m-d');

            //$select_day= $date->toDateString();

        } else
        {
            if ($day == 'null' || $day == null)
            {
                $select_day = Carbon::now();
                $select_day->toDateTimeString();

            } else
            {

                $dt = Carbon::create($now_explode[0], $now_explode[1], $day);

                $select_day = $dt->toDateString();
            }

        }

        //DB::enableQueryLog();
        $attendance = Attendance::select('users.*', 'branches.id as branch_id',
            'branches.title as branch_title', 'attendances.*',
            'attendances.id as attendance_id', 'attendance_attachments.avatar as attend_img',
            'attendance_attachments.lati', 'attendance_attachments.longi',
            'attendance_attachments.type', 'attendance_attachments.address')->join('attendance_attachments',
            'attendance_attachments.attendance_id', '=', 'attendances.id')->join('users',
            'users.id', '=', 'attendances.user_id')->join('branches', 'branches.id', '=',
            'users.branch_id')->where('attendances.user_id', $user_id)->where('attendance_attachments.type',
            "in")->whereDate('attendances.created_at', '=', $select_day)->get();

        $query = DB::getQueryLog();
        // print_r($query);
        //   print_r($attendance);
        $attendance_data['sel_day'] = $day;
        $attendance_data['status'] = $attendance[0]['status'] ? $attendance[0]['status'] :
            0;

        if (isset($attendance[0]['created_at']))
        {
            $attendance_date = $attendance[0]['created_at']->toDateString();
            $attendance_in = $attendance_date . " " . $attendance[0]['time_in'];

            $attendance_out = $attendance_date . " " . $attendance[0]['time_out'];

            $attendance[0]['in'] = Carbon::parse($attendance_in)->format('l jS \of F Y h:i:s A');
            if ($attendance[0]['time_out'] != null)
            {
                $attendance_attach_out = Attendance::select('attendance_attachments.avatar as attend_img',
                    'attendance_attachments.lati', 'attendance_attachments.longi',
                    'attendance_attachments.type', 'attendance_attachments.address')->join('attendance_attachments',
                    'attendance_attachments.attendance_id', '=', 'attendances.id')->where('attendances.user_id',
                    $user_id)->where('attendance_attachments.type', "out")->whereDate('attendances.created_at',
                    '=', $select_day)->get();
                $attendance_data['attendance_attach_out'] = $attendance_attach_out;
                $attendance[0]['out'] = Carbon::parse($attendance_out)->format('l jS \of F Y h:i:s A');
                $attendance[0]['hours'] = Carbon::parse($attendance[0]['time_out'])->
                    diffInHours(Carbon::parse($attendance[0]['time_in']));
            } else
            {
                $attendance[0]['out'] = null;
                $attendance[0]['hours'] = "NaN";
                $attendance_data['attendance_attach_out'] = null;
            }
              $attendance[0]['details']=json_decode( $attendance[0]['attendances_details']);
               if(!empty($attendance[0]['details'])){
                  if (str_contains($attendance[0]['attendances_details'], 'client')) { 
                     $attendance[0]['details_type']="client";
                  }elseif(str_contains($attendance[0]['attendances_details'], 'branch')){
                     $attendance[0]['details_type']="branch";
                  }else{
                     $attendance[0]['details_type']="none";
                  }
              }
            //=gmdate('H:i:s',$hours);

        }

        $attendance_data['attendance'] = $attendance;
        $attendance_data['outdoor_attendance'] = Outdoor_attendance::select()->join('outdoor_attendance_attachments',
            'outdoor_attendance_attachments.outdoor_attendance_id', '=',
            'outdoor_attendances.id')->where('outdoor_attendances.user_id', $user_id)->
            whereDate('outdoor_attendances.created_at', '=', $select_day)->get();
        $attendance_data['user_shift_roll'] = User_shift::where('user_id', $user_id)->
            whereDate('date', '=', $select_day)->get();

        return response()->json($attendance_data);
    }
    
    

   /* function attendance_search(Request $request)
    {

        if ($this->roles['name'] == "manger")
        {

            $manger_branch_id = Auth::user()->branch_id;
            $manger_department_id = Auth::user()->department_id;
        } else
        {
            $manger_branch_id = $manger_department_id = 'all';
        }
        $company = $this->company;
        $search = $request->all();
        $employee_name = $search['employee_name'];
        $year = $search['year'];
        $month = $search['month'];

        $now = Carbon::now();
        if ($search['month'] == 'all')
        {

            $month = $now->month;
        }
        if ($search['year'] == 'all')
        {
            $year = $now->year;
        }
        if (!empty($employee_name))
        {
            $users = User::where(array('company_id' => $company->id, 'id' => $employee_name))->
                get();
        } else
        {
            $users = User::where('company_id', $company->id)->Where(function ($query)use ($manger_branch_id,
                $manger_department_id)
            {
                if (isset($manger_branch_id) && ($manger_branch_id != 'all'))$query->where('users.branch_id',
                    $manger_branch_id); if (isset($manger_department_id) && ($manger_department_id !=
                    'all'))$query->orWhere('users.department_id', $manger_department_id); }
            )->get();
        }
        $attendance = array();

        foreach ($users as $user)
        {
            // if(!empty($month)&&($month!="all")&&!empty($year)){

            $attendance[$user->id] = Attendance::select('users.*',
                'branches.id as branch_id', 'branches.title as branch_title', 'attendances.*',
                'attendances.id as attendance_id', 'attendance_attachments.avatar as attend_img',
                'attendance_attachments.lati', 'attendance_attachments.longi',
                'attendance_attachments.type', 'attendance_attachments.address')->join('attendance_attachments',
                'attendance_attachments.attendance_id', '=', 'attendances.id')->join('branches',
                'branches.id', '=', 'attendances.branch_id')->join('users', 'users.id', '=',
                'attendances.user_id')->Where(function ($query)use ($user, $year, $month)
            {

                if ($user != null || $user != "all")$query->where('attendances.user_id', $user->
                    id); if ($month != "all")$query->whereMonth('attendances.created_at', '=', $month);
                    if ($year != "all")$query->whereYear('attendances.created_at', '=', $year); $query->
                    distinct((DB::raw('DATE(attendances.created_at)'))); }
            )->orderBy('attendances.created_at', 'asc')->get();
            // print_r($attendance); exit;
            /* }elseif(!empty($year)&&($year!="all")){
            echo "22"; exit;
            $attendance[$user->id]= Attendance::select('users.*','branches.id as branch_id','branches.title as branch_title','attendances.*','attendances.id as attendance_id','attendance_attachments.avatar as attend_img','attendance_attachments.lati','attendance_attachments.longi','attendance_attachments.type','attendance_attachments.address')
            ->join('attendance_attachments', 'attendance_attachments.attendance_id', '=', 'attendances.id')
            ->join('branches', 'branches.id', '=', 'attendances.branch_id')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->where('attendances.user_id',$user->id)
            
            ->whereYear('attendances.created_at', '=', $year)
            ->distinct((DB::raw('DATE(attendances.created_at)')))
            ->get();
            }elseif(!empty($month)&&!empty($year)&&($month!="all")&&($year!="all")){
            echo "33"; exit;
            $attendance[$user->id]= Attendance::select('users.*','branches.id as branch_id','branches.title as branch_title','attendances.*','attendances.id as attendance_id','attendance_attachments.avatar as attend_img','attendance_attachments.lati','attendance_attachments.longi','attendance_attachments.type','attendance_attachments.address')
            ->join('attendance_attachments', 'attendance_attachments.attendance_id', '=', 'attendances.id')
            ->join('branches', 'branches.id', '=', 'attendances.branch_id')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->where('attendances.user_id',$user->id)
            ->whereYear('attendances.created_at', '=', $year)
            
            ->whereMonth('attendances.created_at', '=', $month)
            ->distinct((DB::raw('DATE(attendances.created_at)')))
            ->get();
            }else{
            echo "44"; exit;
            $now = Carbon::now();
            $month=$now->month;
            $attendance[$user->id]= Attendance::select('users.*','branches.id as branch_id','branches.title as branch_title','attendances.*','attendances.id as attendance_id','attendance_attachments.avatar as attend_img','attendance_attachments.lati','attendance_attachments.longi','attendance_attachments.type','attendance_attachments.address')
            ->join('attendance_attachments', 'attendance_attachments.attendance_id', '=', 'attendances.id')
            ->join('branches', 'branches.id', '=', 'attendances.branch_id')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->where('attendances.user_id',$user->id)
            
            ->whereMonth('attendances.created_at', '=', $month)
            ->distinct((DB::raw('DATE(attendances.created_at)')))
            ->get();  
            }*/
      /*  }
        return view('attandance.search', ['attendances' => $attendance]);
    }*/
}
