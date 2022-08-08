<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Outdoor;
use App\Models\Visits_type;
use App\Models\Company;
use App\Models\User;
use App\Models\Client;
use App\Models\Branch;
use Validator;
use Carbon\Carbon;
use App\Models\Notifications_log;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
class OutdoorController extends BaseController
{
    //
    function index($subdomain,Request $request){
      
        $company=$this->company;

        $manger_branch_id= $this->branch_id;
        $manger_department_id= $this->department_id;
        $users=User::where('company_id',$company->id)->where('users.id', '!=' , Auth::user()->id)->get();
        $branchs=Branch::where('company_id', $company->id)->get();
        $visit_types=visits_type::where('company_id',$company->id)->get();
         $clients=Client::select('clients.*','client_types.name as client_type_name')->join('client_types','client_types.id','=','clients.client_type_id')->where('clients.company_id', $company->id)->get();
        if(isset($_GET['notify__id'])) $outdoor=$_GET['notify__id'];else $outdoor=null;
        $now = Carbon::now();

        $departments=Department::where('company_id',$company->id)
        
                                ->Where(function($query) use ($manger_department_id){
                                       
                                        if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                             $query->where('departments.id',$manger_department_id);
                                       
                                  })
                               ->get();
        $month=$now->month;
        /*$outdoors=Outdoor::select('outdoors.*','users.name as username','clients.name as client_name','clients.address as client_address')
                      ->join('users','users.id', '=', 'outdoors.user_id')
                      ->leftJoin('clients','clients.id','=', 'outdoors.customer_id')
                      ->join('visits_types','visits_types.id', '=', 'outdoors.visit_type_id')
                      
                      ->where('outdoors.company_id',$company->id)
                    
                       ->Where(function($query2) use ($outdoor,$manger_branch_id,$manger_department_id) {
                               if($outdoor!=null){
                                  $query2->Where('outdoors.id',$outdoor);  
                               }
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query1->where('users.branch_id',$manger_branch_id);
                               if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                     $query1->where('users.department_id',$manger_department_id);
                        })*/
                        /*->orWhere(function($query1) use ($company,$outdoor) {
                              if($outdoor==null){
                                    $query1->Where('customer_id',null);
                                    $query1->Where('outdoors.company_id',$company->id);
                              }

                                
                        })*/
                    /*  ->whereMonth('outdoors.created_at',$month)
                      ->paginate(15);
        $clients=Client::select('clients.*','client_types.name as client_type_name')->join('client_types','client_types.id','=','clients.client_type_id')->where('clients.company_id', $company->id)->get();
        return view('outdoors.index',['outdoors'=>$outdoors,'users'=>$users,'visit_types'=>$visit_types,'clients'=>$clients,'branchs'=>$branchs]);
  */
          
        if($this->roles['name']=="manger") {
          
          $manger_branch_id= Auth::user()->branch_id;
          $manger_department_id= Auth::user()->department_id;
        }else{
          $manger_branch_id=$manger_department_id='all'  ;
        }
        $search=$request->all();
      // print_r($search); exit;
        if(isset($search['visit_type']))$visit_type=$search['visit_type'];else $visit_type='all';
        if(isset($search['department'])) $department=$search['department'];else $department='all';
        if(isset($search['branch']))  $branch=$search['branch']; else $branch='all'; 
        if(isset($search['employee_name'])&&$search['employee_name']!='null' )$employee_name=$search['employee_name']; else $employee_name='all';
        if(isset($search['customer_id']))$client=$search['customer_id'];else $client='all';
        if(isset($search['created_by']))$created_by=$search['created_by']; else $created_by='all';
        if(isset($search['status']))$status=$search['status']; else $status='all';
        if(isset($search['date']))$from=$search['date']; else $from=Carbon::now()->format('Y')."-".$month."-".'1';
        $to=$search['to']??Carbon::now();
     
       // $to=$search['to']?$search['to']:'all';
        $company=$this->company;
        $users=User::where('company_id',$company->id)->where('users.active',1)
             ->where('users.bassma',1)->get();
        $visit_types=visits_type::where('company_id',$company->id)->get();
        $outdoors=array();
         
       // if(($employee_name!='all')||( $from!='all')||($status!='all')||( $client!='all')){
            $outdoors=Outdoor::select('outdoors.*','users.name as username','clients.name as client_name','visits_types.name as visit_type_name','departments.title as dep_title','branches.title as branch_title')
                            ->join('users','users.id', '=', 'outdoors.user_id')
                            ->join('visits_types','visits_types.id', '=', 'outdoors.visit_type_id')
                             ->leftjoin('clients','clients.id', '=', 'outdoors.customer_id')
                             ->join('departments', 'departments.id', '=', 'users.department_id')
                             ->join('branches', 'branches.id', '=', 'users.branch_id') 
                            ->where('outdoors.company_id',$company->id)
                            ->Where(function($query1) use ($employee_name) {
                                if($employee_name!='all'){
                                    $query1->Where('users.id',$employee_name);
                                }
                            })
                              
                            ->Where(function($query) use ($created_by,$status,$from,$to,$visit_type,$department,$branch,$client,$manger_branch_id,$manger_department_id,$month) {
                      
                                if($status!='all'){
                                    $query->where('outdoors.status',$status);
                                }
                                if($client!='all'){
                                    $query->where('outdoors.customer_id',$client);
                                }
                                if($created_by!='all'){
                                    $query->where('outdoors.created_by',$created_by);
                                }
                              //  if($from=='all')
                                         $query->whereDate('outdoors.created_at','>=' ,$from);
                              //  if($to!='all'){
                                        
                                    $query->whereDate('outdoors.created_at','<=' ,$to);
                                //}
                                if($visit_type!='all'){
                                    $query->where('outdoors.visit_type_id','=' ,$visit_type);
                                }
                                if($department!='all')
                                    $query->where('users.department_id',$department);
                                if($branch!='all')
                                    $query->where('users.branch_id',$branch);
                                
                      
                               /* if($to!='all'){
                                    $query->where('outdoors.date_to','<=' ,$to);
                                }*/
                               // if($from!='all')
                                 //   $query->where('outdoors.date','=',$from);
                                    
                                               
                                if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                    $query->where('users.branch_id',$manger_branch_id);
                                if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                    $query->Where('users.department_id',$manger_department_id);
                                       
                  
                                })
                               ->where('users.active',1)
                               ->where('users.bassma',1)
                             ->orderBy('outdoors.date','desc')   
                             ->paginate(15)
                             ->appends('search',$request->all());
      /* } else{
                           $outdoors=Outdoor::select('outdoors.*','users.name as username','clients.name as client_name')
                                              ->join('users','users.id', '=', 'outdoors.user_id')
                                              ->leftJoin('clients','clients.id','=', 'outdoors.customer_id')
                                              ->join('visits_types','visits_types.id', '=', 'outdoors.visit_type_id')
                                              
                                              ->where('outdoors.company_id',$company->id)
                                             // ->orWhere('customer_id',null)
                                               ->Where(function($query) use ($status,$from,$client,$created_by,$manger_branch_id,$manger_department_id) {
                      
                                                    if($status!='all'){
                                                        $query->where('outdoors.status',$status);
                                                    }
                                                    if($client!='all'){
                                                        $query->where('outdoors.customer_id',$client);
                                                    }
                                                    if($created_by!='all'){
                                                        $query->where('outdoors.created_by',$created_by);
                                                    }
                                                   /* if($to!='all'){
                                                        $query->where('outdoors.date_to','<=' ,$to);
                                                    }*/
                        /*  if($from!='all')
                                                        $query->where('outdoors.date','=', $from);
                                                   if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                        $query->where('users.branch_id',$manger_branch_id);
                                                   if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                        $query->Where('users.department_id',$manger_department_id);
                                       
                  
                               
                                                })
                                                ->orderBy('outdoors.date','desc')
                                              ->paginate(15);
       } */
                     
        if($request->ajax())
        return view('outdoors.search',['departments'=>$departments,'outdoors'=>$outdoors,'users'=>$users,'visit_types'=>$visit_types,'search'=>$search,'subdomain'=>$subdomain]);
        else
          return view('outdoors.index',['departments'=>$departments,'outdoors'=>$outdoors,'users'=>$users,'visit_types'=>$visit_types,'clients'=>$clients,'branchs'=>$branchs,'search'=>$search,'subdomain'=>$subdomain]);
  
      }
    //}

 /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
      public function store ($subdomain,Request $request)
      {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            //'date_from' => 'required',
            'date' => 'required',
            'customer_id' => 'required',
           /* 'adress' => 'required',
            'add_lat' => 'required',
            'add_lang' => 'required',*/
            'visit_type_id' => 'required',
            'user_id' => 'required',
            'branch' => 'required',
           ]);
           $outdoor=$request->all(); 
           //print_r($outdoor); exit;
          if ($validator->passes()) {
    
                $company=$this->company;
               // $visit=Outdoor::create(array('company_id'=>$company->id,'title'=>$outdoor['title'],'description'=>$outdoor['description'],'user_id'=>$outdoor['user_id'],'adress'=>$outdoor['adress'],'date'=>$outdoor['date'],'lati'=>$outdoor['add_lat'],'longi'=>$outdoor['add_lang'],'status'=>'delivered','visit_type_id'=>$outdoor['visit_type_id'],'customer_id'=>$outdoor['customer_id']))->get();
                foreach($outdoor['customer_id'] as $customer_id){
                    $client= Client::where('id',$customer_id)->first();
                    $visit=Outdoor::create(array('company_id'=>$company->id,'title'=>$outdoor['title'],'description'=>$outdoor['description'],'user_id'=>$outdoor['user_id'],'adress'=>$client['address'],'date'=>$outdoor['date'],'lati'=>$client['lati'],'longi'=>$client['longi'],'status'=>'delivered','visit_type_id'=>$outdoor['visit_type_id'],'customer_id'=>$customer_id))->get();
                    if(!is_null($visit)) {
                        $notfy=array('title'=>'visit added','message'=> "new visit added",'company_id'=>$company->id,'notify_from'=>Auth::user()->id,'notify_to'=>$visit[0]->user_id,'data_id'=>$visit[0]->id,'type'=>"add_visit");
                        Notifications_log::create($notfy); 
                       
                    }
                }
                 // toastr()->success(trans('trans.data_add_successfly'));
                return response()->json(['success'=>'Added new records.']);
               
        }
        // else return with error message
        else {
            
            return response()->json(['error'=>$validator->errors()->all()]);
      
        }
   
  
      }
    
      public function edit($subdomain,$id){
        $outdoor=Outdoor::select('outdoors.*','users.name as user_name','clients.name as client_name','clients.branch_id')->where('outdoors.id',$id)->join('users','users.id','=','outdoors.user_id')->leftjoin('clients','clients.id','=','outdoors.customer_id')->get();
      // print_r($outdoor); exit;
        return response()->json($outdoor);
      }
      public function edit_client($subdomain,$id){
        $outdoor=Outdoor::select('outdoors.customer_id','outdoors.id','clients.name as client_name','clients.id as client_id','outdoors.rate')->where('outdoors.id',$id)->leftjoin('clients','clients.id','=','outdoors.customer_id')->get();
       
        return response()->json($outdoor);
      }
      public function update($subdomain,Request $request, $id){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'date' => 'required',
           // 'date_to' => 'required',
            'customer_id' => 'required',
            'user_id' => 'required',
         /*   'adress' => 'required',
            'add_lat' => 'required',
            'add_lang' => 'required',*/
            'visit_type_id' => 'required',
             'branch' => 'required',
           ]);
           $outdoor=$request->all(); 
          
          if ($validator->passes()) {
            $company=$this->company;
            $outdoor=$request->all();
            //$visit=array('company_id'=>$company->id,'user_id'=>$outdoor['user_id'],'title'=>$outdoor['title'],'description'=>$outdoor['description'],'adress'=>$outdoor['adress'],'date'=>$outdoor['date'],/*'date_to'=>$outdoor['date_to'],*/'lati'=>$outdoor['add_lat'],'longi'=>$outdoor['add_lang'],'visit_type_id'=>$outdoor['visit_type_id'],'customer_id'=>$outdoor['customer_id']);
            if($request['old_customer']!=$request['customer_id']){
                 $client= Client::where('id',$outdoor['customer_id'])->first();
                 $visit=array('company_id'=>$company->id,'user_id'=>$outdoor['user_id'],'title'=>$outdoor['title'],'description'=>$outdoor['description'],'adress'=>$outdoor['adress'],'date'=>$outdoor['date'],/*'date_to'=>$outdoor['date_to'],*/'lati'=>$client['lati'],'longi'=>$client['longi'],'visit_type_id'=>$outdoor['visit_type_id'],'customer_id'=>$outdoor['customer_id']);
            }else{
                 $visit=array('company_id'=>$company->id,'user_id'=>$outdoor['user_id'],'title'=>$outdoor['title'],'description'=>$outdoor['description'],'date'=>$outdoor['date'],'visit_type_id'=>$outdoor['visit_type_id'],'customer_id'=>$outdoor['customer_id']);  
            }
            Outdoor::where('id',$id)->update($visit);
            
             $notfy=array('title'=>'visit updated','message'=> "visit updated",'company_id'=>$company->id,'notify_from'=>Auth::user()->id,'notify_to'=>$visit['user_id'],'data_id'=>$id,'type'=>"update_visit");
              Notifications_log::create($notfy); 
            return response()->json(['success'=>'updated.']);
          }
            return response()->json(['error'=>$validator->errors()->all()]);
          
  
      }
     
        public function update_client($subdomain,Request $request,$id){
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
           
           ]);
           $outdoor=$request->all(); 
          
          if ($validator->passes()) {
            $company=$this->company;
            $outdoor=$request->all();
            $visit=array('customer_id'=>$outdoor['customer_id']);
        //print_r($visit);
             Outdoor::where('id',$id)->update($visit);
            
             //$notfy=array('title'=>'visit updated','message'=> "visit updated",'company_id'=>$company->id,'notify_from'=>Auth::user()->id,'notify_to'=>$visit['user_id'],'data_id'=>$id,'type'=>"update_visit");
              //Notifications_log::create($notfy); 
            return response()->json(['success'=>'updated.']);
          }
            return response()->json(['error'=>$validator->errors()->all()]);
          
  
      }
      
      
       /**
       * Add Rate
       * $id ,Request rate
       * return json msg
       */
          
        public function update_rate($subdomain,Request $request,$id){
            
            $validator = Validator::make($request->all(), [
                'rate' => 'required',
               
               ]);
               $outdoor=$request->all(); 
              
              if ($validator->passes()) {
                $company=$this->company;
                $outdoor=$request->all();
                $visit=array('rate'=>$outdoor['rate']);
            //print_r($visit);
                 Outdoor::where('id',$id)->update($visit);
                
                 //$notfy=array('title'=>'visit updated','message'=> "visit updated",'company_id'=>$company->id,'notify_from'=>Auth::user()->id,'notify_to'=>$visit['user_id'],'data_id'=>$id,'type'=>"update_visit");
                  //Notifications_log::create($notfy); 
                return response()->json(['success'=>'updated.']);
              }
                return response()->json(['error'=>$validator->errors()->all()]);
              
  
      }
      /**
       * Delete row from outdoors
       */

      public function delete($subdomain,Request $request)
      {
         Outdoor::where('id',$request->id)->delete();
          return back()->with('success', 'Delete successfully.');
         
      }
      public function outdoor_search(Request $request,$subdomain){
        
        if($this->roles['name']=="manger") {
          
          $manger_branch_id= Auth::user()->branch_id;
          $manger_department_id= Auth::user()->department_id;
        }else{
          $manger_branch_id=$manger_department_id='all'  ;
        }
        $search=$request->all();
      // print_r($search); exit;
        $employee_name=$search['employee_name']?$search['employee_name']:'all';
        $client=$search['customer_id']?$search['customer_id']:'all';
        $created_by=$search['created_by']?$search['created_by']:'all';
        $status=$search['status']?$search['status']:'all';
        $from=$search['date']?$search['date']:'all';
       // $to=$search['to']?$search['to']:'all';
        $company=$this->company;
        $users=User::where('company_id',$company->id)->get();
        $visit_types=visits_type::where('company_id',$company->id)->get();
        $outdoors=array();
         
        if(($employee_name!='all')||( $from!='all')||($status!='all')||( $client!='all')){
            $outdoors=Outdoor::select('outdoors.*','users.name as username','clients.name as client_name')
                            ->join('users','users.id', '=', 'outdoors.user_id')
                            ->join('visits_types','visits_types.id', '=', 'outdoors.visit_type_id')
                             ->leftjoin('clients','clients.id', '=', 'outdoors.customer_id')
                            ->where('outdoors.company_id',$company->id)
                            ->Where(function($query1) use ($employee_name) {
                                if($employee_name!='all'){
                                    $query1->Where('users.id',$employee_name);
                                }
                            })
                              
                            ->Where(function($query) use ($created_by,$status,$from,$client,$manger_branch_id,$manger_department_id) {
                      
                                if($status!='all'){
                                    $query->where('outdoors.status',$status);
                                }
                                if($client!='all'){
                                    $query->where('outdoors.customer_id',$client);
                                }
                                if($created_by!='all'){
                                    $query->where('outdoors.created_by',$created_by);
                                }
                               /* if($to!='all'){
                                    $query->where('outdoors.date_to','<=' ,$to);
                                }*/
                                if($from!='all')
                                    $query->where('outdoors.date','=', $from);
                                    
                                               
                                if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                    $query->where('users.branch_id',$manger_branch_id);
                                if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                    $query->Where('users.department_id',$manger_department_id);
                                       
                  
                                })
                                 
                             ->paginate(15);
       } else{
                           $outdoors=Outdoor::select('outdoors.*','users.name as username','clients.name as client_name')
                                              ->join('users','users.id', '=', 'outdoors.user_id')
                                              ->leftJoin('clients','clients.id','=', 'outdoors.customer_id')
                                              ->join('visits_types','visits_types.id', '=', 'outdoors.visit_type_id')
                                              
                                              ->where('outdoors.company_id',$company->id)
                                              ->orWhere('customer_id',null)
                                               ->Where(function($query) use ($status,$from,$client,$created_by,$manger_branch_id,$manger_department_id) {
                      
                                                    if($status!='all'){
                                                        $query->where('outdoors.status',$status);
                                                    }
                                                    if($client!='all'){
                                                        $query->where('outdoors.customer_id',$client);
                                                    }
                                                    if($created_by!='all'){
                                                        $query->where('outdoors.created_by',$created_by);
                                                    }
                                                   /* if($to!='all'){
                                                        $query->where('outdoors.date_to','<=' ,$to);
                                                    }*/
                                                    if($from!='all')
                                                        $query->where('outdoors.date','=', $from);
                                                   if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                        $query->where('users.branch_id',$manger_branch_id);
                                                   if(isset($manger_department_id)&&($manger_department_id!='all')&&$manger_department_id!=NULL)
                                                        $query->Where('users.department_id',$manger_department_id);
                                       
                  
                               
                                                })
                                              ->paginate(15);
                        }               
  
        return view('outdoors.search',['outdoors'=>$outdoors,'users'=>$users,'visit_types'=>$visit_types]);
      }
}
