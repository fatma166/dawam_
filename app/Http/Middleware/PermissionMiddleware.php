<?php


namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Permission_role;
use App\Models\Permission;
use App\Models\Company;
//use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class PermissionMiddleware {

    public function handle($request,Closure $next) {
        
         $route_name=Route::currentRouteName();
       
         $role_id=Auth::user()->role_id;
         $company_id=Auth::user()->company_id;
        // $cat_id=Auth::user()->cat_id;
       /* $cat_id=Company::where('id',$company_id)->first('cat_id');
     
         $category=Category::where('id',$cat_id['cat_id'])->first();
       
         if(empty($category)){
             return redirect()->route('login',$request->subdomain)->with('error', __('trans.Please auth cat!!'));
         }
         if($request->subdomain!=$category['title']){
            return redirect()->route('login',$request->subdomain)->with('error', __('trans.Please auth cat!!'));
         }*/
          $roles=Auth::user()->role()->first();
         //DB::enableQueryLog();
         $key_id=Permission::SELECT('permissions.id')->where('key', 'like',$route_name)
                           ->join('category_permission','category_permission.permission_id','=','permissions.id')
                           ->Where(function($query) use ($company_id,$roles){
                                if ( ($roles['name']!="super_admin")){ 
                                             if(is_numeric($company_id)){
                                                $company_cat=Company::where('id',$company_id)->first('cat_id');
                                                 $query->where('category_permission.category_id',$company_cat['cat_id']);
                                             }
                                }     
                           })
                           ->first();
       
                                $query = DB::getQueryLog();
//print_r($query);exit;
        // print_r($key_id); exit;
         if(!empty( $key_id['id'])){
         $permissions=Permission_role::/*SELECT('permissions.key')->join('permission_roles','permission_roles.permission_id','=','permissions.id')*/
                                     
                                    
                                       where('permission_roles.role_id',$role_id)
                                      ->Where(function($query) use ($company_id){
                                       
                                            if(is_numeric($company_id))
                                            
                                             $query->where('permission_roles.company_id',$company_id);
                                            /* if(is_numeric($company_id)){
                                                $company_cat=Company::where('id',$company_id)->first('cat_id');
                                                 $query->where('category_permission.category_id',$company_cat['cat_id']);
                                             }*/
                                       
                                      })
        
         
                                     ->where('permission_roles.permission_id',$key_id['id'])->get()->toarray();
   
                           //  $query = DB::getQueryLog();
//print_r($query);exit;
     
    // print_r($permissions);
    // exit;
     }
          
      
          if ((!empty($permissions))||(Session::has('company'))|| ($roles['name']=="super_admin")){  
           
                   return $next($request);    
              }else{
                  return redirect()->back();
                 //  return redirect()->route('login')->with('error', __('trans.Please auth!!'));
              }
             
    }

}
