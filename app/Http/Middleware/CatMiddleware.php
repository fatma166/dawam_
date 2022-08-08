<?php


namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Models\Company;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class CatMiddleware {

    public function handle($request,Closure $next) {
        
          $roles=Auth::user()->role()->first();
       
         if ((Session::has('company'))|| ($roles['name']=="super_admin")){
            
              return $next($request);  
            }
         $company_id=Auth::user()->company_id;
        // $cat_id=Auth::user()->cat_id;
        $cat_id=Company::where('id',$company_id)->first('cat_id');
        $status=Company::where('id',$company_id)->first('status');
     
         $category=Category::where('id',$cat_id['cat_id'])->first();
       
         if(empty($category)){
             return redirect()->route('login',$request->subdomain)->with('error', __('trans.Please auth cat!!'));
         }
         if($request->subdomain!=$category['title']){
            return redirect()->route('login',$request->subdomain)->with('error', __('trans.Please auth cat!!'));
         }
         //check_active company
         if($status['status']==0){
             return redirect()->route('login',$request->subdomain)->with('error', __('trans.Please contact customer service to active account!!'));
         }
        
         return $next($request);    
              
             
    }

}