<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\User;
use App\Models\Notifications_log;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Models\Permission_role;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Branch;
use App\Models\Department;
class BaseController extends Controller
{
    //
    
    public    $company;
    protected $users;
    protected $class;
    protected $permission_;
    protected $branch_id;
    protected $department_id;
    protected $roles;
    
    /**
     * CONSTRACTOR 
     * RETURNS CONST DATA FOR ALL CONTROLLERS
     */
    public function __construct()
    {     
       //  $this->class=$class;
         //echo $this->class; exit;
        $this->branch= new Branch();
        $this->department= new Department();  
        $this->middleware(function ($request, $next) {
         //   print_r($request->all());
            //   $this->getPermission($this->class,Auth::user()->role_id);
               $roles=Auth::user()->role()->first();
               if(empty($roles))return redirect()->route('login')->with('error', __('trans.Please auth!!'));
               $this->roles=$roles; 
               if($roles['name']=="developer"||$roles['name']=="support"||$roles['name']=="accountant"||$roles['name']=="super_admin"||$roles['name']=="marketer"){
               
                   if(empty($this->company)){
                    
                     $this->company="all";
                     }
                   if ($request->session()->has('company')) {

                     $this->company=Company::select('companies.*')->where('id', $request->session()->get('company'))->first();
                   }
                   View::share('roles',$roles);
                }else{
                   $this->company=Company::select('companies.*')->join('users','users.company_id','=','companies.id')->where('users.id',Auth::user()->id)->first();
                    //  echo Auth::user()->role_id;
                    
                     if(!empty( $this->company)&& (Auth::user()->role_id != null)&&(Auth::user()->active==1)){
                       $this->users=User::where('company_id',$this->company->id)->get();
                       $notfys=Notifications_log::select('notifications_logs.*','users.avatar','users.name')->join('users', 'users.id', '=','notifications_logs.notify_from')->where('notifications_logs.company_id',$this->company->id)->where('status','=','delivered')->where('notifications_logs.created_by','user')->orderBy('created_at','desc')->take(8)->get();
                       View::share('notfys',$notfys);
                   
                               if($roles['name']=="manger") {
          
                              $this->branch_id= Auth::user()->branch_id;
                              $this->department_id= Auth::user()->department_id;
                            }else{
                              $this->branch_id== $this->department_id='all'  ;
                            }
                     
                        View::share('roles',$roles);  
                       
                   }else{
                     return redirect()->route('login')->with('error', __('trans.Please auth!!'));
                   }
               }
          return $next($request);
        });

    }
    /**
     * FOR SUPER ADMIN TO MAKE SESSION 
     * GO TO ANY COMPANY
     */
    
    public function companySet($subdomain,$id){
       // $this->setCompanyId($id);
        
        session(['company' => $id]); //exit;
        return response()->json(['success'=>'set company']);
        
    
    }
    
    /**
     * BACK TO SUPER ADMIN PANEL
     * 
     */
     public function allCompanyAdmin($subdomain,Request $request){
        $request->session()->forget('company');
        return response()->json(['success'=>'admin panel']);
        
     }
   /* public function setCompanyId($id){
        $this->company=$id;
       
    }
    public function getCompanyId(){
        return($this->company);
    }*/
    
  /*  protected function getPermission($class,$role_id){
        $route_name=Route::currentRouteName();
       // echo $route_name; 
       // echo $this->class;
       // echo $role_id;
        
      // exit; 
       // $role=Role::where('table_name',$class)->get(); 
        $permissions=Permission::SELECT('permissions.key')->join('permission_roles','permission_roles.permission_id','=','permissions.id')->where('permission_roles.role_id',$role_id)->where('permissions.table_name',$class)->get()->toarray();
        $perm= array();
        foreach($permissions as $permission){
           $perm[]=$permission['key'];
        }
        
 
        if(in_array($route_name,$perm)){
            return true;
        }  else{
            return false;
        }   
            
    }*/
    
    /**
     * SEARCH FOR COMPANY 
     * SELECT 2
     */
    public function selectCompanySearch($subdomain,Request $request)
    {
         
        $companies = [];

        if($request->has('q')){
            $search = $request->q;
            $companies =Company::select("id", "title")
            		->where('title', 'LIKE', "%$search%")
             	    //->where('company_id', $company->id)
            		->get();
        }
        return response()->json($companies);
   }
   
}
