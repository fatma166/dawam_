<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Role;
use App\Models\Department;
use App\Models\Company;
use App\Models\Job;
use App\Models\Shift;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
class AdminUserController extends BaseController
{
/**
 *     public function __construct()
 *     {
 *          $class = 'users';
 *         parent::__construct($class);
 *     }
 */

    public function index($subdomain){
       $company_check=$this->company;
       $admin_user=User::where('company_id',$company_check->id)->orderBy('created_at','asc')->first();
      
       $users= User::join('branches','branches.id','=','branch_id')->join('jobs','jobs.id','=','users.job_id')->select('users.*','branches.id as branch_id','branches.title as branch_title','jobs.id as job_id','jobs.title as job_title')->where('users.id', '!=' , Auth::user()->id)->where('users.company_id',$company_check->id)->where('users.role_id',1)->get(); 
  
       $branchs=Branch::where('company_id', $company_check->id)->get();
      
      // $roles=Role::where('company_id',$company_check->id)->get();
      
       $shifts=Shift::where('company_id',$company_check->id)->get();
       $departments=Department::where('company_id', $company_check->id)->get();
        return view('admin.edit',array('admin_user'=>$admin_user,'users'=>$users,'branchs'=>$branchs,'departments'=>$departments,'shifts'=>$shifts,'type'=>'admin','subdomain'=>$subdomain));
    }
  


}
