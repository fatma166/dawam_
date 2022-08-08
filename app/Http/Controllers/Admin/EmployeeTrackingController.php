<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\EmployeeTrackDatatable;
class EmployeeTrackingController extends BaseController
{
    //
    public function employeeTrack(EmployeeTrackDatatable $datatable,$subdomain){

      
  
       

        $branches=$this->company->branches;
        return $datatable->with("company",$this->company)->render('employee.tracking',compact("branches","subdomain"));
    
    
    }
    

}
