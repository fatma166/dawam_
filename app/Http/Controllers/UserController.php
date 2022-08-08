<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\User;
use App\Models\Branch;
use App\Models\Job;
use App\Models\Attendance;
use App\Models\ExceptionHolidays;
use App\Models\Holiday;
use App\Models\Leave_request;
use App\Models\Task;
use App\Models\Outdoor;
use App\Models\Department;
use App\Models\Shift;
use App\Traits\RandomToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Traits\MacChecker;
use App\Library\NotificationManager;
use App\Traits\Uploader;
use App\Library\Error;
USE App\Contracts\ErrorMessages;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    use RandomToken,MacChecker,Uploader;
    public function __construct()
    {
    }

    /**
     * Get a JWT via given credentials.
     */

    public function login(Request $request)
    {
        
        $req= Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|string|min:5',
            'mac' => 'required|min:12',
            'mob_name' => 'required',

        ]);
            
  
         if ($req->fails()) 
        {
           
            $messages=$req->messages();
           
           
                 if ($messages->has('username')){
                      
                        return response()->json(['msg' => ErrorMessages::USER_LOGIN_VALIDATION_USERNAME_ERROR], 422);
                  } elseif ($messages->has('password')) {
                        
                          return response()->json(['msg' => ErrorMessages::USER_LOGIN_VALIDATION_PASSWORD_ERROR], 422);
                  }elseif ($messages->has('mac')){
                           
                            return response()->json(['msg' => ErrorMessages::USER_LOGIN_VALIDATION_MAC_ERROR], 422);
                  }elseif ($messages->has('mob_name')){
                       
                          return response()->json(['msg' => ErrorMessages::USER_LOGIN_VALIDATION_MOBILE_NAME_ERROR], 422);
                  }else{
                          
                           return response()->json(['msg' => ErrorMessages::USER_LOGIN_VALIDATION_ERROR], 422);
                  }

        }
        /**
         * check user sign in media
         */
        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $media = 'email';
        } else {
            $media = 'phone';
        }
        $credential[$media] = $request->username;
        $credential['password'] = $request->password;
        if (!$token = Auth::guard('api')->attempt($credential)) {

            return response()->json(['msg' => ErrorMessages::UNVALID_CREDENTIAL], 401);
        }

        $user_data=Auth::guard('api')->user();
        
        $user_data->saveDeviceInfo($request);
          if(!$user_data->active){
            
            return response()->json(['msg' =>ErrorMessages::ACCOUNT_INACTIVE], 401);

        }elseif(!$user_data->bassma){
            
             return response()->json(['msg' =>ErrorMessages::ACCOUNT_HAVE_NOT_BASSMA], 401);
        }
        $device_info["mac"]=$request->mac;
        $device_info["mob_name"]=$request->mob_name;
        $mac_check=$this->checkMac($user_data,$device_info);
        
        if ($mac_check["status"]=="new") {
            $notfy_type=$mac_check["pass"]?"access_by_new_mac":"change_mac";
            $request->request->add(["addtion_data"=>json_encode([$device_info])]);
            $NotificationManager=new NotificationManager();
            $NotificationManager->build($user_data->id,$notfy_type,$request);
            $NotificationManager->commit();
            if(!$mac_check["pass"]){
                
                return response()->json(['msg' => ErrorMessages::UNVALID_MAC_ADDRESS], 401);

            }

        };

        $user = $this->getUserData($user_data);


        if ($media = 'phone' && !$user->phone_isverified) {
            /**
             * creat activation_code
             *
             */
            $this->createOneTimeToken("phone", $user, "activate-phone");

        } elseif (!$user->email_isverified) {
            /**
             * creat activation_code
             *
             */
            $this->createOneTimeToken("email", $user, "activate-email");
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
            'user' => $user,

        ]);

    }

/**
 * reset password
 
    public function ResetPassword(Request $request, $token)
    {
        $req = Validator::make($request->all(), [

            'data' => 'required|string',
            'media' => 'required|string|in:email,phone',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($req->fails()) {
            return response()->json($req->errors()->toJson(), 400);
        }

        $user = User::where($request->media, $request->data)->first();
        if (!$user || !$user->tokens()->where("confirmed", false)->where("action", "reset-pass")->first()) {

            return response()->json(["user not found or invalid token"], 400);

        }

        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'message' => 'User password reset',

        ], 201);

    }
*/
    public function change_password(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first());
        } else {
            try {
                if ((Hash::check(request('old_password'), $user->password)) == false) {
                    $arr = array("status" => 400, "message" => "Check your old password.");
                } else if ((Hash::check(request('new_password'),$user->password)) == true) {
                    $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.");
                } else {
                    User::where('id', $user->id)->update(['password' => Hash::make($input['new_password'])]);
                    $arr = array("status" => 200, "message" => "Password updated successfully.");
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "message" => $msg);
            }
        }
        return \Response::json($arr);
    }
/**
 * verifyMopile
 */
    public function verifyMopile(Request $request, $token)
    {
        $user = Auth::user();
        if (!$token = $user->tokens()->where("confirmed", false)->where("action", "activate-phone")->first()) {
            return response()->json(["invalid token"], 400);

        }
        $user->phone_isverified = true;
        $user->save();
        return response()->json([
            'message' => 'User phone activated',

        ], 201);

    }

/**
 * verifyMopile
 */
    public function verifyEmail(Request $request, $token)
    {

        $user = Auth::user();

        if (!$token = $user->tokens()->where("confirmed", false)->where("action", "activate-email")->first()) {
            return response()->json(["invalid token"], 400);

        }
        $user->email_isverified = true;
        $user->save();
        return response()->json([
            'message' => 'User email activated',

        ], 201);

    }

    /**
     * resendActivationCode
     */

    public function resendActivationCode(Request $request)
    {
        $req = Validator::make($request->all(),
            [

                'data' => 'required|string',
                'media' => 'required|string|in:email,phone',
                "action" => 'in:reset-pass',

            ]);

        if ($req->fails()) {
            return response()->json($req->errors()->toJson(), 400);
        }

        if (!$user = User::where($request->media, $request->data)->first()) {

            return response()->json(["user not found"], 400);

        }

        if ($action = $request->action) {
        } elseif ($request->media == "phone") {
            $action = "activate-phone";
        } elseif ($request->media == "email") {
            $action = "activate-email";
        }

        $this->createOneTimeToken($request->media, $user, $action);

        return response()->json(['message' => '"activation code have send'], 200);

    }

    /**
     * Sign out
     */
    public function signout()
    {
        Auth::guard('api')->logout();
        return response()->json(['message' => 'User loged out']);

    }

    /**
     * Token refresh
     */
    public function refresh()
    {
        try {
            Auth::guard('api')->refresh();
        } catch (\Throwable $th) {
            return redirect()->route('unauth');

        }
    }

    /****
     *
     *
     *
     *
     *
     *
     *
     *users Routes
     *
     *
     *
     *
     *
     *
     */
    /**
     * User
     */
    public function user(Request $request)
    {
        $user =$this->getUserData($request->user()) ;


        $currentTime = new \DateTime('Africa/cairo');
        $year = $currentTime->format('Y');
        $month = $currentTime->format('m');
        $user['overtime'] = $user->attendence_report()->whereYear('day', $year)->whereMonth('day', $month)->sum("overtime");

        return $user;
    }

    /**
     * User
     */
    public function getUserShift(Request $request)
    {

          $data["assigned_shift"]=$request->user()->userShift;
        // $data["regular"]=$request->user()->company->shifts;
        $data["cus_shifts"]=$request->user()->userShifts()->whereDate('date',">=", Date("Y-m-d"))->where('active', 1)->get();

        return $data;
    }
    
      /**
     * return company for user
     */
    public function userData(Request $request)
    {

         $data["company"]=$request->user()->company;
         $data["branch"]=$request->user()->branch;
         return $data;

    }
    

    /**
     * CheckUserAttendStatus
     */
    public function CheckUserAttendStatus(Request $request)
    {
        $data["attend"] = false;
        $data["in"] = false;
        $data["out"] = false;

        /**
         * registiration  date
         */
        $date = new \DateTime('Africa/cairo');
        $today_date = $date->format('Y-m-d');

        if ($attend = $request->user()->attendences()->whereDate('created_at', $today_date)->first()) {
            $data["in"] = is_null($attend->time_in) ? false : true;
            $data["out"] = is_null($attend->time_out) ? false : true;
            $data["attend"] = ($data["in"] && !$data["out"]) ? true : false;
        }

        return $data;
    }

    /**
     * User
     */
    public function updateProfile(Request $request)
    {
        $req = Validator::make($request->all(),
            [

                'name' => 'string|nullable',
                'email' => 'email|unique:users,email|nullable',
                'phone' => 'digits_between:11,15|unique:users,phone|nullable',
                'avatar' => 'mimes:png,jpeg,jpg|nullable',
            ]);
            
            

     
        if ($req->fails()) {
            return response()->json(Error::format($req->errors()), 400);
        }
        
        $user = $request->user();
        
        if (!empty($request->email) && ($user->email != $request->email)) {
            $user->email = $request->email;
            $user->email_isverified = false;
        }
        if (!empty($request->phone) && ($user->phone != $request->phone)) {
            $user->phone = $request->phone;
            $user->phone_isverified = false;
        }
        if (!empty($request->name) && ($user->name != $request->name)) {
            $user->name = $request->name;

        }
           if (!empty($request->avatar)) {
            if(!is_null($user->avatar)){

                $this->delete_attachement($user->avatar);

            }
           $user->avatar=$this->upload_attachement($request->avatar);


        }

        $user->save();
        $data["msg"] = "update profile success";
        return response()->json($data, 200);
    }

    /**
     * Generate onr time token
     */

    protected function createOneTimeToken($media, $user, $action)
    {
        $token = $user->tokens()->where("confirmed", false)->where("action", $action)->get();

        if (!count($token)) {
            $token = new Token();
            $token->token = $this->generateToken(6);
            $token->media = $media;
            $token->action = $action;
            $token = $user->tokens()->save($token);
        }

        /**
         *  send activation_code
         */
        return $token;
    }

    private function getUserData($user)
    {
        $user_branch = Branch::find($user->branch_id);
        $user_job = Job::find($user->job_id);
       
        $user->job_title = $user_job->title;
        
        $user->branch_title = $user_branch->title;
        $user->branch_address = $user_branch->adress;
        return $user;
    }
    
    
    public function getUserDetail(){
        $user = Auth::user();
        $user_branch = Branch::find($user->branch_id);
        $user_job = Job::find($user->job_id);
        $user_detail=array();
        $user_detail['company_allow_distance'] =$user->company->distance;
        $user_detail['job_title'] = $user_job->title;
        $user_detail['target_location_check'] =$user_job->target_location_check;
         $user_detail['outdoor_without_attend'] =$user_job->outdoor_without_attend;
        $user_detail['branch_title'] = $user_branch->title;
        $user_detail['longi'] = $user_branch->longi;
        $user_detail['lati']= $user_branch->lati;
        return($user_detail);
    }
    
    
    public function profile(){
           $user = Auth::user();
           $now = Carbon::now();
           $month=$now->month;
           $year=$now->year;
           $date_from=Carbon::now()->format('Y')."-".$month."-"."1";
           $date_to=Carbon::now()->format('Y')."-".$month."-".Carbon::now()->daysInMonth;
           
           $this->getAbsent_attendance($user,$month,$year,$date_from,$date_to);
          

             $data['late_count']=Attendance::where('user_id',$user->id)->distinct((DB::raw('DATE(created_at)')))         
                                                              ->whereMonth('attendances.created_at', '=', $month)                                                                 
                                                              ->where('attendances.description','LIKE', '%'."late".'%')->where('status','Attendance_discount')->count();                                                       
             $data['outdoor_count']=Outdoor::select('outdoors.id')

                                         ->where('outdoors.user_id',$user->id)
                                         ->where('outdoors.status',"done")
                                         ->whereMonth('outdoors.date',$month)
                        
                                         ->whereYear('outdoors.date', '=', $year)
                                         ->count()  ;

            $data['task_count']=Task::where('tasks.user_id',$user->id)
                                         ->where("tasks.status","done")
                                         ->whereMonth('tasks.created_at',$month)
                        
                                         ->whereYear('tasks.created_at', '=', $year)->count();   
                                                        
            $data['leave_count']= Leave_request::where('leave_requests.user_id',$user->id)
                                                ->where('leave_requests.status','accepted')
                                                ->whereMonth('leave_requests.created_at',$month)
                                                ->whereYear('leave_requests.created_at', '=', $year) 
                                                ->count();
            $data['join_date']=$user->join_date;
            $user_branch = Branch::find($user->branch_id);
            $user_job = Job::find($user->job_id);
       
           $data['job'] = $user_job->title;
           $data['branch'] =$user_branch->title;
           $user_dep=Department::find($user->department_id);
           $data['department']=$user_dep->title;
           $data['email']=$user->email;
           $data['phone']=$user->phone;
           $shfits=Shift::find($user->shift_id);
           $data['shift_from']= $shfits['time_from'];
           $data['shift_to']= $shfits['time_to'];
           $data['shift_title']= $shfits['title'];
        
              return response()->json($data, 200);                                  
    }
    
    public function statistics(Request $request){
         //$type=$request->type??"attendance";
         $user = Auth::user();
         $now = Carbon::now();
         $month=$now->month;
         $year=$now->year;
         $date_from=Carbon::now()->format('Y')."-".$month."-"."1";
         $date_to=Carbon::now()->format('Y')."-".$month."-".Carbon::now()->daysInMonth;
        // if($type=="attendance"){
            $data= $this->getAbsent_attendance($user,$month,$year,$date_from,$date_to);
             $data['total_days']=Carbon::now()->daysInMonth;
             //return Response()->json($data,200);
        // }elseif($type=="outdoor"){
             $data['outdoor_done_count']=Outdoor::select('outdoors.id')
                                                 ->where('outdoors.user_id',$user->id)
                                                 ->where('outdoors.status',"done")
                                                 ->whereMonth('outdoors.date',$month)
                                                 ->whereYear('outdoors.date', '=', $year)
                                                 ->count();
             $data['outdoor_inprogress_count']=Outdoor::select('outdoors.id')
                                                     ->where('outdoors.user_id',$user->id)
                                                     ->where('outdoors.status',"inprogress")
                                                     ->whereMonth('outdoors.date',$month)
                                                     ->whereYear('outdoors.date', '=', $year)
                                                     ->count();

             $data['outdoor_all']=Outdoor::select('outdoors.id')
                                                     ->where('outdoors.user_id',$user->id)
                                                     ->whereMonth('outdoors.date',$month)
                                                     ->whereYear('outdoors.date', '=', $year)
                                                     ->count();
            // return Response()->json($data,200);                                       
             
       //  }elseif($type=="task"){
            $data['task_done_count']=Task::where('tasks.user_id',$user->id)
                                         ->where("tasks.status","done")
                                         ->whereMonth('tasks.created_at',$month)
                                         ->whereYear('tasks.created_at', '=', $year)->count();   
                                         
            $data['task_in_progress_count']=Task::where('tasks.user_id',$user->id)
                                                 ->where("tasks.status","in_progress")
                                                 ->whereMonth('tasks.created_at',$month)
                                
                                                 ->whereYear('tasks.created_at', '=', $year)->count();  
            $data['task_all']=Task::where('tasks.user_id',$user->id)
                            
                                 ->whereMonth('tasks.created_at',$month)
                
                                 ->whereYear('tasks.created_at', '=', $year)->count();  
           // return Response()->json($data,200);
        // }elseif($type=="leave"){
             $data['leave_count']= Leave_request::where('leave_requests.user_id',$user->id)
                                                ->where('leave_requests.status','accepted')
                                                ->whereYear('leave_requests.created_at', '=', $year) 
                                                ->count();
             $data['leave_pending_count']= Leave_request::where('leave_requests.user_id',$user->id)
                                                ->where('leave_requests.status','pending')
                                                ->whereYear('leave_requests.created_at', '=', $year) 
                                                ->count();
            $data['leave_refused_count']= Leave_request::where('leave_requests.user_id',$user->id)
                                                ->where('leave_requests.status','refused')
                                                ->whereYear('leave_requests.created_at', '=', $year) 
                                                ->count();
             $data['leave_all']=$data['leave_count']+$data['leave_pending_count']+$data['leave_refused_count'];
            // return Response()->json($data,200);
        // }
        // $data["msg"] = "invalid type";
         return response()->json($data, 200);
         
        
    }
    
    public function getAbsent_attendance($user,$month,$year,$date_from,$date_to){
         $data['attendance_count']=Attendance::where('user_id',$user->id)->distinct((DB::raw('DATE(created_at)')))         
                                                  ->whereMonth('attendances.created_at', '=', $month) 
                                                  ->whereYear('attendances.created_at', '=', $year)                                                                
                                                  ->where('status','!=','absent')->count();
                                                  
           $holiday=Holiday::where('company_id',$user->company_id)->first();
              
                if(isset($holiday->day)) {
                    $holiday_array=json_decode($holiday->day);
                   
                    $exception_holiday=0;
                        $holiday_=[];
                        foreach($holiday_array as $hol_key => $val){
                           
                           
                            $hol_key1 = [];
                            if($hol_key=="saturday")
                                $startDate = Carbon::parse($date_from)->next(Carbon::SATURDAY); // Get the first friday.
                            elseif($hol_key=="sunday"){
                                 $startDate = Carbon::parse($date_from)->next(Carbon::SUNDAY); // Get the first friday.
                            }
                             elseif($hol_key=="monday"){
                                 $startDate = Carbon::parse($date_from)->next(Carbon::MONDAY); // Get the first friday.
                            }
                            elseif($hol_key=="thursday"){
                                 $startDate = Carbon::parse($date_from)->next(Carbon::THURSDAY); // Get the first friday.
                            }
                            elseif($hol_key=="wednsday"){
                                 $startDate = Carbon::parse($date_from)->next(Carbon::WEDNSDAY); // Get the first friday.
                            }
                            elseif($hol_key=="tuesday"){
                                 $startDate = Carbon::parse($date_from)->next(Carbon::TUESDAY); // Get the first friday.
                            }
                            elseif($hol_key=="friday"){
                                 $startDate = Carbon::parse($date_from)->next(Carbon::FRIDAY); // Get the first friday.
                            }
                           // echo $startDate;
                            $endDate = Carbon::parse($date_to);
                            
                            for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {
                                $hol_key1[] = $date->format('Y-m-d');
                            }
                             
                            $holiday_=array_merge($hol_key1,$holiday_);
                        }
                       /// print_r($holiday_); exit;
                } else{
                        $holiday_= array();
                }
                   // print_r($holiday_); exit;

             $exception_holiday=count(ExceptionHolidays::whereDate('date_from','>=',$date_from)->whereDate('date_to','<=',$date_to)->where('company_id',$user->company_id)->get());
             $start_date =Carbon::parse($date_from);
             $end_date =Carbon::parse($date_to);
             $days = $start_date->diffInDays($end_date);
           
             $data['absent_count']= ($days+1)- $data['attendance_count']-$exception_holiday-count($holiday_);
             return($data);
    }

}
