<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User_log;
use App\Models\Branch;
use App\DataTables\User_logDataTable;
class LogsController extends BaseController
{
   
    
    


    public function viewLogs($subdomain,User_logDataTable $datatable){

      $branches=$this->company->branches;
    
     
      return $datatable->with("company",$this->company)->render('logs.index',compact("branches",'subdomain'));
      

    }

    public function delete($subdomain,Request $request,$id){
       $log=User_log::find($id);
       $log->delete();
        if($request->ajax()){
            return response()->json(["status"=>"success"], 200);
        }
        return redirect()->back();

    }
}
