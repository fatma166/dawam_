<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Admin\SpecializationController;
use App\Models\Specialization;
use App\Models\Client;

class SpecializationController  extends BaseController
{

    public function index($subdomain)
    {
     
            $company_check = $this->company;
            $companies = array();
            
            $specialization=Specialization::where('company_id',$company_check->id)->get();
           return view('specializations.index',compact('specialization','subdomain'));
     }
      
        
      
   


    public function store($subdomain,Request $request)
    {

      $company = $this->company;
      $validator = Validator::make($request->all(),
        [
                'name' => ['required',
                            Rule::unique('specializations')
                              ->where('company_id', $company->id)
                           ],
        ]);

        if ($validator->passes())
        {
          $specialization = $request->All();
          $input=array('name'=>$specialization['name'],'company_id'=> $company->id);
          $specialization=Specialization::create($input);
          if(!is_null($specialization)) {
            return response()->json(['success'=>'Added new records.']);
          }

        }
        else {
            return response()->json(['error'=>$validator->errors()->all()]);
          }
    }

     public function edit($subdomain,$id)
     {
        
        $company = $this->company;
        $specializations=Specialization::where('id',$id)->where('company_id',$company->id)->first();
        return response()->json($specializations);
     }

     public function update($subdomain,Request $request, $id)
     {
        
        $company= $this->company;
       
        $req=Validator::make($request->all(),[
            'name'=> ['required',
               Rule::unique('specializations')->where(function ($query) use($company,$id)
              {
                        return $query->where('company_id', $company->id)->where('id','!=',$id);
               }),
            ],
        ]);

      
if ($req->passes())
        {
          $specializations = $request->All();   
          Specialization::where('id',$id)->where('company_id',$company->id)
          ->update(['name'=>$specializations['name']]);
            return response()->json(['success'=>'Added new records.']);
        }
        else
        {
            return response()->json(['error'=>$req->errors()->all()]);
        }


     }
    public function destroy($subdomain,$id)
    {
        $company= $this->company;
        Specialization::where('id',$id)->where('company_id',$company->id)->delete();

        // $clients=Client::where('specialization_id',$id)->where('company_id',$company->id);
        // if(!is_null($clients))
        // {
        //     return response()->json(['error'=>$req->errors()->all()]);
        // }
       
        // else {
           
        // }
      
    }


    

   
  


  


   
   

}
