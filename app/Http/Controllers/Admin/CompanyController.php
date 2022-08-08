<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;

use App\Models\Company;

use App\Models\User;
  
use App\Models\Branch;

use App\Models\Department;  
use App\Models\CompanyPlan;
use App\Models\Repesentative;
use App\Models\Plan;
use App\Models\Payments_log;
use App\Models\Zone;
use Validator;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
 /**
     * CONTROLLER CONTAINS BRANCH,DEPARTMENT &SUBSCRIBE FUNCTIONS
*/
class CompanyController extends BaseController

{
    /**
     * 

     * Display a listing of the company .

     *

     * @return array($company)

     */

    public function index(Request $request,$subdomain)

    {


        if($this->company!="all"){
            $company=$this->company;
            //  print_r($company); exit;
            
        }else{
           $company=Company::get(); 
           foreach($company as $index=>$comp){
               $company[$index]->total=User::where('company_id',$comp->id)/*->where('role_id','!=',1)*/->count(); 
            
           }
                 
                  // $company=Company::select(DB::raw('COUNT(users.id) as total'),'companies.*')->join('users','users.company_id','=','companies.id')->get(); 
                  
       }
        
               
           
            // print_r($company);exit;
        
              //$one_company_check=Company::join('users','users.company_id','=','companies.id')->where(array('users.id'=>Auth::user()->id,'role_id'=>1))->first();
        
             // $company= Company::where('id',$one_company_check['company_id'])->first();

      if(empty($company)){

     

         return view('company.company-list',array('company'=>$company,'check'=>'add','subdomain'=>$subdomain));

      }else{

         return view('company.company-list',array('company'=>$company,'check'=>'created_before','subdomain'=>$subdomain));

      }

    }


    /**
     * not uses

     * Show create.

     *

     * @return \Illuminate\Http\Response

     */

    public function create($subdomain)

    {

        return view('company.company',compact('subdomain'));

    }
    /**
     * CHANGE COMPANY STATUS
     * 
     */

    public function status(Request $request,$subdomain)
    {
           $company = $this->company;
        
        

            $company_update = Company::where('id', $request->id)->update(array('status' => $request-> status));
            if($company_update){
                return back()->with('success', ' status changed successfully.');
            } else
            {
                return back()->with('error', 'messages.error');
            }
       

    }

    /**

     * Store a newly  created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request,$subdomain)

    {
        //

        $request->validate([ 'title'=>'required']);



        $input=array('title'=>$request->title,'nearest_branch'=>$request['nearest_branch'],'distance'=>$request['distance'],'fake_check'=>$request['is_fake'],'target_location_check'=>$request['target_location_check'],'mac_check'=>$request['mac_check'],'add_client'=>$request['add_client']);

        $company=Company::create($input);

        if(!is_null($company)) {

            

            return response()->json(['success'=>'Added new records.']);

        }

        // else return with error message

        else {

            
             return response()->json(['success'=>'messages.same user register before']);

        }

    }
  /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id,$subdomain)

    {

        //

    }

       /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id,$subdomain)

    {

      //  return $id;
        $company=Company::where('id', $id)->first();
       // return $company;

        return response()->json(['company'=>$company]);    
       
    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update($subdomain,Request $request,$id)

    {
        
      //return $request;

    	$validator = Validator::make($request->all(), [

            'title' => 'required',
           
        ]);

        //print_r($request->all()); exit;

        if ($validator->passes()) {

             

            $company['title']=$request['title'];

            $company['nearest_branch']=$request['nearest_branch'];

            $company['distance']=$request['distance']?$request['distance']: 0;

            $company['fake_check']=$request['is_fake'];
             $company['min_time']=$request['min_time'];
             $company['logout_time']=$request['logout_time'];

            $company['target_location_check']=$request['target_location_check'];
            $company['mac_check']=$request['mac_check'];
            $company['add_client']=$request['add_client'];
            if(isset($request['company_logo'])&&!empty($request['company_logo'])&&$request['company_logo']!=null){
                 $company['logo']=$request['company_logo'];
            }

            $row=Company::where('id',$id)->update($company);
  
            if($row>0){
           // return redirect()->route('company_index');

           return response()->json(['success'=>'updated new records.']);
          }

        }

     

      //  return response()->json(['error'=>$validator->errors()->all()]);

       

    }



    /**
     * VIEW COMPANY PROFILE
     */

    public function profile($id,$subdomain){



        $company_data=Company::where('id',$id)->first();

        $total=User::select(DB::raw('COUNT(users.id) as total'))

                    ->where('users.company_id',$id)
                    ->where('users.id', '!=' , Auth::user()->id)
                    ->first();
        $count_employee=$total['total'];
        return view('company.profile',array('company_data'=>$company_data,'count'=>$count_employee));



    }


/**
 * STORE IMG FOR COMPANY
 */
    public function storeImage(Request $request,$subdomain)
    {
        //print_r($request->all());    
      // exit;
        $request->validate([
          'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = new Company;

        if ($request->file('file')) {
            $imagePath = $request->file('file');
            $company = $this->company;
            $imageName=$company->title.time().".".$request->file('file')->extension();    
            //$path = $request->file('file')->storeAs('img/company', $imageName.".".$request->file('file')->extension());
           
            $request->file->move(public_path('img/company'),$imageName);
        }  
           $path ='img/company/'.$imageName;

        return response()->json($path);
    }
/**
 * DELETE IMAGE
 */
    public function deleteImg($subdomain,Request $request)
    {
      Company::where('id',$request->del_img_id)->update(array('logo'=>'img/logo.png'));


        return response()->json('success');
    }
    /**
     * SELECT TIME ZONE  SELECT2 SEARCH
     */
   public function selectZoneSearch(Request $request,$subdomain)
    {
        // $company=$this->company;
         $zones = [];

        if($request->has('q')){
            $search = $request->q;
            $zones =Zone::select("zone_id", "zone_name")
            		->where('zone_name', 'LIKE', "%$search%")
             	   // ->where('company_id', $company->id)
            		->get();
        }
        return response()->json($zones);
   }

    /**
     * BRANCH

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function branch_index($subdomain,Request $request)

    {

          
        $company_check=$this->company;
          //$company_check=Company::join('users','users.company_id','=','companies.id')->where(array('users.id'=>Auth::user()->id,'role_id'=>1))->first();
         if( $company_check!="all"){
            $companies=array();
             $branch= Branch::select('*')->where('company_id', $company_check->id)->orderBy('branches.created_at','desc')->get();
          }else{
             $companies=Company::get()->toArray();
             $branch= Branch::select('branches.*','companies.title as company_title')->join('companies','companies.id','=','branches.company_id')->orderBy('branches.created_at','desc')->get();
          }
          $zones=DB::table("zone")->get()->toArray();
         
     
         return view('company.branch.branch-list',['branchs'=>$branch,'companies'=>$companies,'zones'=>$zones,'subdomain'=>$subdomain]);

      

    }



    /**
     * BRANCH CREATE

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function branch_create($subdomain)

    {

        //

        return view('company.branch.branch',compact('subdomain'));

        



    }

    

     /**
         * BRANCH EDIT

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function branch_edit($subdomain,REQUEST $request)

    {

        $id=$request->id;

      

        $branch=Branch::select('branches.*','zone.zone_name')->where('id', $id)->join('zone','zone.zone_id','=','branches.zone_id')->first();

        return response()->json(['branch'=>$branch]);

        



    }



    /**
     * BRANCH STORE

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function branch_store($subdomain,Request $request)

    {
        $company_check=$this->company;

        $req=Validator::make($request->all(),[

          //  'title'=>'required|unique:branches',
             'title'=>  Rule::unique('branches')->where(function ($query) use($company_check) {
                        return $query->where('company_id', $company_check->id);
               }),
            'adress'=>'required',

            'add_lat' => 'required',

            'add_lang'  =>'required',
            'zone_id'  =>'required',

         

        ]);

        

        if ($req->passes()) {

           // $company_check=Company::join('users','users.company_id','=','companies.id')->where(array('users.id'=>Auth::user()->id,'role_id'=>1))->first();

            
           
            if(isset($request->company_id)){
                $company_id=$request->company_id;   
            }else{
                $company_id=$company_check->id;
            }
           
            $input=array('title'=>$request->title,'adress'=>$request->adress,'zone_id'=>$request->zone_id,'company_id'=>$company_id,'longi'=>$request->add_lang,'lati'=>$request->add_lat);

        

            $branch=Branch::create($input);

            if(!is_null($branch)) {

                

                 return response()->json(['success'=>'Added new records.']);

            }

         

       }

       //return response()->json($req->errors()->toJson(), 400);

       return response()->json(['error'=>$req->errors()->all()]);

      

    }



    /**
     * BRANCH UPDATE

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function branch_update($subdomain,Request $request,$id)

    {

        //
        $company=$this->company;

        $req=Validator::make($request->all(),[

          //  'title'=>'required|unique:branches,title,'.$id,
          //   'title'=>'required|unique:branches,title,'.$id.',company_id,company_id,' .$company->id,
             'title'=>  Rule::unique('branches')->where(function ($query) use($company,$id) {
                        return $query->where('company_id', $company->id)->where('id','!=',$id);
}),
            'adress'=>'required',

            'edit_lang' => 'required',

            'edit_lat'  =>'required',

       

        ]);

        
    
        if ($req->passes()) {

        $branch['title']=$request['title'];

        $branch['adress']=$request['adress'];

        $branch['longi']=$request->edit_lang;

        $branch['lati']=$request->edit_lat;
        $branch['zone_id']=$request['zone_id'];
        Branch::where('id',$id)->update($branch);

        //return redirect()->route('branch_index');

         return response()->json(['success'=>'updated new records.']);

       }else{

           

            return response()->json(['error'=>$req->errors()->all()]);



       }

 

}



    

    /**
     * BRANCH DELETE

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function branch_delete($subdomain,Request $request)

    {





        Branch::where('id',$request->id)->delete();

        //return redirect()->route('branch_index');

    }
   /**
     * 
     * SEARCH BRANCH SELECT 2

     * Display the specified resource.

     *

     * @param  int  $REQUEST

     * @return \Illuminate\Http\Response

     */

    public function search_branch(Request $request,$subdomain){



       $search_term= $request->search;

 

       $branch= Branch::where('title','like',$search_term['term'].'%')->get();

       $result=array();

       foreach($branch as $index=>$value){

          

           $result['data']=array('id'=>$value->id,'title'=>$value->title);

       }

      // print_r($branch);exit;

       return response()->json($result);

    }

      /**
       * DEPART MENT INDEX

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function department_index($subdomain)

    {

      //print_r($company);exit;

       // $company_check=Company::join('users','users.company_id','=','companies.id')->where(array('users.id'=>Auth::user()->id,'role_id'=>1))->first();

       $company_check=$this->company;
        $companies=array();
          //$company_check=Company::join('users','users.company_id','=','companies.id')->where(array('users.id'=>Auth::user()->id,'role_id'=>1))->first();
       if( $company_check!="all"){
       

              $department=Department/*::join('branches','branch_id','=','departments.id')->*/::where('company_id',$company_check->id)->orderBy('departments.created_at','desc')->get();

      }else{
              $companies=Company::get()->toArray();
              $department=Department::select('departments.*','companies.title as company_title')->join('companies','companies.id','=','departments.company_id')->orderBy('departments.created_at','desc')->get();

      }
      
      return view('company.department.department-list',['departments'=>$department,'companies'=>$companies,'subdomain'=>$subdomain]);

    }



    /**
     * STORE DEPARTMENT

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function department_store($subdomain,Request $request)

    {
        $company_check=$this->company;
        $req=Validator::make($request->all(),[

           // 'title'=>'required'
             'title'=>  Rule::unique('departments')->where(function ($query) use($company_check) {
                        return $query->where('company_id', $company_check->id);
               })

        ]);

        

        if ($req->passes()) {
              
           
            if(isset($request->company_id)){
                $company_id=$request->company_id;   
            }else{
                $company_id=$company_check->id;
            }
           
           // $company_check=Company::join('users','users.company_id','=','companies.id')->where(array('users.id'=>Auth::user()->id,'role_id'=>1))->first();

            $company_check=$this->company;

            $request->validate([ 'title'=>'required']);

            $input=array('title'=>$request->title /*,'description'=>$request->description*/,'company_id'=> $company_id);

            $department=Department::create($input);

            if(!is_null($department)) {

                

                  return response()->json(['success'=>'Added new records.']);

            }

        

       }else{

           

        return response()->json(['error'=>$req->errors()->all()]);



       }

    }



    /**
     * UPDATE DEPARTMENT

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function department_update($subdomain,Request $request,$id)

    {
       
        $company_check=$this->company;
        $req=Validator::make($request->all(),[

            //'title'=>'required'
            'title'=>  Rule::unique('departments')->where(function ($query) use($company_check,$id) {
                        return $query->where('company_id', $company_check->id)->where('id','!=',$id);
               })
       

        ]);

        

        if ($req->passes()) {

        

            $department['title']=$request['title'];



            department::where('id',$id)->update($department);

            //return redirect()->route('department_index');

           
              return response()->json(['success'=>'updated successfully.']);

        }else{



                return response()->json(['error'=>$req->errors()->all()]);
 

        }

    }
    /**
     * DEPART MENT

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function department_edit($subdomain,REQUEST $request)

    {

        $id=$request->id;

      

        $depart=department::where('id', $id)->first();

        return response()->json(['department'=>$depart]);

    }
    
    
    
    /**
     * SUBSCRIBE COMPANY INDEX 
     * GET ALL COMPANY
     */
    public function company_subscribe($subdomain){

        if($this->company!="all"){
            $company=$this->company;

           }else{
           $company=Company::get(); 

        }
        
        $plans_month= DB::table('planes')->select('planes.*')->where('pay_type','month')->get();
        $plans_year= DB::table('planes')->select('planes.*')->where('pay_type','year')->get();
        
        if($company=="all"){
                 $company_plan=DB::table('company_plans')->join('companies','companies.id','=','company_plans.company_id')->select('company_plans.plan_id')->where('companies.id','=',$company->id)->first();
            if(isset($company_plan->plan_id)){
                $plan_id=$company_plan->plan_id;
            }else{
                $plan_id="";
            }
        }else{
            $company_plan=DB::table('company_plans')->select('company_plans.plan_id')->first();
            
            if(isset($company_plan->plan_id)){
                $plan_id=$company_plan->plan_id;
            }else{
                $plan_id="";
            }
        }


        return view('company.subscribe.subscriptions-company',array('plans_month'=> $plans_month,'plans_year'=>$plans_year,'company_plan_id'=>$plan_id,'subdomain'=>$subdomain));

    }
    
    
    /**
     * SHOW EDITED DATA FOR PLAN
     * EDIT PLAN 
     */
    public function plan_edit($subdomain,REQUEST $request){



        $id=$request->id;

        $plan=Plan::where('id', $id)->first();

        return response()->json(['plan'=>$plan]);


    }
    
    
    /**
     * UPDATE PLAN DATA
     */
    public function plan_update($subdomain,REQUEST $request,$id){
       // print_r($request->all());
        
         $req=Validator::make($request->all(),[

            'currency'=>'required',

            'price_user'=>'required', 

            'type' => 'required',
        ]);

        
    
        if ($req->passes()) {

            
            $plan['currency']=$request['currency'];
    
            $plan['price_user']=$request['price_user'];
            
            $plan['pay_type']=$request['type'];
            Plan::where('id',$id)->update($plan);
    
            //return redirect()->route('branch_index');
    
             return response()->json(['success'=>'updated new records.']);

       }else{

           

            return response()->json(['error'=>$req->errors()->all()]);



       }

        
    }



   /* public function subscribe_index(){

     $plans= DB::select('select * from plans')->get();

     

     return view('subscribe.subscriptions-company',array('plans'=>$plans));

    }*/
    
    
 
    /**
     * GET LAST SUBSCRIBE FOR EVERY COMPANY
     * 
     */

    public function subscribe_index($subdomain,Request $request){
           /* if($this->company!="all"){
               
                $company=$this->company;

            }else{
               $company=Company::get(); 
 
           }*/
        
         $repesentatives= DB::table('representatives')->select('*')->get();
         if($this->company!="all"){
            $company=$this->company;
            $plans= DB::table('planes')->select('*')->where('company_id','=',$company->id)->get();
            $company_plan_current=CompanyPlan::join('planes','planes.id','=','company_plans.plan_id')->where(array('company_plans.company_id'=>$company->id,'status'=>1))->first();
          
            $company_plan=CompanyPlan::where('company_id',$company->id)->get();
            return view('company.subscribe.subscribe_per_user',array('repesentatives'=>$repesentatives,'plans'=>$plans,'company_plans'=>$company_plan,'company_plan_current'=>$company_plan_current));
        }else{
            $search= $request->all();
            
            //$month=$search['month']; 
           // if(!empty($search['date_from']))
           //print_r($search); exit;
           if(!empty($search)){
             $date_from=$search['date_from']? $search['date_from']:"all";//Carbon::now()->format('Y')."-".$month."-".'1'; 
             $date_to=$search['date_to']? $search['date_to']:"all";//Carbon::now();
             $company_id= $search['company_id']? $search['company_id']:'all';
             $status=$search['status']? $search['status']:'all'; 
           }else{
             $date_from= $date_to= $company_id= $status="all";
           }
            

            $companies=Company::get(); 
            $plans= DB::table('planes')->select('*')->get();
            $company_plan=CompanyPlan::select('company_plans.*','company_plans.company_id as ref_comp','companies.title','companies.status as company_status','planes.pay_type','planes.price_user')
                                     ->join('companies','companies.id','=','company_plans.company_id')
                                     ->Where(function($query) use ($date_from,$date_to,$company_id,$status){
                                       if($company_id!='all')
                                                $query->where('company_plans.company_id',$company_id);
                                       if($status!='all')
                                                $query->where('company_plans.status',$status);
                                       if($date_from!='all')
                                                $query->where('company_plans.created_at',">=",$date_from);
                                       if($date_to!='all')
                                                $query->where('company_plans.created_at',"<=",$date_to);
                                     })
                                     ->join('planes','planes.id','=','company_plans.plan_id')
                                     
                                     ->orderBy('company_plans.created_at','desc')->get();/*where('company_id',$company->id)->*/
            if($request->ajax()){
          
                  return view('company.subscribe.subscriptions',array('plans'=>$plans,'company_plans'=>$company_plan,'companies'=>$companies,'type'=>"ajax",'subdomain'=>$subdomain));
            }else{
                  return view('company.subscribe.subscriptions',array('plans'=>$plans,'company_plans'=>$company_plan,'companies'=>$companies,'type'=>"non_ajax",'subdomain'=>$subdomain));
            }
        }

    }
    
    /**
     * CHANGE SUBSCRIBE STATUS
     * 
     */

     public function company_subscribe_change_status($subdomain,Request $request){
             $switch_status=$request['switch_status'];
             $switch_id=$request['switch_id'];
            
              if($switch_status=="true"){ 
                // print_r($request['switch_status']);
                $subscribe_=array('status'=>1);
                CompanyPlan::where('id',$switch_id)->update($subscribe_);
              }else{
                $subscribe_=array('status'=>0);
                CompanyPlan::where('id',$switch_id)->update($subscribe_);
              }
        
     }

/**
 * UPRADE SUBSCRIBE FOR COMPANY
 * 
 * 
 */
     public function company_subscribe_upgrade($subdomain,Request $request,$id){

                $inputs=$request->all();
                //print_r($inputs);
                $old_data=CompanyPlan::select('date_from','date_to','duration','salary')->where('id',$id)->first();
                //print_r($old_data); exit;
                //old
                $oldstart_date =Carbon::parse($old_data['date_from']);
                $oldend_date =Carbon::parse($old_data['date_to']);
                $olddiffdays = $oldstart_date->diffInDays($oldend_date); 
                
                $paidperday=$old_data['salary']/$olddiffdays;
                //echo $paidperday; exit;
                //new

                $newdiffdays =$oldstart_date->diffInDays($request['date_from']); 
             
                $update_salary=$paidperday*$newdiffdays;
                
                                  //50
                $differance_salary=$old_data['salary']-$update_salary;  //25
           
                $subscribe_=array('status'=>0,'date_to'=>$request['date_from'],'salary'=>$update_salary);
                CompanyPlan::where('id',$id)->update($subscribe_);
                
                $newstart_date =Carbon::parse($request['date_from']);
                if($inputs['type']=="month"){
                                    $end_date=Carbon::parse($request['date_from'])->addMonths($request->duration);
                                    $date_to=$end_date->format('Y-m-d');
                    }else{
                                    $end_date=Carbon::parse($request['date_from'])->addYears($request->duration);
                                    $date_to=$end_date->format('Y-m-d');  
                }
                $newend_date =Carbon::parse($date_to);
                $upgrade['salary']=$inputs['total']-$differance_salary;
                $upgrade['status']=1;
                $upgrade['paid']=1;
                $upgrade['duration']=$inputs['duration'];
                $upgrade['number_user']=$inputs['nmber_users'];
                $upgrade['date_from']=$inputs['date_from'];
                $upgrade['date_to']=$newend_date;
                $upgrade['plan_id']=$inputs['plan_id'];
                $upgrade['company_id']=$inputs['company_id'];
                CompanyPlan::create($upgrade);
              exit;
        
     }     
     public function company_subscribe_show($subdomain,Request $request,$id){
          
           $data=CompanyPlan::select('company_plans.*','planes.currency','planes.pay_type')->where('company_plans.id',$id)->join('planes','planes.id','=','company_plans.plan_id')->first();
            return response()->json(['subscribe'=>$data]);
        
     }
        /**

     * ADD  _subscribe.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function subscribe_store_userplan($subdomain,Request $request)

    {

        $req=Validator::make($request->all(),[ 

                
                'type'=>'required', 
                'duration'=>'required',
                'users'=>'required',
                'date_from'=>'required',  
              
                'currency'=>'required',
        
                  

        ]); 
        print_r($request->all());
        if ($req->passes()) {
            $company=$this->company;
            $date_from=$request->date_from;
            $end_date=Carbon::parse($date_from)->addMonths($request->duration);
            $end_date=$end_date->format('Y-m-d');
            //echo $end_date; exit;
            if($request->transaction_status=="success"){
                $status=1;
            }else{
                $status=0;
            }
            
            $input=array('company_id'=>$company->id,'number_user'=>$request->users,'status'=>$status,'duration'=>$request->duration,'date_from'=>$request->date_from,'plan_id'=>$request->plan_id,'salary'=>$request->total,'date_to'=>$end_date);
            $upgrade=CompanyPlan::create($input)->get();
           if($request->paymethod=="visa"){
                 $log=array('paid'=>$request->total,'pay_method'=>$request->type,'company_id'=>$company->id,'users_number'=>$request->users,'period_from'=>$request->date_from,'period_to'=>$end_date,'status'=>$status,'company_plan_id'=>$upgrade[0]['id']);
                 Payments_log::create($log)->get();
             }elseif($request->paymethod=="bank_convert"||$request->paymethod=="postal_convert"){
                $file_path="path";
                
                 
               $log=array('paid'=>$request->total,'pay_method'=>$request->type,'company_id'=>$company->id,'users_number'=>$request->users,'period_from'=>$request->date_from,'period_to'=>$end_date,'company_plan_id'=>$upgrade[0]['id']); 
               $payment= Payments_log::create($log)->get();
                Payment_attach::create(array('file_path'=>$file_path,'company_plan_id'=>$upgrade[0]['id']))->get();
                
             }else{
                 $log=array('paid'=>$request->total,'pay_method'=>$request->type,'company_id'=>$company->id,'users_number'=>$request->users,'period_from'=>$request->date_from,'period_to'=>$end_date,'representative_id'=>$request->rep_id); 
                 $new_log=Payments_log::create($log)->get();
                 $rep_data= Repersentative::where('id',$request->rep_id)->get();
                                  
                 Representative::update(array('collection_payment_ids'=>array_merge(json_decode($rep_data[0]->collection_payment_ids,$new_log[0]->collection_payment_ids))))->where('id',$request->rep_id);
                
             }
              
            return response()->json(['success'=>'added successfully.']);
        }else{
            return response()->json(['error'=>$req->errors()->all()]);
 

        }

    }
    
    
    /**
     * GET PLAN FOR COMPANY
     */
    public function getPlan($subdomain,$type,$currency){
        $plan= Plan::where(array('pay_type'=>$type,'currency'=>$currency))->first(); 
        
         return response()->json($plan);
    }
    
    public function subscribe_store_plan(Request $request){
        
        
    	$validator = Validator::make($request->all(), [

            'price_user' => 'required',
            'currency' => 'required',
            'type' => 'required',
           
        ]);

        // print_r($request->all()); exit;

        if ($validator->passes()) {

             
            $plan['name']="defualt";
            $plan['price_user']=$request['price_user'];

            $plan['currency']=$request['currency'];

            $plan['pay_type']=$request['type']?$request['type']: "month";

           $check_exist=Plan::where('pay_type',$request['type'])->first();
           if(!empty($check_exist)){
             Plan::where('id',$check_exist['id'])->update($plan);
           }else{
             Plan::create($plan)->get();
             }

           return response()->json(['success'=>'updated new records.']);

        }else{
           return response()->json(['error'=>$validator->errors()->all()]);  
        }

     

      //  return response()->json(['error'=>$validator->errors()->all()]);
       
    }
    
     /**
     * repersenrive_blance_set
     */  
    
    public function repersenrive_blance_set($subdomain,$id){
        
        CompanyPlan::update(array('status'=>1))->where('representative_id',$id);
        
        
    }
    
    
        /**

     * upgrade_subscribe.

     *NOT USE

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function upgrade_subscribe($subdomain,Request $request)

    {



        $company_plan_id=$request->id;

        $user_id=Auth::user()->id;

       // $company= Company::select('id')->where('user_id',$user_id)->first();

        $company=$this->company;

        $upgrade=CompanyPlan::where('company_id',$company->id)->update(['plan_id'=>$company_plan_id]);

        return($company->id);

    }



     /**

     * upgrade_subscribe.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function subscribe_pay($subdomain,Request $request,$plan,$company)

    {

        return view('company.subscribe.subscribe-pay-view',compact('subdomain'));

        

    }

  
/**
 * TEST FOR DESIGNER
 * 
 */
  public function test_moaz()

    {

     
         return view('test_moaz');

      

    }
        public function test1_moaz()

    {

    
         return view('moaz/test1');

      

    }
        public function test2_moaz()

    {

     
         return view('moaz/test2');

      

    }
    public function bank_moaz()

    {

     
         return view('moaz/bank');

      

    }
    public function methods_moaz()

    {

     
         return view('moaz/methods');

      

    }        

    public function account1()

    {

     
         return view('moaz/accounts1');

      

    }   
     public function account2()

    {

     
         return view('moaz/accounts2');

      

    } 

}

