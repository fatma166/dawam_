<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Library\Error;
use App\Models\attendance_attachment;
use App\Models\Attendence;
use App\Models\attendence_report;
use App\Models\User;
use App\Traits\DistanceChecker;
use App\Traits\Uploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User_shift;
use App\Models\Shift;
use App\Library\ThirdApi;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use App\Models\Outdoor;
use App\Models\Client;
USE App\Contracts\ErrorMessages;


class AttendenceController extends Controller
{
    use Uploader, DistanceChecker;
    
    public function Index(Request $request, $limit = 30)
    {

        $req = Validator::make($request->all(), [
            'date' => 'date_format:Y-m|nullable',
        ]);

        if ($req->fails()) {
            return response()->json(['msg' => ErrorMessages::ATTENDANCE_DATE_VALIDATION_ERROR], 400);
        }

        $currentTime = $request->date?date_create($request->date):new \DateTime();
        $currentMonth = $currentTime->format('m');
        $currentYear = $currentTime->format('Y');
    

        $attendence_reports = $request->user()->attendence_report()->with("attendance.attendence_attachments")->whereMonth('day', $currentMonth)->whereYear('day', $currentYear)->orderBy('day', 'desc')->limit($limit)->get();
        return $this->FormatReports($attendence_reports);
    }

    public function Count(Request $request)
    {

        return $this->CollectAttendData($request);
    }

    public function Register(Request $request)
    {
        $req = Validator::make($request->all(), [
            'longi' => 'required',
            'lati' => 'required',
           // 'avatar' => 'nullable|image|mimes:png,jpeg,jpg',
            // 'avatar' => 'nullable|image',
            'address' => 'required',
            'is_fake' => 'required|boolean',
            'type' => 'required|in:in,out',
        ]);

        if ($req->fails()) {
            return response()->json($req->errors(), 422);
        }
        /**
         * User Data
         */
        $user = $request->user();
        $userBranch = $user->branch;
        $userCompany = $user->company;

        if ($request->is_fake && !$userCompany->fake_check) {
            $data['msg'] = "Fake Location";
            return response()->json($data, 422);
        }

        /**
         * checkRegisterLocation in or out field
         */
         
        $is_in_target = $this->checkRegisterLocation($userBranch, $request);
                $attandence_details=array();
        //abdelkawycode
        if($is_in_target==true)
        {
            $attandence_details[$userBranch->id]['branch_id']=$userBranch->id;
            $attandence_details[$userBranch->id]['branch_name']=$userBranch->title;
        }

        elseif($is_in_target==false)
        {
            /* $users_attend=Outdoor::select("outdoors.user_id","outdoors.longi","outdoors.lati","outdoors.company_id",
            "outdoors.customer_id as client_id","clients.name") */
            $clients=Client::select("clients.name","clients.longi","clients.lati","clients.company_id",
            "clients.id as client_id")
            ->Where(function($query) use($userCompany,$request,$userBranch)
            {
                  $query->where('clients.company_id',$userCompany->id);
                  $query->where('clients.branch_id',$userBranch->id);
            })->get();
            
          // return response()->json($clients);
           if(!is_null($clients))
           {
                foreach($clients as $clien)
                {
                   //return response()->json($clien);
                  
                    
                    $is_in_target = $this->checkRegisterLocation($clien, $request);
                    if($is_in_target==true)
                    {
                        // $attandence_details['branch_id']=$userBranch->id;
                        // $attandence_details[$clien->client_id]=$clien->name;
                        $attandence_details[$clien->client_id]['client_id']=$clien->client_id;
                        $attandence_details[$clien->client_id]['client_name']=$clien->name;
                    }
                   
                   
                }
           //  return response()->json($attandence_details);
           }
    
          
           
      }
       
        if (!$is_in_target && $userCompany->target_location_check) {
            
            $data['msg'] = "un valid Location";
            return response()->json($data, 422);
            
        }
        
        /**
         * registiration  date
         */
        $date = new \DateTime();

        $current_time = $date->format('Y-m-d H:i:s');
        $today_date = $date->format('Y-m-d');
        $today_title = $date->format('D');

        $registirationTime = $date->format('H:i:s');

        /**
         * in code
         *check duplicate registiration
         */
        $userProcess = $request->type == 'in' ? 'time_in' : 'time_out';
        if ($user->attendences()->whereNotNull($userProcess)->whereDate('created_at', $today_date)->first()) {
            $data['msg'] = 'you Already check' . $request->type;
            return response()->json($data, 422);

        }

        /**
         *
         * return
         * shift_id
         * allow_time_in
         * allow_time_out
         * work_hours
         * allow_overtime
         */
        $Shift_rules = $this->get_user_shift_rules($user, $userCompany, $today_date);
      

        /**
         * check user if check in before check out
         */
        if ($userProcess == 'time_out') {
            //attendence equal checkin attendance data or null
            if (!$attendence = $user->attendences()->whereNotNull('time_in')->whereDate('created_at', $today_date)->first()) {
                $data['msg'] = 'must check in first';
                return response()->json($data, 422);
            }
        } else {

            //check if user checkni after check out time
            if ($registirationTime > $Shift_rules['allow_time_out']) {
                $error['msg'] = 'check in is too late ';
                return response()->json($error, 442);
            }

            //check if user check in before ckeck in time with more 15 minutes
            $allow_time_in_time = date_create($Shift_rules['allow_time_in']);
            date_sub($allow_time_in_time, date_interval_create_from_date_string("15 minutes"));
            $allow_time_in_before = date_format($allow_time_in_time, "H:i:s");
            if ($registirationTime < $allow_time_in_before) {

                $error['msg'] = 'check in is too early ';
                return response()->json($error, 442);
            }

            //check if day is holiday
            $is_holiday = $this->checkHoliday($today_title, $today_date, $userCompany);
        }

        /**
         * Get User Attendance Report
         */
        $report = $this->export_Attendance_report($userCompany, $Shift_rules, $registirationTime, $request->type);
        switch ($request->type) {
            case 'in':
                /**
                 * Add Attendance Data For User
                 */
                $attendence = new Attendence();
                $attendence->shift_id = $Shift_rules['shift_id'];
                $attendence->branch_id = $request->user()->branch_id;
                $attendence->company_id = $userCompany->id;
                $attendence->time_in = $current_time;
                $attendence->is_holiday = isset($is_holiday) ? $is_holiday : 0;
                $attendence->description = $report['report'];
                // $attendence->created_at =$current_time;

                $attendence->status = $report['report'] == "late" ? "Attendance_discount" : "attend";
                 $attendence->attendances_details =json_encode($attandence_details);
                // attendence equal new attendance record
                $attendence = $request->user()->attendences()->save($attendence);
                /**
                 * add report for user attendance
                 */
                $attendence_report = new attendence_report();
                $attendence_report->day = $today_date;
                $attendence_report->worktime = "00:00";

                $attendence_report->overtime = "00:00";
                $attendence_report->attendance_id = $attendence->id;

                $user->attendence_report()->save($attendence_report);
                break;
            case 'out':
                /**
                 * set checkout time for user
                 */

                $attendence->time_out = $current_time;
                $TimeDiff = date_diff(date_create($attendence->time_out), date_create($attendence->time_in));
                $num_work_hours = $TimeDiff->format("%H");
                if ($report["type"] = "before_leave") {
                    if ($num_work_hours < $userCompany->min_time) {
                        $attendence->status = "absent";
                    } else {
                        $attendence->status = "Attendance_discount";

                    }
                }

                $attendence->description = $attendence->description . ',' . $report['report'];
                $attendence->save();
                /**
                 * add report for user attendance
                 */
                $attendence_report = $user->attendence_report()->where('day', $today_date)->first();

                $attendence_report->worktime = $TimeDiff->format("%H:%I");

                $attendence_report->overtime = $report['overtime_work_hours'];
                $attendence_report->save();
                break;
        }
        /**
         * add attendance attachement
         */
        $request->request->add(['in_target' => $is_in_target]);

        $this->add_attendance_attachement($attendence, $request);

        $data['msg'] = "sucess";
        return response()->json($data, 200);
    }

//new 22/11

/**
 * store
*/
    public function Store(Request $request)
    {
        //return response()->json($request);
        $req = Validator::make($request->all(), [
            'longi' => 'required',
            'lati' => 'required',
            // 'avatar' => 'nullable|image|mimes:png,jpeg,jpg',
           // 'avatar' => 'nullable|image',
            'address' => 'nullable',
            'is_fake' => 'required|boolean',
            //shift setting
            'is_custom' => 'required|boolean',
            'shift_id'=>'required',
            //end shift setting
            'type' => 'required|in:in,out',
            //new for offline
            'datetime'=>'required|date_format:Y-m-d H:i:s'
        ]);

        if ($req->fails()) 
        {
           
            $messages=$req->messages();
           
                
                 if ($messages->has('lati')||$messages->has('longi')){
                        $data['msg'] = "empty Location";
                        return response()->json(['msg' => ErrorMessages::ATTENDANCE_STORE_VALIDATION_EMPTY_LOCATION_ERROR], 422);
                  } elseif ($messages->has('is_fake')) {
                          $data['msg'] = "empty is_fake";
                          return response()->json(['msg' => ErrorMessages::ATTENDANCE_STORE_VALIDATION_EMPTY_ISFAKE_ERROR], 422);
                  }elseif ($messages->has('is_custom')){
                            $data['msg'] = "empty is_custom";
                            return response()->json(['msg' => ErrorMessages::ATTENDANCE_STORE_VALIDATION_EMPTY_ISCUSTOM_ERROR], 422);
                  }elseif ($messages->has('shift_id')){
                          $data['msg'] = "empty shift_id";
                          return response()->json(['msg' => ErrorMessages::ATTENDANCE_STORE_VALIDATION_EMPTY_SHIFT_ID_ERROR], 422);
                  }elseif ($messages->has('type')){
                          $data['msg'] = "empty type";
                          return response()->json(['msg' => ErrorMessages::ATTENDANCE_STORE_VALIDATION_EMPTY_TYPE_ERROR], 422);
                  }elseif ($messages->has('datetime')){
                           $data['msg'] = "empty datetime";
                           return response()->json(['msg' => ErrorMessages::ATTENDANCE_STORE_VALIDATION_EMPTY_DATETIME_ERROR], 422);
                  }else{
                          return response()->json(['msg' =>ErrorMessages::ATTENDANCE_STORE_VALIDATION_EMPTY_PUBLIC_ERROR], 422);
                  }
           
           
        }
        /**
         * User Data
         */


        $user = $request->user();
       // return response()->json($user);
        $userBranch = $user->branch;
        $userCompany = $user->company;

        if ($request->is_fake && !$userCompany->fake_check) 
        {
            $data['msg'] = "Fake Location";
            return response()->json(['msg' => ErrorMessages::ATTENDANCE_STORE_FAKE_LOCATION_ERROR], 422);
            
        }

        /**
         * checkRegisterLocation in or out target
         */

        $is_in_target = $this->checkRegisterLocation($userBranch, $request);
       
        $attandence_details=array();
       
        if($is_in_target==true)
        {
            $attandence_details[$userBranch->id]['branch_id']=$userBranch->id;
            $attandence_details[$userBranch->id]['branch_name']=$userBranch->title;
        }

        elseif($is_in_target==false)
        {
            /* $users_attend=Outdoor::select("outdoors.user_id","outdoors.longi","outdoors.lati","outdoors.company_id",
            "outdoors.customer_id as client_id","clients.name") */
            $clients=Client::select("clients.name","clients.longi","clients.lati","clients.company_id",
            "clients.id as client_id")
            ->Where(function($query) use($userCompany,$request,$userBranch)
            {
                  $query->where('clients.company_id',$userCompany->id);
                  $query->where('clients.branch_id',$userBranch->id);
            })->get();
            
          // return response()->json($clients);
           if(!is_null($clients))
           {
                foreach($clients as $clien)
                {
                   //return response()->json($clien);
                  
                    
                    $is_in_target = $this->checkRegisterLocation($clien, $request);
                    if($is_in_target==true)
                    {
                        // $attandence_details['branch_id']=$userBranch->id;
                        // $attandence_details[$clien->client_id]=$clien->name;
                        $attandence_details[$clien->client_id]['client_id']=$clien->client_id;
                        $attandence_details[$clien->client_id]['client_name']=$clien->name;
                    }
                   
                   
                }
           //  return response()->json($attandence_details);
           }
    
          
           
     }


     
         /**
         * registiration  date
         */
         //for offline
        $date = date_create($request->datetime);
       
        // $date = date_create("2021-09-29 00:40:00");

        $current_time = $date->format('Y-m-d H:i:s');
        $today_date = $date->format('Y-m-d');
        $today_title = $date->format('D');

        $registirationTime = $date->format('H:i:s');

        /**
         * in code
         *check duplicate registiration
         */
        $userProcess = $request->type == 'in' ? 'time_in' : 'time_out';
        if ($user->attendences()->whereNotNull($userProcess)->whereDate('created_at', $today_date)->first()) {
            $data['msg'] = 'you Already check' . $request->type;
       
            if( $request->type=='in')
            $_var=ErrorMessages::ATTENDANCE_STORE_YOU_ALREADY_CHECK_IN_ERROR;
            if( $request->type=='out')
             $_var=ErrorMessages::ATTENDANCE_STORE_YOU_ALREADY_CHECK_OUT_ERROR;
            return response()->json(['msg' =>$_var],400);

        }

        /**
         *
         * return
         * shift_id
         * allow_time_in
         * allow_time_out
         * work_hours
         * allow_overtime
         */
        $Shift_rules = $this->get_user_shift_rules_in_offline($request);
       // return response()->json($Shift_rules);
        // return $Shift_rules;

  
        /**
         * check  if this day is holiday
         */
        if ($userProcess == 'time_in') {
            $is_holiday = $this->checkHoliday($today_title, $today_date, $userCompany);

        }else{
            /**
             *check if out before in
             */
            if (!$attendence = $user->attendences()->whereNotNull('time_in')->whereDate('created_at', $today_date)->first()) {
                $data['msg'] = 'must check in first';
                return response()->json(['msg' => ErrorMessages::ATTENDANCE_STORE_MUST_CKECK_IN_FIRST_ERROR], 422);
            }
        } 

        /**
         * Get User Attendance Report
         */
          $user_id=$user->id;               
        $report = $this->export_Attendance_report($userCompany, $Shift_rules, $registirationTime, $request->type);
        switch ($request->type) 
        {
            case 'in':
                /**
                 * Add Attendance Data For User
                 */
                $attendence = new Attendence();
                $attendence->shift_id = $Shift_rules['shift_id'];
                $attendence->branch_id = $request->user()->branch_id;
                $attendence->company_id = $userCompany->id;
                $attendence->time_in = $current_time;
                $attendence->is_holiday = isset($is_holiday) ? $is_holiday : 0;
                $attendence->description = $report['report'];
                $attendence->status = $report['report'] == "late" ? "Attendance_discount" : "attend";
                $attendence->created_at =$current_time;

                //stratabdelkawy
                $attendence->attendances_details =json_encode($attandence_details);
                //endabdelkawy

                // attendence equal new attendance record
                $attendence = $request->user()->attendences()->save($attendence);
                /**
                 * add report for user attendance
                 */
                $attendence_report = new attendence_report();
                $attendence_report->day = $today_date;
                $attendence_report->worktime = "00:00";

                $attendence_report->overtime = "00:00";
                $attendence_report->attendance_id = $attendence->id;

                $user->attendence_report()->save($attendence_report);
                break;
            case 'out':
                /**
                 * set checkout time for user
                 */
                  
               $date_time=date_create($request->datetime);
               $date_time1 =$date_time->format('Y-m-d');
                                                                     
                $attendence->time_out = $current_time;
                $TimeDiff = date_diff(date_create($attendence->time_out), date_create($attendence->time_in));
                $num_work_hours = $TimeDiff->format("%H");
                if ($report["type"] = "before_leave") {
                    if ($num_work_hours < $userCompany->min_time) {
                        $attendence->status = "absent";
                    } else {
                        $attendence->status = "Attendance_discount";

                    }
                }

                $attendence->description = $attendence->description . ',' . $report['report'];
                $out_time=date_create($attendence->time_out);                
                $ttendance_arr=array('description'=>$attendence->description,'time_out'=>$out_time->format('H:i:s'),'status'=>$attendence->status);                                                       
              
                 //DB::enableQueryLog();                
                 Attendance::where('user_id','=',$user_id)->whereDate('created_at',$date_time1)->update($ttendance_arr);
               // $query = DB::getQueryLog();print_r($query);exit;
                 //exit;                 
                $attendence=Attendance::where('user_id',$user_id)->whereDate('created_at',$date_time1)->get();
            
            // print_r($attendence); 
                /**
                 * add report for user attendance
                 */
                $attendence_report = $user->attendence_report()->where('day', $today_date)->first();
                $attendence_report->worktime = $TimeDiff->format("%H:%I");

                $attendence_report->overtime = $report['overtime_work_hours'];
                $attendence_report->save();
                break;
        }
        /**
         * add attendance attachement
         */
        $request->request->add(['in_target' => $is_in_target]);
         if($request->type=='out'){
                  $this->add_attendance_attachement($attendence[0], $request);
                  }
          else{    
                  $this->add_attendance_attachement($attendence, $request);
                  
              }                  
      

        $data['msg'] = "sucess";
        return response()->json(['msg'=>ErrorMessages::ATTENDANCE_STORE_SECCUSS], 200);
    }
    private function checkHoliday($day, $currentDate, $Company)
    {

        $is_holiday = false;
        if ($companyHolidays = $Company->holidays) {

            $holidayDays = json_decode($companyHolidays->day);
            foreach ($holidayDays as $key => $value) {
                # code...
                if (Str::startsWith($key, Str::lower($day))) {
                    $is_holiday = true;
                    break;
                }

            }
        }

        if (!$is_holiday && $Company->exception_holidays()->whereDate('date_from', '<=', $currentDate)->whereDate('date_to', '>=', $currentDate)->first()) {
            $is_holiday = true;
        }

        return $is_holiday;
    }

    private function export_Attendance_report($company, $shift_rules, $register_time, $register_type)
    {
        //set intial data
        $data['report'] = 'attend';
        $data['overtime_work_hours'] ='00:00';
        $work_flow_run_flag = false;
        switch ($register_type) {
            case 'in':
                if ($register_time > $shift_rules['allow_time_in']) {

                    $first_time = $register_time;
                    $second_time = $shift_rules['allow_time_in'];
                    $type = 'late';
                    $work_flow_run_flag = true;
                    $data['report'] = $type;

                }
                break;
            case 'out':

                if ($register_time < $shift_rules['allow_time_out']) {

                    $first_time = $shift_rules['allow_time_out'];
                    $second_time = $register_time;
                    $type = 'before_leave';
                    $work_flow_run_flag = true;
                    $data['report'] = $type;
                } else {

                    /**
                     * $first time
                     * $second time
                     * $type
                     * $work_flow_flag
                     */
                    if ($shift_rules['allow_overtime']) {
                        $first_time = $register_time;
                        $second_time = $shift_rules['allow_time_out'];
                        $type = 'overtime';
                        $work_flow_run_flag = true;
                        $data['report'] = $type;
                    }

                }
                break;
        }

        if ($work_flow_run_flag) {

            $lated_time = date_diff(date_create($first_time), date_create($second_time));
            $lated_time = $lated_time->format("%H:%I");
            $rules = $company->workflows()->where('type', $type)->where("shift_id", $shift_rules["shift_id"])->orderBy('hours', 'desc')->orderBy('minutes', 'desc')->get();
            $data['overtime_work_hours'] = $type == 'overtime' ? $lated_time : '00:00';
            foreach ($rules as $key => $value) {
                //check here
                $rule_time = date("H:i", mktime($value->hours, $value->minutes, 0, 0, 0, 0));
                if ($lated_time >= $rule_time) {
                    $data['rebort'] = $type . ':' . $value->description;
                    break;
                }
                # code...
            }

        }
        $data['type'] = isset($type) ? $type : 'attend';

/**
 * status  = >
 * rebort
 * overtime_work_hours
 */
        return $data;

    }

    private function get_user_shift_rules($user, $company, $currentDate)
    {
        /**
         * get time allowed for user to checkin and checkout
         * return data
         * allow_time_in
         * allow_time_out
         * work_hours
         */
        if (!$UserShift = $user->userShifts()->whereDate('date', $currentDate)->where('active', 1)->first()) {
            $UserShift = $user->userShift;      
        }else {
            $is_custom_shift =1;
        }
 
         //   return $UserShift;
         $data['allow_time_in'] = $UserShift->time_in_max;
         $data['time_in'] = isset($is_custom_shift) ? $UserShift->time_in : $UserShift->time_from;
         $data['allow_time_out'] = isset($is_custom_shift) ? $UserShift->time_out : $UserShift->time_to;
         $data['allow_overtime'] =$UserShift->over_time;
         $data['shift_id'] = isset($is_custom_shift) ? $UserShift->shift_id : $UserShift->id;
         $data['work_hours'] = date_diff(date_create($data['allow_time_out']), date_create($data['time_in']))->h;

        return $data;
    }

    private function add_attendance_attachement($attendence, $request)
    {
       
        
        
        
        
         $attendence_attachement = new attendance_attachment();

        $attendence_attachement->lati = $request->lati;
        $attendence_attachement->longi = $request->longi;
        $attendence_attachement->address = $request->address??ThirdApi::ParceCoordinate($request->lati,$request->longi);
        $attendence_attachement->type = $request->type;
        $attendence_attachement->attendance_id = $attendence->id;
        $attendence_attachement->is_fake = $request->is_fake;
        $attendence_attachement->in_target = $request->in_target;
        
        
        
           if($request->hasFile('avatar')){
               
               $image = $request->file('avatar');
               $image_url = $this->upload_attachement($image);
               
               $attendence_attachement->avatar = $image_url;

            }
        
        $attendence_attachement->save();
        
        
        
        
    }

//new 22/11
    
     private function get_user_shift_rules_in_offline($request)
    {
        /**
         * get time allowed for user to checkin and checkout
         * return data
         * allow_time_in
         * allow_time_out
         * work_hours
         */


          if($request->is_custom){
            $UserShift=User_shift::find($request->shift_id);
            $is_custom_shift =1;

          }else{
            $UserShift=Shift::find($request->shift_id);
          }


      // print_r( $UserShift);exit;
        $data['allow_time_in'] = $UserShift->time_in_max;
        $data['time_in'] = isset($is_custom_shift) ? $UserShift->time_in : $UserShift->time_from;
        $data['allow_time_out'] = isset($is_custom_shift) ? $UserShift->time_out : $UserShift->time_to;
        $data['allow_overtime'] =$UserShift->over_time;
        $data['shift_id'] = isset($is_custom_shift) ? $UserShift->shift_id : $UserShift->id;
        $data['work_hours'] = date_diff(date_create($data['allow_time_out']), date_create($data['time_in']))->h;

        return $data;
    }

    private function FormatSingleReport($report)
    {
        if (!$report) {
            return $report;
        }
        
        $report['time_in'] = $report->attendance->time_in;
        $report['time_out'] = $report->attendance->time_out;
        $report['status'] = $report->attendance->status;
        foreach ($report->attendance->attendence_attachments as $attachment) {

            switch ($attachment->type) {
                case "in":
                    $report['in_address'] = $attachment->address;
                    $report['in_image'] = $attachment->avatar;
                    
                    break;
                case "out":
                    $report['out_address'] = $attachment->address;
                    $report['out_image'] = $attachment->avatar;
                    break;
            }
        }
        unset($report->attendance);

        return $report;
    }

    private function FormatReports($reports)
    {
        $formated = [];
        if (empty($reports)) {
            return $reports;
        }

        foreach ($reports as $report) {
            array_push($formated, $this->FormatSingleReport($report));
        }
        return $formated;

    }

    private function CollectAttendData($request)
    {
        $currentTime = new \DateTime('Africa/cairo');
        $year = $currentTime->format('Y');
        $month = $currentTime->format('m');

        $numOfDaysPerMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $numOfHolidayDays = $this->CountNumOfHolidayDays($request, $numOfDaysPerMonth, $month, $year);
        $numOfWorkDays = $numOfDaysPerMonth - $numOfHolidayDays;
        $numOfWorkedDays = count($request->user()->attendence_report()->whereYear('day', $year)->whereMonth('day', $month)->get());
        $data['percentage'] = (int) (($numOfWorkedDays / $numOfWorkDays) * 100);
        $data['count'] = $numOfWorkedDays;
        return $data;
    }

    private function CountNumOfHolidayDays($request, $numOfDaysPerMonth, $month, $year)
    {
        $NumOfHolidayDays = 0;
        // $counted=[];
        $Company = $request->user()->company;

        // $exception_holidays = $Company->exception_holidays()->whereMonth('date_from', $month)->whereYear('date_from', $year)->get();

        $exception_holidays = $Company->exception_holidays()->where(function ($query) use ($month, $year) {
            $query->whereMonth('date_from', $month)->whereYear('date_from', $year);
        })->orWhere(function ($query) use ($month, $year) {
            $query->whereMonth('date_to', $month)->whereYear('date_to', $year);
        })->get();

        for ($day = 1; $day <= $numOfDaysPerMonth; $day++) {
            $holiday_is_counted = false;
            //count_fixed_holidays

            $date = date_create();
            $created_day = date_date_set($date, $year, $month, $day);
            $slug_day = date_format($created_day, "D");
            if ($companyHolidays = $Company->holidays) {

                $holidayDays = json_decode($companyHolidays->day);

                foreach ($holidayDays as $key => $value) {
                    # code...
                    if (Str::startsWith($key, Str::lower($slug_day))) {
                        $NumOfHolidayDays++;
                        $holiday_is_counted = true;
                        // array_push(  $counted,date_format($created_day, "Y-m-d"));
                        break;
                    }

                }
            }

            //count_exception_holidays
            if ($holiday_is_counted) {
                continue;
            }
            $slug_day = date_format($created_day, "Y-m-d");
            foreach ($exception_holidays as $holiday) {
                $date_from = date_create($holiday->date_from);
                $date_to = date_create($holiday->date_to);
                $slug_month_from = date_format($date_from, "m");
                $slug_month_to = date_format($date_to, "m");
                if ($slug_month_from != $month) {
                    $date = date_create();
                    $created_day = date_date_set($date, $year, $month, 01);
                    $holiday->date_from = date_format($created_day, "Y-m-d");
                } elseif ($slug_month_to != $month) {
                    $date = date_create();
                    $created_day = date_date_set($date, $year, $month, 31);
                    $holiday->date_to = date_format($created_day, "Y-m-d");
                }

             if(($slug_day>=$holiday->date_from)&&($slug_day<=$holiday->date_to)){
                $NumOfHolidayDays++;
                // array_push(  $counted,date_format($created_day, "Y-m-d"));
                break;
             }
            }

        }

        return $NumOfHolidayDays;
    }

}
