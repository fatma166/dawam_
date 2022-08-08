<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Company;

class CompanyController extends Controller
{

    public function Index(Request $request){
        if(!$company=$request->user()->company){
            return response(["you have not company yet"],204);

         }
       return $company;
    }

    public function Create(Request $request){

        $user=$request->user();
        if($user->company){
         return response(["you have already company"],422);
        }
        $req = Validator::make($request->all(), [

            'title' => 'required|string|min:12|max:50|unique:companies',
           ]);

        if($req->fails()){
            return response()->json($req->errors()->toJson(), 400);
        }
        $company=Company::create($req->validated());
        $company->User()->save($user);
        return $company;
 }


    public function Edit(Request $request){


        if(!$company=$request->user()->company){
            return response(["you have not company yet"],204);

         }

        $req = Validator::make($request->all(), [

            'title' => 'string|min:12|max:50|unique:companies',
           ]);

        if($req->fails()){
            return response()->json($req->errors()->toJson(), 400);
        }

        $company->title=$request->title??$company->title;
        $company->save();

        return response(["update success"],201);
 }

    //
}
