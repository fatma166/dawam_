<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Visit_report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\outdoor_attendance;
use Illuminate\Support\Str;
use App\Library\Translator;
use App\Traits\Uploader;
use App\Models\outdoor_attendance_attachment;
use App\Traits\DistanceChecker;
use App\Models\Outdoor;
use App\Models\Referance_key;
use App\Library\Error;
use App\Library\NotificationManager;
use App\Library\ThirdApi;
USE App\Contracts\ErrorMessages;
class OutdoorController extends Controller
{
 use Uploader,DistanceChecker;
    //



    public function Index(Request $request, $id = null)
    {
            if ($id) {

            $outdoor = $request->user()->Outdoors()->find($id);
           return  $this->formatSingleOutdoor($outdoor);
        }

        $req = Validator::make($request->all(), [
            'from' => 'date_format:Y-m-d',
            'to' => 'date_format:Y-m-d|after_or_equal:from',
            "date"=>"date_format:Y-m-d"
            
        ]);

        if ($req->fails()) {
             $messages=$req->messages();
           if ($messages->has('from'))
            return response()->json(/*Error::format($req->errors())*/['msg' => ErrorMessages::OUTDOOR_INDEX_FROM_VALIDATION_ERROR], 422);
             if ($messages->has('to'))
            return response()->json(/*Error::format($req->errors())*/['msg' => ErrorMessages::OUTDOOR_INDEX_TO_BEFORE_FROM_DTAE_VALIDATION_ERROR], 422);
             if ($messages->has('date'))
            return response()->json(/*Error::format($req->errors())*/['msg' => ErrorMessages::OUTDOOR_INDEX_DATE_VALIDATION_ERROR], 422);
        
        }
        /**
         *Query Parameters
         */
     
          if($request->from && $request->to){

            $outdoors=$request->user()->Outdoors()->where('is_registered','=',0)->whereBetween('date',[$request->from,$request->to])->orderBy('created_at','desc')->get();
        
        }elseif($request->date){

            $outdoors=$request->user()->Outdoors()->where('is_registered','=',0)->whereDate('date',$request->date)->orderBy('created_at','desc')->get();

        }
        else{

            $outdoors = $request->user()->Outdoors()->where('is_registered','=',0)->orderBy('created_at','desc')->get();

        }





        return $this->formatOutdoors($outdoors);
    }

    public function Create(Request $request)
    {
        $req = Validator::make($request->all(), [
         "title"=>"required"
        ,"lati"=>"required"
        ,"longi"=>"required"
        ,"adress"=>"nullable"
        ,"description"=>"required"
        ,"visit_type_id"=>"required|exists:visits_types,id",
         'datetime'=>'date_format:Y-m-d H:i:s|nullable',
         'customer_id'=>'nullable|exists:clients,id',
        // 'client_key'=>'nullable',
       //  'unupload_count'=>'required'
         ]);

        if ($req->fails()) {

             return response()->json(Error::format($req->errors()), 422);
        
            
        }

        $datetime = $request->datetime?date_create($request->datetime):new \DateTime();

        $validated_data=$req->validated();
        $validated_data["company_id"]=$request->user()->company->id;
        $validated_data["user_id"]=$request->user()->id;
        $validated_data["created_by"]="employee";
        $validated_data["adress"]=$request->adress??ThirdApi::ParceCoordinate($validated_data['lati'],$validated_data['longi']);
        $validated_data["date"]=$datetime->format("Y-m-d");
        /*if(!is_null($request->client_key)){
           
           $referance= Referance_key::where('referance_key',$request->client_key)->first();
           if(empty($referance))
             return  response()->json($request->client_key, 233);
           $validated_data["customer_id"]=$referance['actual_id'];
          
        }else{
            $validated_data["customer_id"]=$request->customer_id; 
        }
         if((($request->unupload_count)-1)==0){
                 Referance_key::where('user_id',$request->user()->id)->where('type',"client")->delete();
         }*/
        $validated_data["customer_id"]=$request->customer_id; 
        $outdoor=Outdoor::create($validated_data);

        $NotificationManager=new NotificationManager();
        $NotificationManager->build($outdoor->id,"add_outdoor",$request);
        $NotificationManager->commit();

         $outdoor=Outdoor::find($outdoor->id);

         return response()->json($outdoor, 200);

    }



  public function create_v1(Request $request)
    {
        
        $req = Validator::make($request->all(), [
         "title"=>"required"
        ,"lati"=>"required"
        ,"longi"=>"required"
        ,"adress"=>"nullable"
        ,"description"=>"required"
        ,"visit_type_id"=>"required|exists:visits_types,id",
         'datetime'=>'date_format:Y-m-d H:i:s|nullable',
         'customer_id'=>'nullable|exists:clients,id',
         'client_key'=>'nullable',
         'unupload_count'=>'required'
         ]);

       /* if ($req->fails()) {

             return response()->json(Error::format($req->errors()), 422);
        
            
        }*/
        if($req->fails()) 
        {
          
            $messages=$req->messages();
           
               if($messages->has('avatar')){
                 
                          $data['msg'] = "empty avatar";
                           return response()->json(['msg' => ErrorMessages::OUTDOOR_CREATEV1_EMPTY_AVATAR_VALIDATION_ERROR], 422);
            
               }elseif($messages->has('title')){
                        $data['msg'] = "empty title";
                        return response()->json(['msg' => ErrorMessages::OUTDOOR_CREATEV1_EMPTY_TITLE_VALIDATION_ERROR], 422);
                  } elseif($messages->has('lati')||$messages->has('longi')){
                        $data['msg'] = "empty Location";
                        return response()->json(['msg' => ErrorMessages::OUTDOOR_CREATEV1_EMPTY_LOCATION_VALIDATION_ERROR], 422);
                  } elseif ($messages->has('description')) {
                          $data['msg'] = "empty description";
                          return response()->json(['msg' => ErrorMessages::OUTDOOR_CREATEV1_EMPTY_DESCRIPTION_VALIDATION_ERROR], 422);
                  }elseif ($messages->has('visit_type_id')){
                            $data['msg'] = "empty visit_type_id";
                            return response()->json(['msg' => ErrorMessages::OUTDOOR_CREATEV1_EMPTY_VISIT_TYPE_ID_VALIDATION_ERROR], 422);
                  }elseif ($messages->has('unupload_count')){
                          $data['msg'] = "empty unupload_count";
                          return response()->json(['msg' => ErrorMessages::OUTDOOR_CREATEV1_EMPTY_UPLOAD_COUNT_VALIDATION_ERROR], 422);
                  }elseif ($messages->has('datetime')){
                           $data['msg'] = "empty datetime";
                           return response()->json(['msg' => ErrorMessages::OUTDOOR_CREATEV1_EMPTY_DATETIME_VALIDATION_ERROR], 422);
                  }/*elseif ($messages->has('customer_id')){
                           $data['msg'] = "empty customer_id";
                           return response()->json($data, 422);
                  }elseif ($messages->has('client_key')){
                           $data['msg'] = "empty client_key";
                           return response()->json($data, 422);
                  }*/else{
                          $data['msg'] = "validation create_v1 error";
                          return response()->json(['msg' => ErrorMessages::OUTDOOR_CREATEV1_VALIDATION_ERROR], 422);
                  } /*elseif($messages->has('avatar')){
                    
                          $data['msg'] = "empty avatar";
                           return response()->json($data, 422);
            
              }else{
                $data['msg'] = "empty avatar";
                           return response()->json($data, 422);
              }*/
           
           
        }

        $datetime = $request->datetime?date_create($request->datetime):new \DateTime();

        $validated_data=$req->validated();
        $validated_data["company_id"]=$request->user()->company->id;
        $validated_data["user_id"]=$request->user()->id;
        $validated_data["created_by"]="employee";
        $validated_data["adress"]=$request->adress??ThirdApi::ParceCoordinate($validated_data['lati'],$validated_data['longi']);
        $validated_data["date"]=$datetime->format("Y-m-d");
        
         /* for offline mode*/
      
        if(is_array($request->client_key)&&!is_null($request->client_key)){
                   foreach($request->client_key as $cl_key){
                            $referance= Referance_key::where('referance_key',$cl_key)->first();
                           if(empty($referance))
                             return  response()->json(['msg' => ErrorMessages::OUTDOOR_CREATEV1_EMPTY_REFRENCEKEY_OFFLINE_VALIDATION_ERROR], 422);
                           //$validated_data["customer_id"]=$referance['actual_id'];
                             $request_customer=$referance['actual_id'];
                             $validated_data["customer_id"]=$request_customer;
                             $outdoor=Outdoor::create($validated_data);
                
                            $NotificationManager=new NotificationManager();
                            $NotificationManager->build($outdoor->id,"add_outdoor",$request);
                            $NotificationManager->commit();
                            $outdoor=Outdoor::find($outdoor->id);
                   }
        }elseif(!is_null($request->client_key)&&!is_array($request->client_key)){
                           $referance= Referance_key::where('referance_key',$request->client_key)->first();
                           if(empty($referance))
                             return  response()->json(['msg' => ErrorMessages::OUTDOOR_CREATEV1_EMPTY_REFRENCEKEY_OFFLINE_VALIDATION_ERROR], 422);
                           //$validated_data["customer_id"]=$referance['actual_id'];
                             $request_customer=$referance['actual_id'];
                             $validated_data["customer_id"]=$request_customer;
                             $outdoor=Outdoor::create($validated_data);
                
                            $NotificationManager=new NotificationManager();
                            $NotificationManager->build($outdoor->id,"add_outdoor",$request);
                            $NotificationManager->commit();
                            $outdoor=Outdoor::find($outdoor->id);
       }
      
     if((($request->unupload_count)-1)==0){
             Referance_key::where('user_id',$request->user()->id)->where('type',"client")->delete();
     }
         $request_customer=$request->customer_id;
         if(is_array($request_customer)&&!is_null($request_customer)){
                foreach($request_customer as $customer_id){
                    $validated_data["customer_id"]=$customer_id;
                    $outdoor=Outdoor::create($validated_data);
        
                    $NotificationManager=new NotificationManager();
                    $NotificationManager->build($outdoor->id,"add_outdoor",$request);
                    $NotificationManager->commit();
                    $outdoor=Outdoor::find($outdoor->id);
                }
                
    
            
         }elseif(!is_array($request_customer)&&!is_null($request_customer)){
                $validated_data["customer_id"]=$request_customer;
                $outdoor=Outdoor::create($validated_data);
    
                $NotificationManager=new NotificationManager();
                $NotificationManager->build($outdoor->id,"add_outdoor",$request);
                $NotificationManager->commit();
                $outdoor=Outdoor::find($outdoor->id); 
         }

        // $data['msg']="secusses";
         return response()->json($outdoor, 200);

    }
    
    
    public function Count(Request $request)
    {
          return count($request->user()->Outdoors()->where('status','done')->get());
    }

    public function Register(Request $request, $id)
    {


        $req = Validator::make($request->all(), [
            'longi' => 'required',
            'lati' => 'required',
            'type' => 'required|in:in,out',
            'avatar' => 'nullable|image|mimes:png,jpeg,jpg',
            'is_fake' => 'required|boolean',
            'address' => 'required',
            'datetime'=>'date_format:Y-m-d H:i:s'


        ]);

        if ($req->fails()) {
            return response()->json($req->errors(), 422);
        }


        if (!$outdoor = $request->user()->Outdoors()->find($id)) {
            return response(["no content"], 422);

        }








        $UserCompany=$request->user()->company;

        if($request->is_fake&&!$UserCompany->fake_check){
            $data['msg']="Fake Location";
            return response()->json($data, 422);
        }
   /**
   * checkRegisterLocation in or out field
    */
        $is_in_target=$this->checkRegisterLocation($outdoor,$request);
        if(!$is_in_target){
            $data['msg']="Un valid Location";
            return response()->json($data, 422);
        }

        /**
         * check dublicate checkin or check out
         */
          /**
         * in code
         *check duplicate registiration
         */
        $userProcess = $request->type == 'in' ? 'time_in' : 'time_out';
        if ($outdoor->outdoor_attendances()->whereNotNull($userProcess)->first()) {
            $data['msg'] = 'you Already check' . $request->type;
            return response()->json($data, 200);

        }

        /**
         * check user if check in before check out
         */
        //attendence equal checkin attendance data or null
   if($userProcess=='time_out'){

      if(!$outdoor_attendances=$outdoor->outdoor_attendances()->whereNotNull("time_in")->first()){

        $data['msg'] = 'must check in first';
        return response()->json($data, 422);
        }
    }
        // $currentTime = new \DateTime('Africa/cairo');
        $currentTime = $request->datetime?date_create($request->datetime):new \DateTime();
       
        $registirationTime = $currentTime->format('Y-m-d H:i:s');
        $formated_registirationTime_As_dueDate = $currentTime->format('Y-m-d');

        $due_date = $outdoor->date;
        
        

        switch ($request->type) {
            case 'in':
               
                $outdoor->status='inprogress';
                $outdoor->save();

                $outdoor_attendances = new outdoor_attendance();
                $outdoor_attendances->user_id=$request->user()->id;
               if($request->datetime){

                    $outdoor_attendances->created_at = $registirationTime;

                    }
                break;
            case 'out':

            
                $outdoor->status='done';
                $outdoor->save();

                $NotificationManager=new NotificationManager();
                $NotificationManager->build($outdoor->id,"end_outdoor",$request);
                $NotificationManager->commit();

                break;

        }


        if ($formated_registirationTime_As_dueDate > $due_date) {
            $status = 'late';
        } else {
            # code...
            $status ='attend';

        }

        $outdoor_attendances->$userProcess=$registirationTime;
        $outdoor_attendances->status=$status;
        $outdoor_attendances->is_recognized=0;
        $outdoor_attendances=$outdoor->outdoor_attendances()->save($outdoor_attendances);

        $request->request->add(['in_target' => $is_in_target]);

        $this->add_outdoor_attendance_attachement($outdoor_attendances,$request);

        $data['msg'] = 'registiration done ';
        return response()->json($data, 200);

    }
    
      /**
     * store registered outddor in offline mode
     */
     public function Store(Request $request, $id)
    {
        $req = Validator::make($request->all(), [
            'longi' => 'required',
            'lati' => 'required',
            'type' => 'required|in:in,out',
            'avatar' => 'nullable|image',
            // 'avatar' => 'nullable|image|mimes:png,jpeg,jpg',
            'is_fake' => 'required|boolean',
            'address' => 'nullable',
           
            'datetime'=>'required|date_format:Y-m-d H:i:s'


        ]);
//print_r($request->all()); exit;
      /*  if ($req->fails()) {
            $errors=$req->errors();
            if( $errors->has("avatar") && is_null( $request->file("avatar")->extension() ) ){
                $request->avatar=null;
            }else{

                return response()->json($errors, 422);

            }
        }
*/
        if($req->fails()) 
        {
          
            $messages=$req->messages();
           
               /*if($messages->has('avatar')){
                 
                          $data['msg'] = "empty avatar";
                           return response()->json($data, 422);
            
               } else*/if($messages->has('lati')||$messages->has('longi')){
                        $data['msg'] = "empty Location";
                        return response()->json(['msg' => ErrorMessages::OUTDOOR_STORE_VALIDATION_EMPTY_LOCATION_ERROR], 422);
                  } elseif ($messages->has('is_fake')) {
                          $data['msg'] = "empty is_fake";
                          return response()->json(['msg' => ErrorMessages::OUTDOOR_STORE_VALIDATION_EMPTY_ISFAKE_ERROR], 422);
                  }elseif ($messages->has('is_custom')){
                            $data['msg'] = "empty is_custom";
                            return response()->json(['msg' => ErrorMessages::OUTDOOR_STORE_VALIDATION_EMPTY_ISCUSTOM_ERROR], 422);
                  }elseif ($messages->has('shift_id')){
                          $data['msg'] = "empty shift_id";
                          return response()->json(['msg' => ErrorMessages::OUTDOOR_STORE_VALIDATION_EMPTY_SHIFT_ID_ERROR], 422);
                  }elseif ($messages->has('type')){
                          $data['msg'] = "empty type";
                          return response()->json(['msg' => ErrorMessages::OUTDOOR_STORE_VALIDATION_EMPTY_TYPE_ERROR], 422);
                  }elseif ($messages->has('datetime')){
                           $data['msg'] = "empty datetime";
                           return response()->json(['msg' => ErrorMessages::OUTDOOR_STORE_VALIDATION_EMPTY_DATETIME_ERROR], 422);
                  } /*elseif($messages->has('avatar')){
                    
                          $data['msg'] = "empty avatar";
                           return response()->json($data, 422);
            
              }else{
                $data['msg'] = "empty avatar";
                           return response()->json($data, 422);
              }*/
              else{
                 return response()->json(['msg' => ErrorMessages::OUTDOOR_STORE_VALIDATION_ERROR], 422);
              }
           
           
        }

        if (!$outdoor = $request->user()->Outdoors()->find($id)) {

            return response(['msg' => ErrorMessages::OUTDOOR_STORE_NO_FOUND_OUTDOOR_ERROR], 422);

        }

        $UserCompany=$request->user()->company;

        if($request->is_fake&&!$UserCompany->fake_check){
            $data['msg']="Fake Location";
            return response()->json(['msg' => ErrorMessages::OUTDOOR_STORE_FAKE_LOCATION_ERROR], 422);
        }
   /**
   * checkRegisterLocation in or out field
    */
        $is_in_target=$this->checkRegisterLocation($outdoor,$request);
 

        /**
         * check dublicate checkin or check out
         */
          /**
         * in code
         *check duplicate registiration
         */
        $userProcess = $request->type == 'in' ? 'time_in' : 'time_out';
        if ($outdoor->outdoor_attendances()->whereNotNull($userProcess)->first()) {
            $data['msg'] = 'you Already check' . $request->type;
            return response()->json($data, 200);

        }

        /**
         * check user if check in before check out
         */
        //attendence equal checkin attendance data or null
    if($userProcess=='time_out'){

      if(!$outdoor_attendances=$outdoor->outdoor_attendances()->whereNotNull("time_in")->first()){

        $data['msg'] = 'must check in first';
        return response()->json(['msg' => ErrorMessages::OUTDOOR_STORE_MUST_CHECK_IN_FIRST_ERROR], 422);
        }
    }
        // $currentTime = new \DateTime('Africa/cairo');
        $currentTime = date_create($request->datetime);

        $registirationTime = $currentTime->format('Y-m-d H:i:s');
        $formated_registirationTime_As_dueDate = $currentTime->format('Y-m-d');

        $due_date = $outdoor->date;



        switch ($request->type) {
            case 'in':

                $outdoor->status='inprogress';
                $outdoor->save();

                $outdoor_attendances = new outdoor_attendance();
                $outdoor_attendances->user_id=$request->user()->id;
                $outdoor_attendances->created_at = $registirationTime;


                break;
            case 'out':


                $outdoor->status='done';
                $outdoor->save();

                $NotificationManager=new NotificationManager();
                $NotificationManager->build($outdoor->id,"end_outdoor",$request);
                $NotificationManager->commit();

                break;

        }


        if ($formated_registirationTime_As_dueDate > $due_date) {
            $status = 'late';
        } else {
            # code...
            $status ='attend';

        }

        $outdoor_attendances->$userProcess=$registirationTime;
        $outdoor_attendances->status=$status;
        $outdoor_attendances->is_recognized=0;
        $outdoor_attendances=$outdoor->outdoor_attendances()->save($outdoor_attendances);

        $request->request->add(['in_target' => $is_in_target]);

        $this->add_outdoor_attendance_attachement($outdoor_attendances,$request);

        $data['msg'] = 'registiration done';
        return response()->json($data, 200);

    }

    public function RegisterTemplate(Request $request, $id)
    {


        if(!$outdoor= $request->user()->Outdoors()->find($id)){

            $data["msg"]="Outdoor Not Found";
        return response()->json(['msg' =>ErrorMessages::OUTDOOR_REGISTERTEMPLATE_OUTDOOR_NOT_FOUND_ERROR],422);

        }elseif($outdoor->status!="done"){
            $data["msg"]="Finish Your Outdoor First";
            return response()->json(['msg' => ErrorMessages::OUTDOOR_REGISTERTEMPLATE_FINISH_YOUR_OUTDOOR_FIRST_ERROR],422);

        }elseif($outdoor->is_registered){
            $data["msg"]="you registered before";
            return response()->json(['msg' => ErrorMessages::OUTDOOR_REGISTERTEMPLATE_YOU_REGISTERED_BEFORE_ERROR],422);
        }

        $data = [];
        try {
            $items = $request->input();
            $reports = [];
            foreach ($items["data"] as $key => $item) {
                $report = new Visit_report();
                $report->question_id = $item['question'];
                $report->answer_value = $item['answer'];
                $report->user_id = $request->user()->id;
                array_push($reports, $report);
                # code...
            }
               try{
                    $outdoor->report()->saveMany($reports);
                    $outdoor->is_registered=true;
                    $outdoor->save();
                }catch(\Illuminate\Database\QueryException $e){
                     $errorCode = $e->errorInfo[1];
                       if($errorCode == '1062'){
                       $data['msg'] = "you registered before";
                      return response()->json(['msg' => ErrorMessages::OUTDOOR_REGISTERTEMPLATE_YOU_REGISTERED_BEFORE_ERROR], 422);
                }
                }


        } catch (\Exception $e) {
            $data['msg'] = $e->getMessage();
            return response()->json(['msg' => ErrorMessages::OUTDOOR_REGISTERTEMPLATE_ERROR], 422);
        }
        $data['msg'] = 'success';
        return response()->json($data, 201);

    }
   /* public function History(Request $request)
    {



 $req = Validator::make($request->all(), [
            'from' => 'date_format:Y-m-d',
            'to' => 'date_format:Y-m-d|after_or_equal:from',
            "date"=>"date_format:Y-m-d"
            
        ]);

        if ($req->fails()) {
            return response()->json(Error::format($req->errors()), 400);
        }

  /**
         *Query Parameters
         */
     
       /* if($request->from && $request->to){

            $outdoors=$request->user()->Outdoors()->with("outdoor_attendances.outdoor_attendance_attachments")->where('is_registered','=',1)->whereBetween('date',[$request->from,$request->to])->orderBy('created_at','desc')->get();

        }elseif($request->date){

            $outdoors=$request->user()->Outdoors()->with("outdoor_attendances.outdoor_attendance_attachments")->where('is_registered','=',1)->whereDate('date',$request->date)->orderBy('created_at','desc')->get();

        }
        else{

            $outdoors=$request->user()->Outdoors()->with("outdoor_attendances.outdoor_attendance_attachments")->where('is_registered','=',1)->orderBy('created_at','desc')->get();

        }


         return  $this->formatOutdoors($outdoors);
    }*/
    public function History(Request $request)
    {



       $req = Validator::make($request->all(), [
            'from' => 'date_format:Y-m-d',
            'to' => 'date_format:Y-m-d|after_or_equal:from',
            "date"=>"date_format:Y-m-d"
            
        ]);

        if ($req->fails()) {
             $messages=$req->messages();
           if ($messages->has('from'))
            return response()->json(/*Error::format($req->errors())*/['msg' => ErrorMessages::OUTDOOR_HISTORY_FROM_VALIDATION_ERROR], 422);
             if ($messages->has('to'))
            return response()->json(/*Error::format($req->errors())*/['msg' => ErrorMessages::OUTDOOR_HISTORY_TO_BEFORE_FROM_DTAE_VALIDATION_ERROR], 422);
             if ($messages->has('date'))
            return response()->json(/*Error::format($req->errors())*/['msg' => ErrorMessages::OUTDOOR_HISTORY_DATE_VALIDATION_ERROR], 422);
        
        }

  /**
         *Query Parameters
         */
         //print_r($request->all()); exit;
         $client_id=$request->client_id??'all';
        if($request->from && $request->to){

            $outdoors=$request->user()->Outdoors()->with("outdoor_attendances.outdoor_attendance_attachments")->where('is_registered','=',1)->whereBetween('date',[$request->from,$request->to])->where(function($query) use($client_id){
                 if($client_id!='all')
                 $query->where('customer_id',$client_id);
                 })->orderBy('created_at','desc')->get();

        }elseif($request->date){

            $outdoors=$request->user()->Outdoors()->with("outdoor_attendances.outdoor_attendance_attachments")->where('is_registered','=',1)->whereDate('date',$request->date)->where(function($query) use($client_id){
                 if($client_id!='all')
                 $query->where('customer_id',$client_id);
                 })->orderBy('created_at','desc')->get();

        }
        else{

            $outdoors=$request->user()->Outdoors()->with("outdoor_attendances.outdoor_attendance_attachments")->where('is_registered','=',1)->where(function($query) use($client_id){
                 if($client_id!='all')
                 $query->where('customer_id',$client_id);
                 })->orderBy('created_at','desc')->get();

        }


         return  $this->formatOutdoors($outdoors);
    }


    /**
     * format outdoors
     */

     private function formatOutdoors($outdoors){

        $data=[];
        foreach ($outdoors as  $outdoor) {
            # code...

            array_push($data,$this->formatSingleOutdoor($outdoor));

        }

        return $data;
     }

      /**
     * format single outdoors
     */

     private function formatSingleOutdoor($outdoor){

        $outdoor['enddate']=Translator::translate($outdoor->date);

        

        if(isset($outdoor->outdoor_attendances)){
            $outdoor['time_in']=$outdoor->outdoor_attendances->time_in;
            $outdoor['time_out']=$outdoor->outdoor_attendances->time_out;
           foreach($outdoor->outdoor_attendances->outdoor_attendance_attachments as $attachment){


            switch($attachment->type){
                case "in":
                    $outdoor['in_address']=$attachment->address;
                    $outdoor['in_image']=$attachment->avatar;
                    break;
                case "out":
                    $outdoor['out_address']=$attachment->address;
                    $outdoor['out_image']=$attachment->avatar;
                    break;
            }
           }
           unset($outdoor->outdoor_attendances);

        }


        return $outdoor;

     }

/**
 * save outdoor_attendance attachements
 */

     private function add_outdoor_attendance_attachement($outdoor_attendances,$request)
      {
          

          $outdoor_attendance_attachment = new outdoor_attendance_attachment();

          $outdoor_attendance_attachment->lati =$request->lati;
          $outdoor_attendance_attachment->longi =$request->longi;
          $outdoor_attendance_attachment->type =$request->type;
          $outdoor_attendance_attachment->in_target =$request->in_target;
          $outdoor_attendance_attachment->is_fake =$request->is_fake;
          $outdoor_attendance_attachment->address =$request->address??ThirdApi::ParceCoordinate($request->lati,$request->longi);
          
          
          
           if($request->hasFile('avatar')){
               
               $image = $request->file('avatar');
               $image_url = $this->upload_attachement($image);
               
               $outdoor_attendance_attachment->avatar = $image_url;

            }
            
            
          $outdoor_attendances->outdoor_attendance_attachments()->save($outdoor_attendance_attachment);

      }





}
