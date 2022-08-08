<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category_permission;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
class CategoryController extends BaseController

{
    
    function index($subdomain){   
        $company=$this->company;
     
        $category=Category::get();
        $permissions=$this->getPermission();
        return view('category.index',['category'=>$category,'permissions'=>$permissions,'subdomain'=>$subdomain]);
    }
 
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
            'status'=>'required',
          
           ]);
          
        $request_category=$request->all();
        //print_r($request_category);exit; 
        if ($validator->passes()) {
           

                $category=Category::create(array('title'=>$request_category['title'],'status'=>$request_category['status']))->first();
                        
                   foreach( $request_category['permission'] as $permission_id){
                        Category_permission::create(array('permission_id'=>$permission_id,'category_id'=>$category['id']))->get();
                   }
              
                        
                return response()->json(['success'=> 'added successfully.']);
        
      
        }else{
                return response()->json(['error'=>$validator->errors()->all()]);
        } 
  
      }
      
      
      
    public function edit($subdomain,$id){
      $category=Category::select('category.*','category_permission.permission_id')->where('id',$id)->leftjoin('category_permission','category_permission.category_id','category.id')->get();
     
      return response()->json($category);
    }
    
    
    public function update($subdomain,Request $request, $id){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'status'=>'required',
           
           ]);

        if ($validator->passes()) {
            $category_requests=$request->all(); 
            $category=array('title'=>$category_requests['title'],'status'=>$category_requests['status']);
                
             
            Category::where('id',$id)->update($category);
            
            Category_permission::where(array('category_id'=>$category_requests['cat_id']))->delete();
                foreach($category_requests['permission'] as $permission_id){
                    Category_permission::create(array('permission_id'=>$permission_id,'category_id'=>$category_requests['cat_id']))->get();
                } 
            //print_r($category); exit;
            return response()->json(['success'=> ' updated successfully.']);
        }else{
            return response()->json(['error'=>$validator->errors()->all()]);
        }

    }
   public function delete($subdomain,Request $request)
    {
        Category::where('id',$request->id)->delete();
        return back()->with('success', 'Delete successfully.');
       
    }
    
    public function status($subdomain,Request $request){
    
        $category=Category::where('id',$request->id)->update(array('status'=>$request->status));
        if($category>0){
            return back()->with('success', ' status changed successfully.');
        }else{
             return back()->with('error','messages.error'); 
        }

    }
    public function getPermission(){
        
        $tables= DB::table('permissions')->distinct()->get(['id','table_name']);
      
        $permissions=array();
      
       
        foreach($tables as $table){
            $table_name=$table->table_name;
            $table_per1=Permission::Where(function($query) use ($table_name)
                 {
                     $query->where(array('table_name'=>$table_name,'type'=>'share'));
                    
                   
                 
                 })->get();
                
                 $table_per2=Permission::Where(function($query) use ($table_name)
                 {
                     $query->where(array('table_name'=>$table_name,'type'=>Null));
                    
                   
                 
                 })->get();
                 $merged = $table_per2->merge( $table_per1);
                 $result= $merged->all();
                  if(!empty($result)){
                     $permissions[$table->table_name] = $merged->all();
                 }
                
                 
                 
                 
        }
        return($permissions);

    }


    
}