<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Track_user;
use App\Models\Visits_type;
use App\Models\Company;
use App\Models\User;
use App\Models\Client;
use App\Models\Branch;
use Validator;
use Carbon\Carbon;
use App\Models\Notifications_log;
use Illuminate\Support\Facades\DB;
class TrackController extends BaseController
{
    ///
    function index($subdomain,Request $request){
     
        $company=$this->company;
        $manger_branch_id= $this->branch_id;
        $manger_department_id= $this->department_id;
        $users=User::where('company_id',$company->id)->where('users.id', '!=' , Auth::user()->id)->get();
        $branchs=Branch::where('company_id', $company->id)->get();
       
        $now = Carbon::now();
       
        $month=$now->month;

          
        if($this->roles['name']=="manger") {
          
          $manger_branch_id= Auth::user()->branch_id;
          $manger_department_id= Auth::user()->department_id;
        }else{
          $manger_branch_id=$manger_department_id='all'  ;
        }
        $search=$request->all()??$_GET;
     
      
        if(isset($search['employee_name'])&&$search['employee_name']!='null' )$employee_name=$search['employee_name']; else $employee_name='all';
      
        if(isset($search['date']))$from=$search['date']; else $from='all';
       
       // $to=$search['to']?$search['to']:'all';
        $company=$this->company;
        $users=User::where('company_id',$company->id)->get();
     
        $tracks=array();
        if($from=='all')  $from=Carbon::now(); 
         if(!empty($search)){
       // if(($employee_name!='all')||( $from!='all')||($status!='all')||( $client!='all')){
            $tracks=Track_user::select('track_users.*','users.name')
                            ->join('users','users.id', '=', 'track_users.user_id')
                            
                           
        
                            ->Where(function($query) use ($employee_name,$from,$manger_branch_id,$manger_department_id) {
                                if($employee_name!='all'){
                                    $query->Where('track_users.user_id',$employee_name);
                                }
                                if($from!='all')
                                    $query->whereDate('track_users.date','=',$from);
                                    
                                               
                                if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                    $query->where('users.branch_id',$manger_branch_id);
                                if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                    $query->Where('users.department_id',$manger_department_id);
                                       
                  
                             })
                             ->orderBy('track_users.date','desc')   
                             ->get()->toArray();
                
                  if(isset($tracks[0]['name'])){ $user_name=$tracks[0]['name'];
                  }else{
                    $user=User::where('company_id',$company->id)->where('id',$employee_name)->first();
                    $user_name=$user['name']."    -----   ".__('trans.no track availalbe');
                  }
                  
                
           }else{
                        $tracks=Track_user::select('track_users.*','users.name')
                            ->join('users','users.id', '=', 'track_users.user_id')
                          
                           
        
                            ->Where(function($query) use ($employee_name,$from,$manger_branch_id,$manger_department_id) {
                                if($employee_name!='all'){
                                    $query->Where('track_users.user_id',$employee_name);
                                }
                                if($from!='all')
                                    $query->whereDate('track_users.date','=',$from);
                                    
                                               
                                if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                    $query->where('users.branch_id',$manger_branch_id);
                                if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                    $query->Where('users.department_id',$manger_department_id);
                                       
                  
                             })
                             ->orderBy('track_users.date','desc')   
                               ->distinct('track_users.user_id')
                             ->get()->toArray();
                  $user_name=__('trans.all employee tracks');
           }
          
             
       // if(isset($tracks[0]['name'])) $user_name=$tracks[0]['name']; else $user_name=""; 
        if($request->ajax()){
      
          return view('track.search',['tracks'=>$tracks,'users'=>$users,'search'=>$search,'type'=>"ajax",'name'=>$user_name,'from'=>$from,'subdomain'=>$subdomain]);
       } else{
          return view('track.index',['tracks'=>$tracks,'users'=>$users,'branchs'=>$branchs,'search'=>$search,'name'=>$user_name,'type'=>"request",'subdomain'=>$subdomain]);
       }
      }
      
      
  }