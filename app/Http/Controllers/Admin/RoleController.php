<?php



namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;

use App\Models\Role;
use App\Models\Permission;
use App\Models\Permission_role;
use Validator;
class RoleController extends BaseController
{
    public function __construct()
    {
         $class = 'role';
        parent::__construct($class);
       
    }

    public function index($subdomain){
        
        $company=$this->company;
       
        $tables=$query = DB::table('permissions')->distinct()->get(['id','table_name']);
        $roles=$this->roles;
        $permissions=array();
        if(($roles['name']=='super_admin'||$roles['name']=='developer')&&(!Session::has('company'))){ 
       
                foreach($tables as $table){
                    $table_name=$table->table_name;
                    $table_per1=Permission::Where(function($query) use ($table_name)
                         {
                             $query->where(array('table_name'=>$table_name,'type'=>'share'));
                            
                           
                         
                         })->get();
                        
                         $table_per2=Permission::Where(function($query) use ($table_name)
                         {
                             $query->where(array('table_name'=>$table_name,'type'=>'super_admin'));
                            
                           
                         
                         })->get();
                         $merged = $table_per2->merge( $table_per1);
                         $result= $merged->all();
                          if(!empty($result)){
                             $permissions[$table->table_name] = $merged->all();
                         }
                        
                         
                         
                         
                }
        }else{

             foreach($tables as $table){
                    $table_name=$table->table_name;
                    $table_per1=Permission::Where(function($query) use ($table_name)
                                                 {
                                                     $query->where(array('table_name'=>$table_name,'type'=>'share'));
                                                    
                                                   
                                                 
                                                 })->get();
                        
                     $table_per2=Permission::Where(function($query) use ($table_name)
                                             {
                                                 $query->where('table_name',$table_name);
                                                
                                               
                                             
                                             })->where('type',NULL)->get();
                         $merged = $table_per2->merge( $table_per1);
                         $result= $merged->all();
                          if(!empty($result)){
                             $permissions[$table->table_name] = $merged->all();
                         }
                         // $permissions[$table->table_name]=Permission::where('table_name',$table_name)->get();
             }
        }
        //print_r($permissions); exit;
      
        if(($roles['name']=='super_admin'||$roles['name']=='developer')&&(!Session::has('company'))){
             $select_role= Role::where('name',$roles['name'])->first();
             $role_id=$select_role['id'];
             $roles_=Role::Where(function($query) use ($role_id)
             {       
                 $query->where('id','>',$role_id);
  
                 $query->where('type','!=','super_admin');
                  
                     
                        
             })->get();
              //$roles_=Role::get();
        }else{
            $role_id=Auth::user()->role_id;
           
            $roles_=Role::where('company_id', $company->id)
                         ->Where(function($query) use ($role_id)
                         {
                                     $query->where('id','>',$role_id);
                      
                                     $query->where('type','!=','super_admin');
                                    
                      
                     
                         })->get();
        }    
        $role_id=Auth::user()->role_id;
       
        return view('roles.index',compact('roles_','permissions','subdomain'));
    }
    
    public function store($subdomain,Request $request)

    {
  
        $company=$this->company;
        $roles=$this->roles;
        $validator = Validator::make($request->all(), [
          
            //'date_from' => 'required',
            'name' => ['required', 'unique:roles']
            
           ]);
        if ($validator->passes()) {

          $request_role=$request->all(); 
          
        // print_r($request_role); exit;
          if(($roles['name']=='super_admin'||$roles['name']=='developer')&&(!Session::has('company'))){
         
                   $role=Role::create(array('name'=> $request_role['name'],'type'=>'super_admin'))->get();
                   foreach( $request_role['permission'] as $permission_id){
                        Permission_role::create(array('permission_id'=>$permission_id,'role_id'=>$role[0]->id))->get();
                   }
            
            }else{
                
                   $role=Role::create(array('name'=> $request_role['name'],'company_id'=>$company->id))->get();
                   foreach( $request_role['permission'] as $permission_id){
                        Permission_role::create(array('permission_id'=>$permission_id,'role_id'=>$role[0]->id,'company_id'=>$company->id))->get();
                   }
            }
           return response()->json(['success'=>'Added new records.']);

        }

     

        return response()->json(['error'=>$validator->errors()->all()]);




   }
  public function edit($subdomain,REQUEST $request)

    {

        $id=$request->id;

        $roles=$this->roles;
        $company=$this->company;
        $role=Role::where('id', $id)->first();
         if(($roles['name']=='super_admin'||$roles['name']=='developer')&&(!Session::has('company'))){       
            
             $permissions=Permission_role::where(array('role_id'=>$id))->get();
         }else{
             $permissions=Permission_role::where(array('role_id'=>$id,'company_id'=>$company->id))->get();
         }

       
       // print_r($permissions); exit;
        return response()->json(array('role'=>$role,'permissions'=>$permissions));

        



    }

    public function update($subdomain,Request $request, $id)

    {
        
        $company=$this->company;
       
        $roles=$this->roles;
        $validator= Validator::make($request->all(), [
           
            //'date_from' => 'required',
            'name' => 'required',
            
           ]);

         if ($validator->passes()) {

              $request_role=$request->all(); 
    
          //  print_r($request_role); exit;
              if(($roles['name']=='super_admin'||$roles['name']=='developer')&&(!Session::has('company'))){    
                    if(isset($request_role['permission'])){
                        Permission_role::where(array('role_id'=>$id))->delete();
                        foreach( $request_role['permission'] as $permission_id){
                            Permission_role::create(array('permission_id'=>$permission_id,'role_id'=>$id))->get();
                        }
                    }
                
               } else{
                      
                    if(isset($request_role['permission'])){
                        Permission_role::where(array('role_id'=>$id,'company_id'=>$company->id))->delete();
                        foreach( $request_role['permission'] as $permission_id){
                            Permission_role::create(array('permission_id'=>$permission_id,'role_id'=>$id,'company_id'=>$company->id))->get();
                        } 
                    }
                    
               }
              

    
               return response()->json(['success'=>'updated new records.']);

        }
         else{

               return response()->json(['error'=>$validator->errors()->all()]);



         }
   }

    public function delete($subdomain,Request $request)

    {
        Role::where('id',$request->id)->delete();

        return redirect()->route('role_index');

     }
    
}