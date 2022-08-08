<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Company;
use App\Models\Country;
use App\Models\CompanyPlan;
use App\Models\Payments_log;
use App\Models\Payment_attach;
use App\Models\Representative;
use App\Models\Plan;
use App\Models\Category;
use Validator;
use File;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    
    
    public function change_lang(Request $request){
       
      Session::put('lang',$request->lang); 
      $url_array = explode('.', parse_url($request->url(), PHP_URL_HOST));
      $subdomain = $url_array[0];
      $languages = ['pharma', 'egifix','demo'];
     
        if (in_array($subdomain,$languages)){
            $lang=$request->session()->get('lang');
            \App::setLocale($subdomain.'_'. $request->session()->get('lang'));
             //echo $subdomain.'_'.$request->lang; exit;
        }
    }
    public function show_success($subdomain){
        print_r($subdomain); 
        return view('moaz/test2',compact('subdomain'));
    }
    /**
     * 
     * Show Register
     */    

    public function register($subdomain) {
           $categories=Category::where('status',1)->get()->toArray();
           $countries=Country::get();
           return view('register',array('countries'=>$countries,'categories'=>$categories,'subdomain'=>$subdomain));
    }

    
     public function userPostRegistration($subdomain,Request $request) {
      
    
        if($request->pay_status!=1){
            // validate form fields
            $req=Validator::make($request->all(),[
                    'name'               =>      'required',
                    'email'             =>      'required|email',
                    'password'          =>      'required|min:6',
                    'confirm_password'  =>      'required|same:password',
                    'phone'             =>      'required',
                    'company'           =>      'required',
                    'country'           =>      'required',
                   //'category'          =>     'required',
                   // 'time_zone'           =>      'required',
                ]);
        }else{
                      // validate form fields
            $req=Validator::make($request->all(),[
                    'name'               =>      'required',
                    'email'             =>      'required|email',
                    'password'          =>      'required|min:6',
                    'confirm_password'  =>      'required|same:password',
                    'phone'             =>      'required|max:11',
                    'company'           =>      'required',
                    'country'           =>      'required',
                    'type'              =>      'required', 
                    'duration'          =>      'required',
                    'users'             =>      'required',
                    'date_from'         =>       'required',  
                  
                    'currency'          =>       'required',
                   // 'category'          =>     'required',
                ]);  
        }
     
            
        if ($req->passes()) {
            $input          =           $request->all();
            $pay_status =$request->pay_status;
            $url_array = explode('.', parse_url($request->url(), PHP_URL_HOST));
            $category=Category::where('title',$url_array[0])->first();
         //   print_r( $category);exit;
            $company = Company::create(array('title'=>$request->company,'status'=>$pay_status,'country_code'=>$request->country,'cat_id'=>$category['id']/*,'time_zone'=>$request->time_zone*/));
            $role= Role::create(array('name'=>'admin','company_id'=>$company->id));
   
          // }  
          
           
           if(!is_null($company)&&!is_null($role['id'])){
                // if validation success then create an input array
                $inputArray      =           array(
                    'name'              =>      $request->name,
                    'email'             =>      $request->email,
                    'password'          =>      Hash::make($request->password),
                    'phone'             =>      $request->phone,
                    'company_id'        =>      $company->id,
                    'role_id'           =>     $role->id 
                    
            
                    
                );
             // print_r($inputArray);exit;
            }
            // register user
            $user= User::create($inputArray);
          
            // if registration success then return with success message
         
             $this->excute_query_admin($role->id,$company->id);
             $role_manger= Role::create(array('name'=>'manger','company_id'=>$company->id));
             $this->excute_query_manger($role_manger->id,$company->id);
            
           if($pay_status==1){
                    
                           
               // print_r($request->all());
                if ($req->passes()) {
                   
                    $date_from=$request->date_from;
                    $end_date=Carbon::parse($date_from)->addMonths($request->duration);
                    $end_date=$end_date->format('Y-m-d');
                    //echo $end_date; exit;
                    if(isset($request->transaction_status )&& $request->transaction_status=="success"){
                        $status=1;
                    }else{
                        $status=0;
                    }
                    $trans_status=$request->transaction_status?$request->transaction_status:null;
                    $trans_id=$request->transaction_id?$request->transaction_id:null;
                    $input=array('company_id'=>$company->id,'number_user'=>$request->users,'status'=>$status,'duration'=>$request->duration,'date_from'=>$request->date_from,'plan_id'=>$request->plan_id,'salary'=>$request->total,'date_to'=>$end_date,'transaction_status'=>$trans_status,'transaction_id'=>$trans_id);
                    $upgrade=CompanyPlan::create($input)->get();
                   
                   if($request->paymethod=="visa"){
                   
                         $log=array('paid'=>$request->total,'pay_method'=>$request->type,'company_id'=>$company->id,'users_number'=>$request->users,'period_from'=>$request->date_from,'period_to'=>$end_date,'status'=>$status,'company_plan_id'=>$upgrade[0]['id']);
                         Payments_log::create($log)->get();
                   }elseif($request->paymethod=="bank_convert"||$request->paymethod=="postal_convert"){
                      
                         $file_path=$request->file_path;
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
            // if registration success then return with success message
            if(!is_null($user)) {
                 return response()->json(['success'=>__('trans.Added successfully.')]);
            }

            // else return with error message
            else {
                 return response()->json(['error'=> __('trans.same user register before')]);
            }
        }
         return response()->json(['error'=>$req->errors()->all()]);    
    }
    
            
    public function emailCheck($subdomain,Request $request){
            if(isset($request->email)){
                $req=Validator::make($request->all(),[
                       
                        'email'             =>      'required|email|unique:users',
                        
                    ]);
            }
            if(isset($request->phone)){
               $req=Validator::make($request->all(),[
                       
                       'phone'             =>      'required|numeric|max:11|unique:users',
                        
                    ]);  
            }
                if(!$req->passes()){
                   return Response()->json(['error'=>$req->errors()->all()]) ;
                }else{
                   return response()->json(['success'=>'success']);
                }
        
        
        
    }
      
  public function signupStoreImage($subdomain,Request $request)
    {
        //print_r($request->all());    
      // exit;
        $request->validate([
          'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        

        if ($request->file('file')) {
            $imagePath = $request->file('file');
           
            $imageName=time().".".$request->file('file')->extension();    
            //$path = $request->file('file')->storeAs('img/company', $imageName.".".$request->file('file')->extension());
           
            $request->file->move(public_path('img/subscribe'),$imageName);
        }  
           $path ='img/subscribe/'.$imageName;

        return response()->json($path);
    }
    /*
    admin can create user
    */
    public function CreateUser($subdomain,Request $request) {
        $req = Validator::make($request->all(), [
            'name' => 'required|string|between:2,50',
           
            'phone' => 'required|string|min:12|max:12|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'ssn'=>'required|string|min:14|max:15|unique:users',
            'role'=>'required|in:employee,manager',
        ]);

        if($req->fails()){
            return response()->json($req->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
                    $req->validated(),
                    ['password' => bcrypt($request->password)

                    ]
                ));

        return response()->json([
            'message' => 'User signed up',
            'user' => $user
        ], 201);
    }

    public function excute_query_admin($role_admin,$company)
    {
        DB::table('permission_roles')->insert(['permission_id'=>
        ['permission_id'=>1, 'role_id'=>$role_admin ,'company_id'=>$company],
        ['permission_id'=>2, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>3,  'role_id'=>$role_admin , 'company_id'=> $company ],
        ['permission_id'=>4, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>5,  'role_id'=>$role_admin , 'company_id'=> $company ],
        ['permission_id'=>6, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>7 ,  'role_id'=>$role_admin , 'company_id'=> $company ],
        ['permission_id'=>8, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>9, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>10, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>11, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>12, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>13, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>14, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>15, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>16, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>17 , 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>18, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>19, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>20, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>21, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>22, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>23, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>24, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>25, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>26, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>27 , 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>28, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>29, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>30, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>31, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>32, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>33, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>34, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>35, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>36, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>37 , 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>38, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>39, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>40, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>41, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>42, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>43, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>44, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>45, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>46, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>47 , 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>48, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>49, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>50, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>51, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>52, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>53, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>54, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>55, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>56, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>57 , 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>58, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>59, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>60, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>61, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>62, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>63, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>64, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>65, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>66, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>67 , 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>68, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>69, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>70, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>71, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>72, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>73, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>74, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>75, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>76, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>77 , 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>78, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>79, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>80, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>81, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>82, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>83, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>84, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>85, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>86, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>87, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>88, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>89, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>90, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>91, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>92, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>93, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>94, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>95, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>96, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>97 , 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>98, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>99, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>100, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>101, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>102, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>103, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>104, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>105, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>106, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>107 , 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>108, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>109, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>110, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>111, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>112, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>113, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>114, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>115, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>116, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>117 , 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>118, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>119, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>120, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>121, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>122, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>123, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>124, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>125, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>126, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>127 , 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>129, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>128, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>132, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>133, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>128, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>129, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>130, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>131, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>134, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>135, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>136, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>13 , 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>138, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>139, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>140, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>141, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>142, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>143, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>144, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>157, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>158, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>159, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>160, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>161, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>163, 'role_id'=> $role_admin , 'company_id'=> $company ],
        ['permission_id'=>164, 'role_id'=> $role_admin , 'company_id'=> $company ]
    ]);
    }
    public function excute_query_manger($role_manger,$company){
        
         DB::table('permission_roles')->insert([['permission_id'=>18, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>13, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>14, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>15, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>16, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>17, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>19, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>20, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>21, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>22, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>23, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>118, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>24, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>25, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>26, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>27, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>28, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>29, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>30, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>31, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>32, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>33, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>137, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>54, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>55, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>56, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>57, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>58, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>59, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>60, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>61, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>62, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>63, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>123, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>64, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>65, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>66, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>67, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>68, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>69, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>70, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>71, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>72, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>73, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>113, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>124, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>74, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>75, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>76, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>77, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>78, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>79, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>80, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>81, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>82, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>83, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>84, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>85, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>86, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>87, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>88, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>111, 'role_id'=> $role_manger , 'company_id'=> $company ],
        ['permission_id'=>112, 'role_id'=> $role_manger , 'company_id'=> $company ],
        ['permission_id'=>114, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>115, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>116, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>117, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>120, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>121, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>122, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>127, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>94, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>95, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>96, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>97, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>98, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>99, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>100, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>101, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>102, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>103, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>104, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>105, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>106, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>107, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>108, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>109, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>110, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>125, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>119, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>126, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>132, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>133, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>163, 'role_id'=> $role_manger  , 'company_id'=> $company ],
        ['permission_id'=>164, 'role_id'=> $role_manger  , 'company_id'=> $company ]
    
    ]);
    }



    //

    function showLogin($subdomain,Request $request){
     
        return view('login',compact('subdomain'));


    }
    function postLogin($subdomain,Request $request){
     
      $userCredentials = $request->only('email', 'password');
      $remember = $request['remember'];
    
      // check user using auth 
      if (Auth::attempt($userCredentials,$remember)) {
          return redirect()->route('/',$subdomain);
      }

      else {

         // return redirect()->back()->with('error', __('trans.invalid email or password.'));
         return redirect()->route('login',$subdomain)->with('error', __('trans.invalid email or password.'));
      }

    }
    function logout($subdomain,Request $request){
        $request->session()->flush();
    
        Auth::logout();
        
        return Redirect(url('admin'));
    }
    
    
    
        public function getPlan($subdomain,$type,$currency){
        $plan= Plan::where(array('pay_type'=>$type,'currency'=>$currency))->first(); 
        
         return response()->json($plan);
    }
    
}
