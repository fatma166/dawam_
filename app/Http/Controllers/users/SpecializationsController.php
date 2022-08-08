<?php
namespace App\Http\Controllers\users;
use App\Http\Controllers\Controller;
use App\Library\Error;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Library\ThirdApi;
use App\Models\Specialization;
use App\Models\Company;
USE App\Contracts\ErrorMessages;
class SpecializationsController extends Controller
{
    
    public function Index(Request $request)
    {
            if(!$company=$request->user()->company)
            {
                return response(['msg' => ErrorMessages::SPECIALIZATION_INDEX_YOU_HAVE_NOT_COMPANY_ERROR],204);
    
             }
            $comany_id=$request->user()->company->id;
            $speacilations=Specialization::where('company_id',$comany_id)->get();
            return response()->json(['specializations'=>$speacilations]);
        

    }

   

  
   
   
}
