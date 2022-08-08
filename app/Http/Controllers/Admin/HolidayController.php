<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use  App\Models\Holiday;
use App\Models\ExceptionHolidays;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Validator;
class HolidayController extends BaseController
{
    //
    public function exception_holiday_index($subdomain){
         $company=$this->company;
        $exceptionholiday= ExceptionHolidays::where('company_id',$company->id)->orderBy('exception_holidays.created_at','desc')->get(); 

         return view('holiday.exception_holidays',array('exception_holidays'=> $exceptionholiday,'subdomain'=>$subdomain));
     }
   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exception_holiday_create($subdomain)
    {
        //
        return view('holiday/exception_holidays');

    }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function exception_holidays_store (Request $request,$subdomain)
     {
        $req=Validator::make($request->all(),[
            'title'              =>      'required',
            'date_from'             =>      'required',
            'date_to'          =>      'required',

        ]);
        // print_r($request->all());
        
        if ($req->passes()) {
            $company=$this->company;
            $input=array('title'=>$request->title,'date_from'=>$request->date_from,'date_to'=>$request->date_to,'company_id'=> $company->id);
            $ex_holiday=ExceptionHolidays::create($input);
        
            if(!is_null($ex_holiday)) {
                
                return response()->json(['success'=> 'Added successfully.']);
            }


        }else{
            return response()->json(['error'=>$req->errors()->all()]);
        }

 
     }
      
         /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
      public function exception_holidays_edit($subdomain,REQUEST $request)
      {
          $id=$request->id;
        
          $ex_holiday=ExceptionHolidays::where('id', $id)->first();
          return response()->json(['ex_holiday'=>$ex_holiday]);
          
  
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
     public function exception_holidays_update($subdomain,Request $request, $id)
     {
        $req=Validator::make($request->all(),[
            'title'              =>    'required',
            'date_from'             => 'required',
            'date_to'          =>      'required',

        ]);
        // print_r($request->all());
        
        if ($req->passes()) {
            $ex_holiday['title']=$request['title'];
            $ex_holiday['date_from']=$request['date_from'];
            $ex_holiday['date_to']=$request['date_to'];
            ExceptionHolidays::where('id',$id)->update($ex_holiday);
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
     public function exception_holidays_delete($subdomain,Request $request)
     {
        ExceptionHolidays::where('id',$request->id)->delete();
        
     }
     public function fixed_holidays_index($subdomain){
        $company=$this->company;
        $fix_holiday=Holiday::where('company_id',$company->id)->first();

        if(!empty($fix_holiday))$fixed_exist=1;else $fixed_exist=0;
       
        $day_str="";
        if(!empty($fix_holiday)){
            $day_arr= json_decode($fix_holiday->day);
            $day_str="";
            foreach($day_arr as $day=>$status){
                $day_str.=','.__('trans.'.$day);
            }
            $day_str=substr($day_str,1);
       }
        return view('holiday/fixed_holiday',['fixed_holiday'=>$fix_holiday,'day_str'=>$day_str,'fixed_exist'=>$fixed_exist,'subdomain'=>$subdomain]);

     }
    /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
      public function fixed_holidays_store ($subdomain,Request $request)
      {
           $validator = Validator::make($request->all(), [

            'day' => 'required',
           
        ]);
        if(!$validator->passes())
        return response()->json(['error'=>$validator->errors()->all()]); 
       // $days=$request->All(); 
       // print_r($days); exit;
     // echo  json_encode($days['day']);
        
       // exit;                              
        $days=$request->all(); 
         
        $company=$this->company;

        $fixed_holiday=array('day'=>json_encode($days['day']),'company_id'=>$company->id);
        $fix_holiday=Holiday::create($fixed_holiday);
      
       
         if(!is_null($fix_holiday)) {
              
                return response()->json(['success'=> ' added successfully.']);
         }
         // else return with error message
         else {
            
             return back()->with('error','messages.error');
         }
 
  
      }
            /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
      public function fixed_holidays_edit($subdomain,$id)
      {
        
          $fix_holiday=Holiday::where('id', $id)->first();
          //print_r($fix_holiday);exit;
          return response()->json(['fix_holiday'=>$fix_holiday]);

      }
 
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function fixed_holidays_update($subdomain,Request $request, $id)
     {
      //  print_r($request->all());
         //$fix_holiday['title']=$request['title'];
         //ExceptionHolidays::where('id',$id)->update($ex_holiday);
        // 
     
             
           $validator = Validator::make($request->all(), [

            'day' => 'required',
           
        ]);
        if(!$validator->passes())
        return response()->json(['error'=>$validator->errors()->all()]);    
              
        $company=$this->company;
        $fixed_holiday=array('day'=>json_encode($request['day']),'company_id'=>$company->id);
           Holiday::where('id',$id)->update($fixed_holiday);
           return response()->json(['success'=>'updatefixed-holidays']);
     }
            /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
      public function fixed_holidays_delete($subdomain,Request $request)
      {
         Holiday::where('id',$request->id)->delete();
         
      }
}
