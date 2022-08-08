<?php



namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;

use App\Models\Permission;

use Validator;
class PermissionController extends BaseController
{
    public function __construct()
    {
         $class = 'permission';
        parent::__construct($class);
       
    }
    public function index($subdomain)

    {
     // echo $this->$permission_; exit;
        $company=$this->company;
        $roles=Auth::user()->role()->first();
        if(($roles['name']=='super_admin'||$roles['name']=='developer')){
            $permission=Permission::where('type','super_admin')->orWhere('type','share')->get();
        }else{
            $permission=Permission::/*where('company_id', $company->id)->*/get();
        }
         return view('permission.permission-list',array('permissions'=>$permission,'subdomain'=>$subdomain));

    }
    
    
    public function store($subdomain,Request $request)

    {
        $company=$this->company;
       // echo $company->id; exit;
        $validator = Validator::make($request->all(), [
            //'key'=>'required',
            //'date_from' => 'required',
            'table_name' => 'required',
            
           ]);
        if ($validator->passes()) {

           $permission=$request->all(); 

           // print_r($permission);
           $roles=Auth::user()->role()->first();
          if(($roles['name']=='super_admin'||$roles['name']=='developer')){
            $type='super_admin';
           }else{
            $type=NULL;
           }
         
           //Permission::generateFor($permission['table_name'],$company->id);
           Permission::generateFor($permission['table_name'],$company->id);
           return response()->json(['success'=>'Added new records.']);

        }

     

        return response()->json(['error'=>$validator->errors()->all()]);




    }
  public function permission_edit($subdomain,REQUEST $request)

    {

        $id=$request->id;

      

        $permission=Permission::where('id', $id)->first();

        return response()->json(['permission'=>$permission]);

        



    }

    public function permission_update($subdomain,Request $request, $id)

    {

        //

        $req = Validator::make($request->all(), [
           
            //'date_from' => 'required',
            'table_name' => 'required',
            
           ]);

        

        if ($req->passes()) {

        $permission['table_name']=$request['table_name'];


        Permission::where('id',$id)->update($permission);

        //return redirect()->route('branch_index');

         return response()->json(['success'=>'updated new records.']);

       }else{

           

          return response()->json(['error'=>$req->errors()->all()]);



       }

 

   }

    public function permission_delete($subdomain,Request $request)

    {
        Permission::where('id',$request->id)->delete();

        return redirect()->route('permission_index');

     }
    
}