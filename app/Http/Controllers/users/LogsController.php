<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User_log;
use Illuminate\Support\Facades\Validator;
USE App\Contracts\ErrorMessages;
class LogsController extends Controller
{

    public function index(Request $request,$id=null){

      return $id?User_log::find($id):User_log::all();

    }

    public function store(Request $request){

        $req=Validator::make($request->all(),[
            "action"=>"required",
            "description"=>"required",
            "data"=>"required",
            "datetime"=>"required|date_format:Y-m-d H:i:s",
        ]);

        if($req->fails()){
           return response()->json(/*$req->errors()*/['msg' =>ErrorMessages::LOGS_STORE_VALIDATION_ERROR], 400);
        }
        $validated_data=$req->validated();
        $validated_data["user_id"]=$request->user()->id;
        $validated_data["company_id"]=$request->user()->company->id;

        $validated_data["data"]=json_encode($request->data);

        User_log::create($validated_data);

        return response()->json(["msg"=>"success"], 200);
    }

}
