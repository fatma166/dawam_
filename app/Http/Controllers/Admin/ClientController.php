<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Company;
use App\Models\User;
use App\Models\Outdoor;
use App\Models\Client_type;
use App\Models\Branch;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\Specialization;

class ClientController extends BaseController
{

    function index($subdomain,Request $request){
        $search=$request->all();
        $company=$this->company;
        $manger_branch_id= $this->branch_id;
        $manger_department_id= $this->department_id;

        $client_types=Client_type::where('client_types.company_id', $company->id)->get();
        // $client_types=Client_type::where('client_types.company_id', $company->id)->get();
       

        $specializations=Specialization::where('company_id',$company->id)->get();
        // $specializations=Specialization::where('company_id',$company->id)->get();
        
      //  $users=User::where('company_id',$company->id)->where('role_id','!=',1)->orWhereNull('role_id')->get();
       
        $branchs=$this->branch->getBranch($company->id,$manger_branch_id);
       if(isset($_GET['notify__id'])) $client=$_GET['notify__id'];else $client=null;
       
      // if($request->ajax()){
                   $client=$request['client'];
                   $branch=$request['branch'];
                   $client_type=$request['client_type'];
                   $special_search=$request['specializations'];
                   $clients=Client::select('clients.*','client_types.name as client_type_name')->join('client_types','client_types.id','=','clients.client_type_id')->where('clients.company_id', $company->id)
                                   ->Where(function($query2) use ($client,$branch,$client_type,$special_search) {
                                           if($client!=null){
                                              $query2->Where('clients.id',$client);  
                                           }
                                           if(isset($branch)&&$branch!='all')
                                           $query2->Where('clients.branch_id',$branch);
                                           if(isset($client_type)&&$client_type!='all')
                                           $query2->Where('clients.client_type_id',$client_type);
                                           if(isset($special_search)&&$special_search!='all')
                                           $query2->Where('clients.specialization_id',$special_search);
                                    })
                                    ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                                           if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                                 $query->where('clients.branch_id',$manger_branch_id);
                                          
                                                   
                                    })
                                    ->paginate(15);
                        
                         
                  
                        
       /* }else{
                    $clients=Client::select('clients.*','client_types.name as client_type_name')->join('client_types','client_types.id','=','clients.client_type_id')->where('clients.company_id', $company->id)
                                   ->Where(function($query2) use ($client) {
                                           if($client!=null){
                                              $query2->Where('clients.id',$client);  
                                           }
                                    })
                    
                                  ->paginate(15);
                    
        }*/
         if($request->ajax()){
             return view('client.search_client',['clients'=>$clients,'client_types'=>$client_types,'branchs'=>$branchs,'search'=>$search,'specializations'=>$specializations,'subdomain'=>$subdomain]);
          }  
         else{
             return view('client.index',['clients'=>$clients,'client_types'=>$client_types,'branchs'=>$branchs,'search'=>$search,'specializations'=>$specializations,'subdomain'=>$subdomain]);
         }
   
    }
 
    /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
      public function store ($subdomain,Request $request)
      {
          // print_r($request->all()); exit;   
      
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone'=>'required|numeric|unique:clients',
            'client_type_id'=>'required',
            'address'=>'required',
            'add_lat'=>'required',
            //'email'=>'required|unique:clients',
           // 'start_time'=>'required',
            //'end_time'=>'required',
            'add_lang'=>'required',
            'add_lang'=>'required',
            'branch'=>'required',
            'target'=>'required',

        //    'specializations_id'=>'required',
           ]);
         // print_r($request->all()); exit;
           
        if ($validator->passes()) {
            $client_requests=$request->all(); 
            //print_r($client_requests); exit;
            $company=$this->company;
           // $email_exist_check= Client::where('email',$client_requests['email'])->first();
          
            //if(empty($email_exist_check)){
           $client_requests['day']=$client_requests['day']??'all';
           $appoint=array();
            foreach($client_requests['day'] as $index=>$day){
                $appoint[$index]['day']=$day;
                $appoint[$index]['start_time']= ($client_requests['start_time'][$index] == null ? "00:00:00" :$client_requests['start_time'][$index] );
                $appoint[$index]['end_time']= ($client_requests['end_time'][$index] == null ? "00:00:00" :$client_requests['end_time'][$index] );
                
            }

           $appointments=json_encode($appoint);
           // echo $appointments;
                $client=Client::create(array('branch_id'=>$client_requests['branch'],'company_id'=>$company->id,'name'=>$client_requests['name'],'phone'=>$client_requests['phone'],'client_type_id'=>$client_requests['client_type_id'],'address'=>$client_requests['address'],'lati'=>$client_requests['add_lat'],'longi'=>$client_requests['add_lang'],'email'=>$client_requests['email'],'contact_person'=>$client_requests['contact_person'],'contact_phone'=>$client_requests['contact_phone']/*,'start_time'=>$client_requests['start_time'],'end_time'=>$client_requests['end_time'],*/,'target'=>$client_requests['target']
                       ,'specialization_id'=>$client_requests['specializations_id'],'appointments'=>$appointments))->get();
                
                    if(!is_null($client)) {
                        
                        return response()->json(['success'=> 'added successfully.']);
                    }
          //  }else{
              //  return response()->json(['error'=>'email entered before']);
           // }
        }else{
            return response()->json(['error'=>$validator->errors()->all()]);
        } 
  
      }
      /**
       * CHANGE CLIENT STATUS
       */
    
    public function status($subdomain,Request $request){
    
        $client= Client::where('id',$request->id)->update(array('status'=>$request->status));
        if($client>0){
        return back()->with('success', ' status changed successfully.');
        }else{
        return back()->with('error','messages.error'); 
        }

    }

/**
 * EDIT CLIENT
 */
    public function edit($subdomain,$id){
        $company=$this->company;

      $client=Client::where('id',$id)->where('company_id',$company->id)->get();
      return response()->json($client);
    }
/**
 * p
 */
    
    public function profile($subdomain,$id){
      $profile=Client::select('clients.*','client_types.name as type_name','client_types.id','branches.title as branch_title')
                     ->where('clients.id',$id)
                     ->join('branches','branches.id','=','clients.branch_id')
                     ->join('client_types','client_types.id','=','clients.client_type_id')->first();
      $date1= Carbon::now();
      $month=($date1->month);
      $year=($date1->year);
      $outdoor_count=Outdoor::select('outdoors.id')

                    ->join('clients', 'clients.id', '=', 'outdoors.customer_id')
                     ->where('outdoors.customer_id',$id)
                    ->whereMonth('outdoors.date',$month)

                    ->whereYear('outdoors.date', '=', $year)

                    ->count();
      if($profile['target']!=0)
            $percentage=(ceil($outdoor_count/$profile['target'])*100)/100;
      else
            $percentage=0;
      return view('client.client_profile',['profile'=>$profile,'outdoor_count'=>$outdoor_count,'target'=>$profile['target'],'percentage'=>$percentage,'subdomain'=>$subdomain]);
    }
    
    public function update($subdomain,Request $request, $id){
        /** abdelkawy validation   phone in update  */
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone'=>'required|numeric|unique:clients,phone,'.$id,
            'client_type_id'=>'required',
            'address'=>'required',
            'add_lat'=>'required',
           // 'email'=>'required|unique:clients,email,'.$id,
          //  'start_time'=>'required',
           // 'end_time'=>'required',
            'add_lang'=>'required',
            'branch'=>'required',
            //  'specializations_id'=>'required',
           ]);
          
           
        if ($validator->passes()) {
            $client_requests=$request->all(); 
            $company=$this->company;
            $client_requests['day']=$client_requests['day']??'all';
            $appoint=array();
           
            if($client_requests['day']!='all'){
                foreach($client_requests['day'] as $index=>$day){
                    $appoint[$index]['day']=$day;
                    $appoint[$index]['start_time']= $client_requests['start_time'][$index];
                    $appoint[$index]['end_time']= $client_requests['end_time'][$index];
                    
                }
            }

            $appointments=json_encode($appoint); 
            $client=array('branch_id'=>$client_requests['branch'],'company_id'=>$company->id,'name'=>$client_requests['name'],'phone'=>$client_requests['phone'],'client_type_id'=>$client_requests['client_type_id'],'address'=>$client_requests['address'],'lati'=>$client_requests['add_lat'],'longi'=>$client_requests['add_lang'],'email'=>$client_requests['email'],'contact_person'=>$client_requests['contact_person'],'contact_phone'=>$client_requests['contact_phone']/*,'start_time'=>$client_requests['start_time'],'end_time'=>$client_requests['end_time']*/,'target'=>$client_requests['target']
                         ,'specialization_id'=>$client_requests['specializations_id'],'appointments'=>$appointments);
            Client::where('id',$id)->update($client);
            return response()->json(['success'=> ' updated successfully.']);
        }else{
            return response()->json(['error'=>$validator->errors()->all()]);
        }

    }
    
    
    /**
     * client chart per month
     */
     
      public function client_line_chart($subdomain,Request $request){
      

        $company=$this->company;

        $date1= Carbon::now();

       
        $client_id=$request['id'];
        $now_month=($date1->month);

        $year= $date1->year;

         $number_days = Carbon::now()->daysInMonth; 

      //  $total=User::select(DB::raw('COUNT(users.id) as total'))->where('users.company_id',$company->id)->where('users.id', '!=' , Auth::user()->id)->first();

       // $total=$total['total'];

        $client_report=array();

        for($month=0;$month<=$now_month;$month++){  

           

            //$month1='0'.$month;

            $client_report[$month]['month']=$month;


             $client_report[$month]['monthly_vists']=Outdoor::select('outdoors.id')

                                ->join('clients', 'clients.id', '=', 'outdoors.customer_id')
                                 ->where('outdoors.customer_id',$client_id)
                                ->whereMonth('outdoors.date',$month+1)

                                ->whereYear('outdoors.date', '=', $year)

                                ->count();

         

           

        }
       // print_r( $client_report);

       // $data=array(array('y'=> '2006', 'present'=> 50,'b'=> 90 ),array('y'=> '2007', 'present'=> 57,'b'=> 97 ),array('y'=> '2008', 'a'=> 58,'b'=> 98));

        return response()->json( $client_report); 

    }
    
    
    
    /**
     * DELETE CLIENT
     */
    public function delete($subdomain,Request $request)
    {
        Client::where('id',$request->id)->delete();
        return back()->with('success', 'Delete successfully.');
       
    }
    
    /**
     * CLIENT TYPE INDEX
     */
    public function index_type($subdomain){
        $company=$this->company;
      //  $users=User::where('company_id',$company->id)->where('role_id','!=',1)->orWhereNull('role_id')->get();
        $client_types=Client_type::where('company_id', $company->id)->get();
       // $clients=Client::select('clients.*','client_types.name as client_type_name')->join('client_types','client_types.id','=','clients.client_type_id')->where('company_id', $company->id)->get();
   
        return view('client.index_type',['client_types'=>$client_types,'subdomain'=>$subdomain]);
    }

    /**
     * STORE CLIENT TYPE
     * 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_type($subdomain,Request $request)
    {
        $company_check=$this->company;
        $validator = Validator::make($request->all(), [
           /** abdelkawy validation name  field in store  */
          /*  'title' =>
             'required|unique:client_types,name'*/
             'name'=>  Rule::unique('client_types')->where(function ($query) use($company_check) {
                        return $query->where('company_id', $company_check->id);
                        })
           ]);
          
           
        if ($validator->passes()) {
            
      
        // $request->validate([ 'name'=>'required']);
            $input=array('name'=>$request->name ,'company_id'=> $company_check->id
                        ,'target_outdoors'=>$request->target_outdoor);
            $client_type=Client_type::create($input);
            if(!is_null($client_type)) {
                
                return response()->json(['success'=> 'added successfully.']);
            }
        }else{
                return response()->json(['error'=>$validator->errors()->all()]);
        }
    }
    
     /**
      * SHOW CLIENT TO EDIT
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_type($subdomain,Request $request)
    {
        $id=$request->id;
        $client_type=Client_type::where('id', $id)->first();
        return response()->json(['client_type'=>$client_type]);
    }
   
    
    
    /**
     * UPDATE CLIENT TYPE
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
     
     
    public function update_type($subdomain,Request $request, $id)
    {
          $company_check=$this->company;
        /** abdelkawy validation name field in update  */
        $validator = Validator::make($request->all(), [
            //'name' => 'required|unique:client_types,name,'.$id,
             'name'=>  Rule::unique('client_types')->where(function ($query) use($company_check,$id) {
                        return $query->where('company_id', $company_check->id)->where('id','!=',$id);
                        }),

           ]);
          
           
        if ($validator->passes()) {
            $client_type['name']=$request['name'];
            $client_type['target_outdoors']=$request['target_outdoor'];
            Client_type::where('id',$id)->update($client_type);
            return response()->json(['success'=> 'updated successfully.']);
         }else{
            return response()->json(['error'=>$validator->errors()->all()]); 
         }
   
    }
    
    
    /**
     * DELETE CLIENT TYPE
     */
    public function delete_type($subdomain,Request $request){


        
        Client_type::where('id',$request->id)->delete();  
    }

       /**
     * selectClientSearch
     */
    public function selectClientSearch($subdomain,Request $request){
        $manger_branch_id= $this->branch_id;
         $manger_department_id= $this->department_id;
         $company=$this->company;
         $clients = [];

        if($request->has('q')){
            $search = $request->q;
            $clients =Client::select("clients.id", "clients.name")
                   // ->leftjoin('users','users.branch_id','clients.branch_id')
            		->where('clients.name', 'LIKE', "%$search%")
    	            ->where('clients.company_id',$company->id)
                   ->Where(function($query) use ($manger_branch_id,$manger_department_id){
                               if(isset($manger_branch_id)&&($manger_branch_id!='all')&&$manger_branch_id!=NULL)
                                     $query->where('clients.branch_id',$manger_branch_id);
                              
                                       
                    })
                   /* ->where('users.active',1)
                    ->where('users.bassma',1)*/
            		->get();
        }
        return response()->json($clients);
    }
}
