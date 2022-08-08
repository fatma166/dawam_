<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;   
use App\Models\Track_user;
USE App\Contracts\ErrorMessages;
use Illuminate\Support\Facades\Validator;

class TrackUserController extends Controller
{

    public function index(Request $request,$id=null){

      return $id?Track_user::find($id):Track_user::all();

    }
    

    public function store(Request $request){


 
        /*$req=Validator::make($request->all(),[
            "longi"=>"required",
            "lati"=>"required",
            "date"=>"required|date_format:Y-m-d H:i:s",
        ]);

        if($req->fails()){   
           return response()->json($req->errors(), 400);
        }
        $validated_data=$req->validated();
        $validated_data["user_id"]=$request->user()->id;
      //  $validated_data["company_id"]=$request->user()->company->id;
        $validated_data["data"]=$request->data;
        $validated_data["longi"]=$request->longi;
        $validated_data["lati"]=$request->lati;
        Track_user::create($validated_data);

        return response()->json(["msg"=>"success"], 200);
        
        */
        $data= json_decode($request->data);
       
        $user_id=$request->user()->id;

        foreach($data as $key =>$track){
            $validated_data["user_id"]=$user_id;
            $validated_data["date"]=$track->date;
            $validated_data["longi"]=$track->longi;
            $validated_data["lati"]=$track->lati;
            $result= Track_user::create($validated_data);
            
            if( empty($result) ){  
             return response()->json(['msg' => ErrorMessages::TRACK_STORE_CREATE_ERROR], 400);
            }
        }

        return response()->json(["msg"=>"success"], 200);
    }

}
