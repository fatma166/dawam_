<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visits_type;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class OutdoorTypesController extends Controller
{
    //
    public function Index(Request $request, $id=null)
    {
        
        $user_data=Auth::guard('api')->user();
        $company_id=$user_data['company_id'];
        //return $id?Visits_type::find($id):Visits_type::all();
    
          return response()->json(Visits_type::where('company_id',$company_id)->get(), 200);
    }
    
}
