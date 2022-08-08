<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use App\Models\Shift;
use App\Models\User_shift;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Carbon\CarbonPeriod;
use Validator;
use App\Models\Notifications_log;
class ShiftController extends BaseController
{
    //
    function index($subdomain)
    {
        $company = $this->company;


        //$company_check=Company::join('users','users.company_id','=','companies.id')->where(array('users.id'=>Auth::user()->id,'role_id'=>1))->first();
        if ($company != "all")
        {
            //  $workflow=Workflow::groupBy('shift_id')->where('company_id',$company->id)->get();
            $companies = array();
            $shift = Shift::where('company_id', $company->id)->get();
        } else
        {

            $companies = Company::get()->toArray();
            $shift = Shift::select('shifts.*', 'companies.title as company_title')->join('companies',
                'companies.id', '=', 'shifts.company_id')->orderBy('shifts.created_at','desc')->get();
        }
        return view('shifts.index', ['shifts' => $shift, 'companies' => $companies,'subdomain'=>$subdomain]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($subdomain,Request $request)
    {
        $req = Validator::make($request->all(), 
         
        ['title' => 'required', 'from' =>
            'required|date_format:H:i',/*||after:time_in_min*/
             'to' =>
            'required|date_format:H:i',/* |after:from||after:time_out_min*/ 'shift_default' =>
            'required', 'time_in_min' => 'required|date_format:H:i', 'time_in_max' =>
            'required|date_format:H:i',/*|after:from */ 'time_out_min' =>
            'required|date_format:H:i',/* |after:time_in_max*/ 'time_out_max' =>
            'required|date_format:H:i',/* |after:time_out_min*/
             'break_time' => 'required',
            // 'overtime' => 'required',
            
            ]);
        //print_r($request->all());

        if ($req->passes())
        {
            $shift_requests = $request->all();
            $company = $this->company;
            if (isset($request->company_id))
            {
                $company_id = $request->company_id;
            } else
            {
                $company_id = $company->id;
            }

            $shift = Shift::create(array(
                'company_id' => $company_id,
                'shift_default' => $shift_requests['shift_default'],
                'time_from' => $shift_requests['from'],
                'time_to' => $shift_requests['to'],
                'title' => $shift_requests['title'],
                'time_in_min' => $shift_requests['time_in_min'],
                'time_in_max' => $shift_requests['time_in_max'],
                'time_out_min' => $shift_requests['time_out_min'],
                'time_out_max' => $shift_requests['time_out_max'],
               // 'overtime' => $shift_requests['overtime'],
                'break_time' => $shift_requests['break_time']))->get();


            if (!is_null($shift))
            {
             //   toastr()->success(trans('trans.data_add_successfly'));
                return response()->json(['success' => 'Added new records.']);
            }


        } else
        {
            return response()->json(['error' => $req->errors()->all()]);
        }
    }

    public function status($subdomain,Request $request)
    {
        $company = $this->company;
        $getDaufltShifts = Shift::where(array('company_id' => $company->id, 'status' =>
                1))->get();
        if (count($getDaufltShifts) > 1)
        {

            $shift = Shift::where('id', $request->id)->update(array('status' => $request->
                    status));
            if ($shift > 0)
            {
                return back()->with('success', ' status changed successfully.');
            } else
            {
                return back()->with('error', 'messages.error');
            }
        } else
        {
            return back()->with('error', 'messages.you must make anthor defualt before');
        }

    }

    public function edit($subdomain,$id)
    {
        $shift = Shift::where('id', $id)->get();

        return response()->json($shift);
    }

    public function update($subdomain,$id,Request $request)
    {
        $req = Validator::make($request->all(), ['title' => 'required', 'from' =>
            'required', 'to' => 'required', 'shift_default' => 'required', 'time_in_min' =>
            'required', 'time_in_max' => 'required', 'time_out_min' => 'required',
            'time_out_max' => 'required', ]);

        if ($req->passes())
        {
            $company = $this->company;
            /* if(isset($request->company_id)){
            $company_id=$request->company_id;   
            }else{
            $company_id=$company->id;
            }*/
            $request_shift = $request->all();
            $shift = array(
                'title' => $request_shift['title'],
                'shift_default' => $request_shift['shift_default']
                    /*,'company_id'=>$company_id*/,
                'time_from' => $request_shift['from'],
                'time_to' => $request_shift['to'],
                'time_in_min' => $request_shift['time_in_min'],
                'time_in_max' => $request_shift['time_in_max'],
                'time_out_min' => $request_shift['time_out_min'],
                'time_out_max' => $request_shift['time_out_max'],
                'break_time' => $request_shift['break_time']);
            Shift::where('id', $id)->update($shift);
            // toastr()->success(trans('trans.data_add_successfly'));
            return response()->json(['success' => 'Added new records.']);
        } else
        {
            return response()->json(['error' => $req->errors()->all()]);
        }
    }
    public function delete($subdomain,Request $request)
    {
        Shift::where('id', $request->id)->delete();
       // toastr()->error(trans('trans.data_delete_successfly'));
    }
    public function user_shift_index($subdomain)
    {
          $manger_branch_id= $this->branch_id;
          $manger_department_id= $this->department_id;
        $company = $this->company;
        $departments = Department::where('company_id', $company->id)->get();
        
        $users =User::where('company_id', $company->id)
        
                    ->where('users.id', '!=', Auth::user()->id)
                    ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query->where('users.department_id',$manger_department_id);
                                   
                          
                                       
                    })
                    ->where('users.active',1)
                    ->where('users.bassma',1)
                    ->get();
        $shifts = Shift::get();
        $now = Carbon::now();
        $month = $now->month;
        $current_day = Carbon::now()->format('Y-m-d');
        $usershifts = array();
        foreach ($users as $user)
        {
            $usershifts[$user->id] = User_shift::select('users.*', 'shifts.id as shift_id',
                'shifts.*', 'user_shifts.*', 'user_shifts.id as user_shifts_id')->join('shifts',
                'shifts.id', '=', 'user_shifts.shift_id')->join('users', 'users.id', '=',
                'user_shifts.user_id')->where('user_shifts.user_id', $user->id)->where('user_shifts.date',
                '>=', $current_day)->whereMonth('user_shifts.created_at', '=', $month)->get();


        }

        return view('shifts.usershift', ['usershifts' => $usershifts,'users' => $users,'shifts' => $shifts, 'departments' => $departments,'subdomain'=>$subdomain]);
    }
    public function shift_schedule_store($subdomain,Request $request)
    {
        $req = Validator::make($request->all(), ['date_from' =>
            'required|date|unique:user_shifts,date', /* |after_or_equal:today*/'date_to' =>
            'required|date|unique:user_shifts,date',/* |after_or_equal:date_from*/ 'time_in' =>
            'date_format:H:i|required',/*|nullable|after:time_in_min|required_with:time_in_min,time_in_max,time_out,time_out_min,time_out_max*/
            'time_in_min' => 'date_format:H:i|required',/*nullable|required_with:time_in,time_in_max,time_out,time_out_min,time_out_max*/
            'time_in_max' => 'date_format:H:i|required',/*|nullable|after:time_in_min|required_with:time_in,time_in_min,time_out,time_out_min,time_out_max */
            'time_out' => 'date_format:H:i|required',/* nullable|after:time_out_min|required_with:time_in,time_in_min,time_in_max,time_out_min,time_out_max*/
            'time_out_min' => 'date_format:H:i|required',/* nullable|after:time_in_max|required_with:time_in,time_in_min,time_in_max,time_out,time_out_max*/
            'time_out_max' => 'date_format:H:i|required',/*nullable|after:time_out|required_with:time_in,time_in_min,time_in_max,time_out,time_out_min*/
            'break_time' => 'required', 'active' => 'required', 'over_time' => 'required',
            'break_time' => 'required', 'shift_id' => 'required', 'user_id' => 'required', ]);

        if ($req->passes())
        {

            $company = $this->company;
            $schedule = $request->all();

            $date_from = $schedule['date_from'];
            $date_to = $schedule['date_to'];
            $start_date = Carbon::parse($date_from);
            $end_date = Carbon::parse($date_to);
            $days = $start_date->diffInDays($end_date);
            // Iterate over the period
            if (empty($schedule['time_in']))
            {

                $shift = Shift::find($schedule['shift_id']);
                $schedule["time_in"] = $shift["time_from"];
                $schedule["time_in_min"] = $shift["time_in_min"];
                $schedule["time_in_max"] = $shift["time_in_max"];
                $schedule["time_out"] = $shift["time_to"];
                $schedule["time_out_min"] = $shift["time_out_min"];
                $schedule["time_out_max"] = $shift["time_out_max"];

            }
            for ($i = 0; $i <= $days; $i++)
            {
                $date = strtotime("+" . $i . " day", strtotime($date_from));
                $date_ = date("Y-m-d", $date);

                $sch_shift = array(
                    'user_id' => $schedule['user_id'],
                    'shift_id' => $schedule['shift_id'],
                    'time_in' => $schedule['time_in'],
                    'time_in_max' => $schedule['time_in_max'],
                    'time_in_min' => $schedule['time_in_min'],
                    'time_out' => $schedule['time_out'],
                    'time_out_max' => $schedule['time_out_max'],
                    'time_out_min' => $schedule['time_out_min'],
                    'break_time' => $schedule['break_time'],
                    'date' => $date_,
                    'active' => $schedule['active'],
                    'over_time' => $schedule['over_time'],
                    'company_id' => $company->id);
                $user_shifts = User_shift::create($sch_shift)->get();
                if (!is_null($user_shifts))
                {
                    $notfy = array(
                        'title' => 'custom shift',
                        'message' => "__('trans.you have custom shift')",
                        'company_id' => $company->id,
                        'notify_from' => Auth::user()->id,
                        'notify_to' => $sch_shift['user_id'],
                        'data_id' => $user_shifts[0]->id,
                        'type' => "customer_shift");
                    Notifications_log::create($notfy);

                }


            }
            return response()->json(['success' => 'Added new records.']);

        } else
        {
            return response()->json(['error' => $req->errors()->all()]);
        }
        //   return redirect()->route('user_shift_index');
        //return back()->with('success', ' added successfully.');
    }
    public function user_shift_edit($subdomain,$id)
    {
        $user_shift = User_shift::where('id', $id)->first();

        return response()->json($user_shift);
    }

    public function user_shift_update($subdomain,Request $request, $id)
    {
        $req = Validator::make($request->all(), ['title' => 'required', 'from' =>
            'required', 'to' => 'required', 'shift_default' => 'required']);

        if ($req->passes())
        {
            $company = $this->company;
            $request_shift = $request->all();
            $shift = array(
                'title' => $request_shift['title'],
                'shift_default' => $request_shift['shift_default'],
                'company_id' => $company->id,
                'time_from' => $request_shift['from'],
                'time_to' => $request_shift['to']);
            Shift::where('id', $id)->update($shift);
            return response()->json(['success' => 'Added new records.']);
        } else
        {
            return response()->json(['error' => $req->errors()->all()]);
        }
    }
    public function shift_schedule_delete($subdomain,Request $request)
    {
        User_shift::where('id', $request->id)->delete();

    }
    public function user_shift_search($subdomain,Request $request)
    {
                    
                    
        $data_search = $request->all();
          /* $user_id=$data_search['user_shift_name']?$data_search['user_shift_name']:'all';
           $department=$data_search['department']?$data_search['department']:'all';
           $users = User::join('departments', 'departments.company_id', '=','users.company_id')
                         ->where( 'users.company_id',$company->id)
                        ->where('users.id', '!=', Auth:: user()->id)
                        
                        ->where(function($query) use( $user_id, $department){
                            if($user_id !='all')
                          $query->where( 'users.id' , $user_id);
                          if($department!='all')
                           $query->where( 'departments.id' , $department);
                    
                    
                        })->get();*/
        $company = $this->company;
        $departments = Department::where('company_id', $company->id)->get();
        if (!empty($data_search['user_shift_name']) && ($data_search['department'] ==
            "all"))
        {

            $users = User::where(array('company_id' => $company->id, 'users.id' => $data_search['user_shift_name']))->
                where('users.id', '!=', Auth::user()->id)->get();

        } elseif ((!empty($data_search['user_shift_name']) && ($data_search['department'] !=
        "all")))
        {

            $users = User::join('departments', 'departments.company_id', '=',
                'users.company_id')->where(array(
                'users.company_id' => $company->id,
                'users.id' => $data_search['user_shift_name'],
                'departments.id' => $data_search['department']))->where('users.id', '!=', Auth::
                user()->id)->get();

        } elseif ((empty($data_search['user_shift_name']) && ($data_search['department'] !=
        "all")))
        {

            $users = User::join('departments', 'departments.company_id', '=',
                'users.company_id')->where(array('users.company_id' => $company->id,
                    'departments.id' => $data_search['department']))->where('users.id', '!=', Auth::
                user()->id)->get();

        } else
        {
            $users = User::where('company_id', $company->id)->where('users.id', '!=', Auth::
                user()->id)->get();
        }

        $shifts = Shift::get();
        $now = Carbon::now();
        $month = $now->month;
        $current_day = Carbon::now()->format('Y-m-d');

        $usershifts = array();
        foreach ($users as $user)
        {

            $usershifts[$user->id] = User_shift::select('users.*', 'shifts.id as shift_id',
                'shifts.*', 'user_shifts.*', 'user_shifts.id as user_shifts_id')->join('shifts',
                'shifts.id', '=', 'user_shifts.shift_id')->join('users', 'users.id', '=',
                'user_shifts.user_id')->where('user_shifts.user_id', $user->id)->where('user_shifts.date',
                '>=', $current_day)->whereMonth('user_shifts.created_at', '=', $month)->get();

        }


        return view('shifts.user_shift_search', ['usershifts' => $usershifts, 'users' =>
            $users, 'shifts' => $shifts, 'departments' => $departments,'subdomain'=>$subdomain]);
    }
}
