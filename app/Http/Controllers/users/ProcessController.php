<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;   
use App\Models\User_process;
use Illuminate\Support\Facades\Validator;
USE App\Contracts\ErrorMessages;
class ProcessController extends Controller
{

    public function index(Request $request,$id=null){

      return $id?User_process::find($id):User_process::all();

    }
    

    public function store(Request $request){


       
        $data= json_decode($request->data);
       
        $user_id=$request->user()->id;
      /*  $req=Validator::make($request->all(),[
            "type"=>"required",
           
            "date"=>"required|date_format:Y-m-d H:i:s",
        ]);*/

       /* if($req->fails()){   
           return response()->json($req->errors(), 400);
        }*/
        foreach($data as $key =>$process){
            $validated_data["user_id"]=$user_id;
            
            $validated_data["date"]=$process->date;
            $validated_data["type"]=$process->type;
            $validated_data["title"]=$process->title;
            $result= User_process::create($validated_data);
            
            if( empty($result)){  
             return response()->json(['msg' => ErrorMessages::PROCESS_STORE_CREATE_ERROR], 400);
            }
        }
      /*  $validated_data=$req->validated();
        $validated_data["user_id"]=$request->user()->id;
        $validated_data["company_id"]=$request->user()->company->id;
        $validated_data["data"]=$request->data;
        $validated_data["type"]=$request->type;
        $validated_data["title"]=$request->title;*/
       

        return response()->json(["msg"=>"success"], 200);
    }

}
