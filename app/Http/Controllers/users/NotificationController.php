<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notifications_log;
use Illuminate\Support\Facades\Validator;
USE App\Contracts\ErrorMessages;
class NotificationController extends Controller
{
    //
    public function Index(Request $request,$id=null){

         
        $req = Validator::make($request->all(),[
            'status' => 'in:seen,delivered|nullable',
          ]);

        if ($req->fails()) {
            return response()->json(/*$req->errors()*/['msg' => ErrorMessages::NOTIFICATION_INDEX_STATUS_VALIDATION_ERROR], 422);
        }

        if($id){
         return   $request->user()->notifications()->find($id);
        }elseif($request->status){
         return   $request->user()->notifications()->where("status",$request->status)->orderBy("created_at","desc")->get();
        }
       

       return $request->user()->notifications;

    }

    public function ChangeState(Request $request,$id){

           $notification=$request->user()->notifications()->find($id);
           if($notification){
               $notification->status="seen";
               $notification->save();
           }
           
           $data["msg"]="success";
            return response()->json($data, 200);

    }

}
