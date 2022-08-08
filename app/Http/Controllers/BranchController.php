<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Company;
use App\Models\branch;


class BranchController extends Controller
{

    public function Index(Request $request){
        if(!$company=$request->user()->company){
            return response(["you have not company yet"],204);

         }
       return $company->branches;


    }

    public function Create(Request $request){

        if(!$company=$request->user()->company){
            return response(["you have not company yet"],204);

         }


        $req = Validator::make($request->all(), [

            'title' => 'required|string|min:12|max:50|unique:branches',
            'lati' => 'required|string',
            'longi' => 'required|string',
           ]);

        if($req->fails()){
            return response()->json($req->errors()->toJson(), 400);
        }
        $branch=new branch();
        $branch->title=$request->title;
        $branch->lati=$request->lati;
        $branch->longi=$request->longi;

        $company->branches()->save($branch);

        return $branch;

    }

    public function Edit(Request $request){


    }
    //
}
