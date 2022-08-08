<?php

namespace App\Http\Controllers\users;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Client_type;

class ClientTypeController extends Controller
{
    //

     public function Index(Request $request,$id=null){

      return $id?Client_type::find($id):$request->user()->company->clientTypes;
    }
}
